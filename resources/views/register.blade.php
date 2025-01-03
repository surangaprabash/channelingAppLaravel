<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: #391919;
        }

        /*------------ Login container ------------*/

        .box-area {
            width: 930px;
        }

        /*------------ Right box ------------*/

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        /*------------ Custom Placeholder ------------*/

        ::placeholder {
            font-size: 16px;
        }

        .rounded-4 {
            border-radius: 20px;
        }

        .rounded-5 {
            border-radius: 30px;
        }

        /*------------ For small screens------------*/

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
            }

            .left-box {
                height: 100px;
                overflow: hidden;
            }

            .right-box {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Registration Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-4 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #334533;">
                <p class="text-white text-center fs-4" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">YouHeal-Hospital</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Connect with Expert Doctors on This Platform.</small>
            </div>

            <!---------------------- Right Box ---------------------------->

            <div class="col-md-8 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">

                        <h2 class="fs-3">Welcome to Our Healthcare Portal!</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="fs-6">Create your account to easily book appointments with our doctors. Your health and well-being are our top priorities.</p>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <input type="text" class="form-control form-control-lg bg-light fs-6" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <input type="text" class="form-control form-control-lg bg-light fs-6" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="input-group mb-1">
                                <input type="text" class="form-control form-control-lg bg-light fs-6" id="address" name="address" value="{{ old('address') }}" placeholder="Address">
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    <input type="text" class="form-control form-control-lg bg-light fs-6" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="Telephone">
                                </div>
                                <div class="col-md-4 mb-1">
                                    <input type="date" class="form-control form-control-lg bg-light fs-6" id="birth_day" name="birth_day" value="{{ old('birth_day') }}" placeholder="Birthday">
                                </div>
                                <div class="col-md-4 mb-1">
                                     <select class="form-control form-control-lg bg-light fs-6" id="gender" name="gender">
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group mb-1">
                                <input type="email" class="form-control form-control-lg bg-light fs-6" id="email" name="email" value="{{ old('email') }}" placeholder="Email address">
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" class="form-control form-control-lg bg-light fs-6" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" class="form-control form-control-lg bg-light fs-6" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        
                            <div class="input-group mb-1">
                                <button class="btn btn-lg btn-primary w-100 fs-6">Register</button>
                            </div>
                        </form>

                        <div class="row">
                            <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
