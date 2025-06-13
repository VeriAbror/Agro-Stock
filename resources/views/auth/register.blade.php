<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Stock - Register</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #A8E1E1; /* Warna Tosca yang lebih lembut */
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
            width: 90%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .register-wrapper {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .register-image {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-image img {
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .register-form {
            width: 55%; /* Lebarkan form menjadi 55% */
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-form h2 {
            color: #52C4D5;
            font-size: 28px;
            margin-bottom: 20px;
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
            transition: background-color 0.3s;
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

        /* Media query untuk tampilan responsif pada layar kecil */
        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .register-image {
                width: 100%;
                margin-bottom: 20px;
            }

            .register-form {
                width: 100%;
                max-width: 500px;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Back -->
    <a href="{{ route('home') }}">
        <button class="back-btn">Back</button>
    </a>

    <div class="container">
        <div class="register-wrapper">
            <div class="register-image">
                <img src="logoregis.png" alt="Register Image">
            </div>

            <div class="register-form">
                <h2>Register</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="input-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="btn">Register</button>
                </form>

                <div class="footer-links">
                    <p>Already registered? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
