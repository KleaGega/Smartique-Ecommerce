<?php
// All the routes for the website
$router->map('GET', '[/]?', 'HomeController@index');

# products routes
$router->map('GET', '/products/[i:id][/]?', 'ProductController@show');
$router->map('GET', '/products[/]?', 'ProductController@index');

# cart routes
$router->map('GET', '/cart[/]?', 'CartController@show');
$router->map('POST', '/cart/add/', 'CartController@addItem');
$router->map('POST', '/cart/quantity/inc/', 'CartController@incrementQty');
$router->map('POST', '/cart/quantity/dec/', 'CartController@decrementQty');
$router->map('POST', '/cart/remove/item/', 'CartController@removeItem');
$router->map('POST', '/cart/remove/all/', 'CartController@removeAll');

# categories routes
$router->map('GET', '/categories/[i:id][/]?', 'CategoryController@show');


# auth  routes
$router->map('GET', '/register[/]?', 'AuthController@register');
$router->map('POST', '/register/', 'AuthController@registerPost');
$router->map('GET', '/login[/]?', 'AuthController@login');
$router->map('POST', '/login/', 'AuthController@loginPost');
$router->map('POST', '/logout/', 'AuthController@logout');


# payment routes
$router->map('POST', '/payment/pay/', 'Order\OrderController@pay');
$router->map('POST', '/payment/callback/', 'Order\OrderController@callback');

/**
 * ========== Admin routes ==========
 */
$router->map('GET', '/admin[/]?', 'Admin\DashboardController@index');

# categories
$router->map('GET', '/admin/categories[/]?', 'Admin\CategoryController@index');
$router->map('GET', '/admin/categories/create[/]?', 'Admin\CategoryController@create');
$router->map('POST', '/admin/categories/store/', 'Admin\CategoryController@store');
$router->map('GET', '/admin/categories/[i:id]/edit/', 'Admin\CategoryController@edit');
$router->map('POST', '/admin/categories/[i:id]/update/', 'Admin\CategoryController@update');
$router->map('POST', '/admin/categories/[i:id]/delete/', 'Admin\CategoryController@delete');

# products routes
$router->map('GET', '/admin/products[/]?', 'Admin\ProductController@index');
$router->map('GET', '/admin/products/create[/]?', 'Admin\ProductController@create');
$router->map('POST', '/admin/products/store/', 'Admin\ProductController@store');
$router->map('GET', '/admin/products/[i:id]/edit/', 'Admin\ProductController@edit');
$router->map('POST', '/admin/products/[i:id]/update/', 'Admin\ProductController@update');
$router->map('POST', '/admin/products/[i:id]/delete/', 'Admin\ProductController@delete');


# users routes
$router->map('GET', '/admin/users[/]?', 'Admin\UserController@index');
$router->map('GET', '/admin/users/distribution[/]?', 'Admin\UserController@distribution');
$router->map('GET', '/admin/users/[i:id]/edit[/]?', 'Admin\UserController@edit');
$router->map('POST', '/admin/users/[i:id]/update/', 'Admin\UserController@update');
$router->map('POST', '/admin/users/[i:id]/delete/', 'Admin\UserController@delete');

# payments routes
$router->map('GET', '/admin/payments[/]?', 'Admin\OrderController@index');

# orders routes
$router->map('GET', '/admin/orders[/]?', 'Admin\OrderController@index');
$router->map('GET', '/admin/orders/paid/[i:id]', 'Order\OrderController@markAsPaid');

/**
 * ========== User profile routes ==========
 */
$router->map('GET', '/profile[/]?', 'User\ProfileController@index');
$router->map('GET', '/profile/[i:id]/edit', 'User\ProfileController@edit');
$router->map('POST', '/profile/[i:id]/update', 'User\ProfileController@update');
$router->map('GET', '/profile/[i:id]/edit/password', 'User\ProfileController@editPassword');
$router->map('POST', '/profile/[i:id]/update/password', 'User\ProfileController@updatePassword');
$router->map('GET', '/profile/[i:id]/orders', 'User\ProfileController@orders');
