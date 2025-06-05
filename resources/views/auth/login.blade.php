<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh; margin: 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-1 rounded-lg">
                    <div class="card-header">
                        <div class="d-flex justify-content-center">
                            <img class="text-center mt-4" src="{{ asset('assets/img/logosmp.png') }}" alt=""
                                width="20%">
                        </div>
                        <h3 class="text-center font-weight-light mt-4">Login Sistem Administrasi</h3>
                        <h4 class="text-center font-weight-light mt-3">SMP Nuhuudliyah Srono</h4>
                    </div>
                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    type="email" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com" required />
                                <label for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                    type="password" name="password" placeholder="Password" required />
                                <label for="inputPassword">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                        name="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="inputRememberPassword">Remember
                                        Password</label>
                                </div>
                                <div>
                                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="mt-5 mb-3">
                                <button class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>
