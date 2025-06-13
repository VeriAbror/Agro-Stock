<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Stock - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #A8E1E1; /* Warna Tosca yang lebih lembut dan terang */
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 30px; /* Menambahkan jarak antara gambar dan form login */
        }

        .login-image {
            width: 40%; /* Mengubah lebar gambar */
        }

        .login-image img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-form {
            width: 55%; /* Menyesuaikan lebar form agar proporsional */
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            color: #52C4D5;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center; /* Menambahkan ini agar teks Login berada di tengah */
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #52C4D5;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #3ba4b2;
        }

        .footer-links {
            text-align: center;
            margin-top: 15px;
        }

        .footer-links a {
            color: #52C4D5;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Tombol Back */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #52C4D5;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #3ba4b2;
        }
    </style>
</head>
<body>
    <!-- Tombol Back -->
    <a href="{{ route('home') }}">
        <button class="back-btn">Back</button>
    </a>

    <div class="container">
        <div class="login-wrapper">
            <div class="login-image">
                <img src="logologin.png" alt="Login Image">
            </div>

            <div class="login-form">
                <h2>Login</h2>
                @if ($errors->any())
                    <div style="background:#ffdddd;color:#b71c1c;padding:10px 15px;border-radius:5px;margin-bottom:15px;text-align:center;">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Email" class="input-field" required>
                    <input type="password" name="password" placeholder="Password" class="input-field" required>
                    <button type="submit" class="btn">Login</button>
                </form>
                
                <div class="footer-links">
                    <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>