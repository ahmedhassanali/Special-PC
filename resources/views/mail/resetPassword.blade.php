<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="text-align: center;">
        <img src="{{ asset('assets/ecommerce/img/special-pc-logo-dark.png') }}" alt="VerificationEmail" style="max-width: 150px; margin-bottom: 2px;">
    </div>

    <h2 style="text-align: center;">Password Reset</h2>

    <p>Hello,</p>

    <p>We have received a request to reset your password. Please use the following code to reset your password:</p>

    <h2 style="color: rgb(252, 143, 0); padding: 10px; text-align: center;">{{ $verificationCode }}</h2>

    <p>Enter the code above on the password reset page. If you did not request a password reset, you can safely ignore this email.</p>

    <p>Thank you,</p>
    <p>Ecommerce</p>
</body>

</html>
