<!-- Homepage view -->
@extends('client.layouts.app')

@section('title', 'Home')

@section('content')
<style>
.product-img {
    height: 300px;
    object-fit: cover;
    border-radius: 0 ;
  }
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: black;
}
</style>

<div class="container-fluid my-5  ">
    <div class="row">
        <div class="col-12 p-0">
            <div class="position-relative">
                <img src="/assets/img_helper/first_image.avif" alt="Phone" class="img-fluid w-100" style="max-height: 600px;">
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                    <h2 class="fw-bold">Latest Tech, Unbeatable Prices!</h2>
                    <p class="lead">Explore electronics like smartphones, laptops, and more — all at deals you can't resist!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-light py-5">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center mb-4 mb-md-0">
            <img src="/assets/img_helper/phone1.jpg" alt="Phone" class="w-100">
        </div>
        <div class="col-md-6">
            <h3 class="mb-3">About Us</h3>
            <p>We’re more than just an online store — we’re your go-to destination for the latest in electronics. Our catalog is filled with high-performance gadgets, everyday tech essentials, and accessories that fit your lifestyle.</p>
            <p>From browsing to checkout, we’re here to make tech shopping easy, affordable, and enjoyable for everyone.</p>
            <p>At our core, we believe in delivering value — not just through competitive pricing, but through exceptional customer service, reliable products, and a seamless shopping experience. Whether you're a tech enthusiast, a casual shopper, or looking for the perfect gift, we offer something for everyone.</p>
            <p>We carefully curate our selection to ensure quality and innovation, partnering with trusted brands and emerging tech pioneers. Our mission is to connect people with the technology that empowers their daily lives — from smart home devices and cutting-edge smartphones to must-have accessories and more.</p>
            <p>Join our community of satisfied customers and experience a new way to shop electronics — where trust, variety, and support come standard.</p>
        </div>
    </div>
</div>  
<div class="container-fluid my-5 p-4">
    <h5 class="mb-4 text-center">Our Featured Products</h5>
    <div id="featuredCarousel" class="carousel slide mh-100" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($products->chunk(3) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row d-flex justify-content-center ">
                        @foreach ($chunk as $product)
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <div class="card product-card border-0 mb-4 shadow-sm rounded-3 h-100 overflow-hidden" style="transition: all 0.4s ease;">
                                    <a href="/products/{{ $product->id }}" class="text-decoration-none">
                                        <div class="position-relative">
                                            <div class="image-wrapper overflow-hidden" style="height: 300px;">
                                                <img src="/{{ $product->image_path }}" alt="{{ $product->name }}"
                                                    class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.6s ease;">
                                            </div>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0; transition: opacity 0.4s ease;"></div>
                                            <p class="text-center fw-bold text-dark text-decoration-none">{{$product->name}}</p>
                                            <p class="text-center fw-bold text-info text-decoration-none">{{$product->price}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


@endsection
