<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Seat Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f5f7fb;
            overflow:hidden;
        }

        .login-wrapper{
            display:flex;
            min-height:100vh;
        }

        /* LEFT PANEL */

        .left-panel{

            width:50%;
            background:linear-gradient(145deg,#071739,#0c2d72,#1d4ed8);
            color:white;
            padding:55px;
            position:relative;
            overflow:hidden;

        }

        .left-panel::before{

            content:'';
            position:absolute;
            width:550px;
            height:550px;
            border-radius:50%;
            border:1px solid rgba(255,255,255,.08);
            top:-180px;
            right:-180px;

        }

        .left-panel::after{

            content:'';
            position:absolute;
            width:350px;
            height:350px;
            background:rgba(255,255,255,.03);
            border-radius:50%;
            bottom:-120px;
            right:120px;

        }

        .logo{

            display:flex;
            align-items:center;
            gap:15px;

        }

        .logo-box{

            width:58px;
            height:58px;
            border-radius:16px;
            background:rgba(255,255,255,.12);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;

        }

        .system-name{

            font-size:30px;
            font-weight:700;

        }

        .tagline{

            opacity:.8;

        }

        .hero{

            margin-top:150px;

        }

        .hero small{

            font-size:22px;
            font-weight:500;

        }

        .hero h1{

            font-size:62px;
            font-weight:700;
            line-height:1.15;
            margin:15px 0;

        }

        .hero span{

            color:#7ea8ff;

        }

        .line{

            width:90px;
            height:5px;
            border-radius:30px;
            background:#4f7cff;
            margin:35px 0;

        }

        .hero p{

            max-width:540px;
            font-size:20px;
            line-height:1.8;
            opacity:.85;

        }

        .copyright{

            position:absolute;
            bottom:40px;
            left:55px;
            opacity:.75;

        }

        /* RIGHT */

        .right-panel{

            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#eef2f8;

        }

        .login-card{

            width:480px;
            background:rgba(255,255,255,.95);
            border-radius:22px;
            padding:45px;
            box-shadow:0 15px 45px rgba(0,0,0,.12);

        }

        .lock-icon{

            width:90px;
            height:90px;
            border-radius:50%;
            background:#edf3ff;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:42px;
            color:#2563eb;
            margin:auto;
            margin-bottom:25px;

        }

        h2{

            font-weight:700;
            text-align:center;

        }

        .subtitle{

            text-align:center;
            color:#6b7280;
            margin-bottom:35px;

        }

        .form-label{

            font-weight:600;

        }

        .form-control{

            height:58px;
            border-radius:14px;
            border:1px solid #d6deeb;
            padding-left:45px;

        }

        .input-group-text{

            background:white;
            border-radius:14px 0 0 14px;
            border-right:none;

        }

        .password-btn{

            border-left:none;
            background:white;

        }

        .btn-login{

            height:56px;
            border-radius:14px;
            font-size:18px;
            font-weight:600;
            background:#2563eb;
            border:none;
            transition:.3s;

        }

        .btn-login:hover{

            background:#1d4ed8;
            transform:translateY(-2px);

        }

        a{

            text-decoration:none;

        }

        @media(max-width:992px){

            .left-panel{

                display:none;

            }

            .right-panel{

                width:100%;

            }

            .login-card{

                width:90%;
                margin:20px;

            }

        }

    </style>

</head>

<body>

<div class="login-wrapper">

    <!-- LEFT -->

    <div class="left-panel">

        <div class="logo">

            <div class="logo-box">
                <i class="bi bi-easel2-fill"></i>
            </div>

            <div>

                <div class="system-name">Exam Seat</div>
                <div class="tagline">Management System</div>

            </div>

        </div>

        <div class="hero">

            <small>Welcome Back</small>

            <h1>

                Smart Exam
                <br>

                <span>Seat Management.</span>

            </h1>

            <div class="line"></div>

            <p>

                Efficiently manage examinations, hall allocation,
                seating arrangements and scheduling from one secure platform.

            </p>

        </div>

        <div class="copyright">

            © {{ date('Y') }} Exam Seat Management System

        </div>

    </div>

    <!-- RIGHT -->

    <div class="right-panel">

        <div class="login-card">

            <div class="lock-icon">
                <i class="bi bi-shield-lock"></i>
            </div>

            <h2>Sign In</h2>

            <p class="subtitle">
                Enter your credentials to continue
            </p>

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required>

                    </div>

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required>

                        <button class="input-group-text password-btn"
                                type="button"
                                onclick="togglePassword()">

                            <i class="bi bi-eye" id="eyeIcon"></i>

                        </button>

                    </div>

                </div>

                <div class="d-flex justify-content-between mb-4">

                    <div class="form-check">

                        <input class="form-check-input"
                               type="checkbox"
                               name="remember">

                        <label class="form-check-label">

                            Remember me

                        </label>

                    </div>

                    @if(Route::has('password.request'))

                        <a href="{{ route('password.request') }}">

                            Forgot Password?

                        </a>

                    @endif

                </div>

                <button class="btn btn-primary w-100 btn-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Sign In

                </button>

            </form>

        </div>

    </div>

</div>

<script>

    function togglePassword(){

        let password=document.getElementById("password");
        let eye=document.getElementById("eyeIcon");

        if(password.type==="password"){

            password.type="text";
            eye.classList.replace("bi-eye","bi-eye-slash");

        }else{

            password.type="password";
            eye.classList.replace("bi-eye-slash","bi-eye");

        }

    }

</script>

</body>
</html>