<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sintuaradjawane.payroll.id/login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: row;
        }

        .image-column {
            flex: 1;
            padding: 20px;
            text-align: center;
        }

        .image-column img {
            max-width: 100%;
            height: auto;
        }

        .form-column {
            flex: 1;
            padding: 20px;
        }

        .form {
            max-width: 300px;
            margin: 0 auto;
        }

        .form h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form label {
            display: block;
            margin-bottom: 8px;
        }

        .form input[type="text"],
        .form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form input[type="email"] {
            /* Menerapkan gaya yang sama seperti input password */
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
        <div class="form-column">
            <div class="form">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username">

                    <!-- Password -->
                    <label for="password">Kata Sandi</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password">

                    <div>
                        <input type="checkbox" name="remember" id="remember">Ingatkan saya
                    </div>
                    <br>
                    <button type="submit">Log in</button>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
