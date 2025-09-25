@extends('admin.layouts.auth')
@section('content')
    <div class="overflow-hidden p-3 acc-vh">

        <!-- start row -->
        <div class="row vh-100 w-100 g-0">

            <div class="col-lg-6 vh-100 overflow-y-auto overflow-x-hidden">

                <!-- start row -->
                <div class="row">
                    @if (session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                    @endif
                    <div class="col-md-10 mx-auto">
                        <form action="{{ route('login.attempt') }}" method="POST"
                            class=" vh-100 d-flex justify-content-between flex-column p-4 pb-0">
                            @csrf
                            <div class="text-center mb-4 auth-logo">
                                <h1>DEEDY RENTAL</h1>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <h3 class="mb-2">Sign In</h3>
                                    <p class="mb-0">Access the CRM panel using your email and passcode.</p>
                                </div>



                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group input-group-flat">
                                        <input type="email" class="form-control" name="email" value="">
                                        <span class="input-group-text">
                                            <i class="ti ti-mail"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat pass-group">
                                        <input type="password" class="form-control pass-input" name="password"
                                            placeholder="Password">
                                        <span class="input-group-text toggle-password ">
                                            <i class="ti ti-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="form-check form-check-md d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" value=""
                                            id="checkebox-md" checked="">
                                        <label class="form-check-label text-dark ms-1" for="checkebox-md">
                                            Remember Me
                                        </label>
                                    </div>
                                    <div class="text-end">
                                        <a href="forgot-password.html" class="link-danger fw-medium link-hover">Forgot
                                            Password?</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                </div>
                                <div class="mb-3">
                                    <p class="mb-0">New on our platform?<a href="/register"
                                            class="link-indigo fw-bold link-hover"> Create an account</a></p>
                                </div>


                            </div>
                            <div class="text-center pb-4">
                                <p class="text-dark mb-0">Copyright &copy;
                                    <script type="text/javascript">
                                        document.write(new Date().getFullYear())
                                    </script> - DEEDY RENTAL
                                </p>
                            </div>
                        </form>
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>

            <div class="col-lg-6 account-bg-01">
                <img src="/assets/img/auth/login-bg.jpg">
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
@endsection
