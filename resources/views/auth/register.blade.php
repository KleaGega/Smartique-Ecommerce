<!-- Register View -->
@extends('client.layouts.app')
@section('title', 'Register')
@section('content')
<div class="container my-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-2 p-sm-5">
                    <div class="text-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg>
                        <h2 class="mt-2 mb-1">Create Account</h2>
                        <p class="text-muted small">Fill in your details to register</p>
                    </div>
                    @include('client.layouts.messages')
                    <form action="/register/" method="post" id="registerForm" novalidate>
                        <input type="hidden" name="csrf" value="{{ \App\Core\CSRFToken::_token() }}">
                        <div class="mb-3">
                            <label for="fullname" class="form-label small fw-bold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                </span>
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your full name" required>
                                <div class="invalid-feedback">Please enter your full name</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                <div class="invalid-feedback">Please enter a valid email address</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                    </svg>
                                </span>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Choose a username" minLengthgth="5" required>
                                <div class="invalid-feedback">Username must be at least 5 characters</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" minLengthgth="6" required>
                                <div class="invalid-feedback">Password must be at least 6 characters</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label small fw-bold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm your password" required>
                                <div class="invalid-feedback">Passwords do not match</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label small fw-bold">Phone number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone text-primary" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 1 .58-.326h2.094c.266 0 .516.166.603.418l.683 1.99a.678.678 0 0 1-.15.69l-1.2 1.2a11.72 11.72 0 0 0 4.516 4.516l1.2-1.2a.678.678 0 0 1 .69-.15l1.99.683a.678.678 0 0 1 .418.603v2.094a.678.678 0 0 1-.326.58c-.443.296-1.05.737-1.512.94-.645.284-1.482.268-2.311-.112a16.978 16.978 0 0 1-6.223-6.223c-.38-.829-.396-1.666-.112-2.311.203-.462.644-1.07.94-1.512z"/>
                                    </svg>
                                </span>
                                <input id="phone" name="phone" class="form-control" rows="2" placeholder="Enter your phone number" required></input>
                                <div class="invalid-feedback">Please provide your phone number</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="form-label small fw-bold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                    </svg>
                                </span>
                                <input id="address" name="address" class="form-control" rows="2" placeholder="Enter your address" required></input>
                                <div class="invalid-feedback">Please provide your address</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="form-label small fw-bold">City</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                    </svg>
                                </span>
                                <input id="city" name="city" class="form-control" rows="2" placeholder="Enter your city" required></input>
                                <div class="invalid-feedback">Please provide your city</div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="postal_code" class="form-label small fw-bold">Postal Code</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt text-primary" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94C12.868 7.779 13.5 6.454 13.5 5a5.5 5.5 0 1 0-11 0c0 1.454.632 2.779 1.334 3.94C5.852 10.346 8 13 8 13s2.148-2.654 4.166-4.06zM8 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                    </svg>
                                </span>
                                <input id="postal_code" name="postal_code" class="form-control" rows="2" placeholder="Enter your postal code" required></input>
                                <div class="invalid-feedback">Please provide your postal code</div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-4 mb-3">
                            <button type="submit" class="btn btn-primary py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm.5 1.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-5 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM12 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM5.5 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM12 9.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </svg>
                                Register
                            </button>
                        </div>
                        <div class="text-center">
                            <p class="small text-muted mb-0">Already have an account? <a href="/login" class="text-primary fw-bold">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        form.addEventListener('submit', function(event) {
            let isValid = true;
            form.querySelectorAll('input[required]').forEach(function(element) {
                if (!element.value.trim()) {
                    element.classList.add('is-invalid');
                    isValid = false;
                } else {
                    element.classList.remove('is-invalid');
                }
            });
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value && !emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            const username = document.getElementById('username');
            if (username.value && username.value.length < 5) {
                username.classList.add('is-invalid');
                isValid = false;
            }
            if (password.value && password.value.length < 6) {
                password.classList.add('is-invalid');
                isValid = false;
            }
            if (password.value !== confirmPassword.value) {
                confirmPassword.classList.add('is-invalid');
                isValid = false;
            } else {
                confirmPassword.classList.remove('is-invalid');
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });

        form.querySelectorAll('input').forEach(function(element) {
            element.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
                
                if (this.id === 'password' || this.id === 'confirm_password') {
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.classList.add('is-invalid');
                    } else {
                        confirmPassword.classList.remove('is-invalid');
                    }
                }
            });
        });
    });
</script>
@endsection