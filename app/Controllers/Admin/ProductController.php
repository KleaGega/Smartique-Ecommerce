<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\{CSRFToken, FileUpload, RequestValidation, Request, Session, View};
use App\Middlewares\Role;
use App\Models\{Category, Product};
use Exception;

// Controller for managing products in the admin dashboard (CRUD operations).
class ProductController extends Controller
{
    protected ?int $count = null;

    public function __construct()
    {
        Role::handle();
        $this->count = Product::all()->count();
    }

    // Display a paginated list of products for the admin dashboard.

    public function index(): View
    {
        ['items' => $products, 'links' => $links] = paginateData(Product::class, 8);

        return View::render()->blade('admin.products.index', compact('products', 'links'));
    }

    // Show the form for creating a new product.
    public function create(): View
    {
        $categories = Category::all();

        return View::render()->blade('admin.products.create', compact('categories'));
    }

    /**
     * @throws Exception
     */
    // Handle the creation of a new product after form submission.
    public function store(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'name' => ['required' => true, 'unique' => 'products'],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        $image_path = $this->uploadProductImage();

        if (!$image_path) {
            Session::add('invalids', ['s' => 'The image is invalid']);
            redirect('/admin/products/create');
        }

        Product::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Product created successfully');

        redirect('/admin/products');
    }

    // Validate and upload the product image, returning its storage path.
    protected function uploadProductImage(): false|string
    {
        $file = Request::get('file');
        $file_name = $file->image->name;

        if (empty($file_name) or $file_name == "" or strlen($file_name) < 1) {
            return false;
        }

        if (!FileUpload::isImage($file_name)) {
            return false;
        }

        $file_temp = $file->image->tmp_name;

        return FileUpload::move($file_temp, 'images/products', $file_name)->getPath();
    }

    // Show the form for editing an existing product.
    public function edit($id): View
    {
        $product = Product::query()->where('id', $id)->first();

        $categories = Category::all();

        return View::render()->blade('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * @throws Exception
     */
    // Handle the update of an existing product after form submission.
    public function update($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'name' => ['required' => true],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        $product = Product::query()->where('id', $id)->first();

        $file = Request::get('file');
        $file_name = $file->image->name;
        if (!empty($file_name)) {
            $image_path = $this->uploadProductImage();
        } else {
            $image_path = $product->image_path;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Product updated successfully');

        redirect('/admin/products');
    }

    // Delete a product and its associated image from the server.
    public function delete($id): void
    {
        $product = Product::query()->where('id', $id)->first();

        unlink($product->image_path);

        $product->delete();

        Session::add('message', 'Product deleted successfully');

        redirect('/admin/products');
    }
}
