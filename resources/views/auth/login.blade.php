<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>

    <section class="vh-100" style="background-color: #0F2C59; ">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-8  ">
                    <div class="card " style="border-radius: 1rem;margin-bottom:0px">
                        <div class="row g-0">
                            <div class="mt-5 col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('') }}assets/welcome.png" alt="login form"
                                    class="img-fluid" style="" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form class="was-validated"
                                         method="post" action="{{ route('login') }}">
                                        @csrf


                                        <h4 class="fw-normal mb-2 " style="letter-spacing: 1px;"> Login
                                        </h4>

                                        <div class="form-outline mb-2">
                                            <label class="form-label pb-1" style="font-size: 15px"
                                                for="login-email"> Email</label>

                                            <input required id="login-email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                type="email" name="email" placeholder=""
                                                aria-describedby="login-email" value="{{ old('email') }}"
                                                autofocus="" tabindex="1" />
                                            @error('email')
                                                @foreach ($errors->get('email') as $message)
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @endforeach

                                            @enderror

                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label pb-1" for="login-password"
                                                style="font-size: 15px">Password </label>

                                            <div class="input-group input-group-merge form-password-toggle">

                                                <input required
                                                    class="form-control form-control-merge form-control-lg @error('password') is-invalid @enderror"
                                                    id="login-password" type="password" name="password"
                                                    placeholder="············" aria-describedby="login-password"
                                                    tabindex="2" />
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="pt-1 ">
                                            <button class="btn btn-dark btn-lg btn-block">
                                                Sign In </button>
                                        </div>


                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
