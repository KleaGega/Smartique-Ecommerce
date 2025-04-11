<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartique - Premium Shopping</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-light text-dark py-2 small">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <i class="fas fa-gift me-2"></i>
                <span class="fw-light">Shop Now for Exclusive Deals</span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-light fs-2 text-uppercase" href="/">
                <span class="text-danger">S</span>martique
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <form class="d-flex mx-auto my-2 my-lg-0 col-12 col-lg-4" action="/products" method="GET">
                    <div class="input-group">
                        <input name="key" value="{{ (isset($_GET['key']) && $_GET['key']) ? $_GET['key'] : '' }}" class="form-control bg-light rounded-pill ps-4 border-0 shadow-sm" type="search" placeholder="Search exclusive products...">
                        <button class="btn btn-secondary rounded-pill position-absolute end-0 top-0 bottom-0 d-flex align-items-center justify-content-center" type="submit" style="width: 40px; z-index: 5;">
                            <i class="fa fa-search text-dark"></i>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                    <li class="nav-item px-1">
                        <a class="nav-link fw-semibold text-uppercase text-light" href="/">Home</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link fw-semibold text-uppercase text-light" href="/products/">Shop Now</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="/cart" class="btn btn-light bg-white text-dark rounded-circle p-2 shadow-sm position-relative">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white fw-semibold">
                        @if (\App\Core\Session::get('cart'))
                                {{ count(\App\Core\Session::get('cart'))}}  
                                @else
                                0
                        @endif                 
                        </span>
                    </a>
                    <a href="{{ is_logged_in() ? (is_admin() ? '/admin' : '/profile') : '/login' }}" class="btn btn-light bg-white text-dark rounded-circle p-2 shadow-sm">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
