@extends('admin.layouts.auth')
@section('content')

    <div class="overflow-hidden p-3 acc-vh">
        <div class="row vh-100 w-100 g-0">
            <div class="col-lg-6 vh-100 overflow-y-auto overflow-x-hidden">
                <div class="row">
                    <div class="col-md-10 mx-auto">


                        <form action="{{ route('register.save') }}" method="POST"
                            class="vh-100 d-flex justify-content-between flex-column p-4 pb-0">
                            @csrf
                            <div class="text-center mb-3 auth-logo">
                                <h1>DEEDY RENTAL</h1>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div>
                                <div class="mb-3">
                                    <h3 class="mb-2">Register</h3>
                                    <p class="mb-0">Create new CRMS account</p>
                                </div>
                                <div id="responseMsg"></div>
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="full_name" class="form-control" required>
                                        <span class="input-group-text">
                                            <i class="ti ti-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group input-group-flat">
                                        <input type="email" name="email" class="form-control" required value="">
                                        <span class="input-group-text">
                                            <i class="ti ti-mail"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat pass-group">
                                        <input type="password" name="password" class="form-control pass-input" required>
                                        <span class="input-group-text toggle-password ">
                                            <i class="ti ti-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-flat pass-group">
                                        <input type="password" name="confirm_password" class="form-control pass-input"
                                            required>
                                        <span class="input-group-text toggle-password ">
                                            <i class="ti ti-eye-off"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="form-check form-check-md d-flex align-items-center">
                                        <input class="form-check-input mt-0" type="checkbox" name="terms" id="checkbox-md"
                                            required>
                                        <label class="form-check-label ms-1" for="checkbox-md">I agree to the <a
                                                href="javascript:void(0);" class="text-primary link-hover">Terms &
                                                Privacy</a></label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                </div>
                                <div class="mb-3">
                                    <p class="mb-0">Already have an account? <a href="/"
                                            class="link-indigo fw-bold link-hover"> Sign In Instead</a></p>
                                </div>
                            </div>
                            <div class="text-center pb-4">
                                <p class="text-dark mb-0">Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> - DEEDY RENTAL
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 account-bg-02">
                <img src="/assets/img/auth/register-bg.jpg">
            </div>
        </div>
    </div>

@endsection
