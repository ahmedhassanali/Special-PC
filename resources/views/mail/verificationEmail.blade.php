<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="text-align: center;">
        <img src="{{ asset('assets/ecommerce/img/special-pc-logo-dark.png') }}" alt="VerificationEmail" style="max-width: 150px; margin-bottom: 2px;">
    </div>

    <h2 style="text-align: center;">Email Verification</h2>

    <p>Hello,</p>

    <p>Thank you for registering with us. Please use the following verification code to confirm your email address:</p>

    <h2 style="color: rgb(252, 143, 0); padding: 10px; text-align: center;">{{ $verificationCode }}</h2>

    <p>Enter the code above on the email verification page. If you did not create an account, you can safely ignore this email.</p>

    <p>Thank you,</p>
    <p>Ecommerce</p>
</body>
</html>
