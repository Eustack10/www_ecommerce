<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .parent{
            width:100%;
        }
        .child{
            background: rgba(0,0,0,0.12);
            text-align: center;
            padding:20px;
            border-radius: 5px
        }

        .btn{
            text-decoration: none;
            margin-top: 20px;
            padding:10px 30px;
            border:none;
            background-color: #3abaff;
            color: #202020;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="parent">
        <div class="child">
            <h1>Password Reset</h1>
            <p>
                Dear {{ $mailData['name'] }}, recently you tried "Reset Password" for your account "{{ $mailData['email'] }}".    <br>
                Your reset password link is below
            </p>
            <div>
                <a href="{{ route('resetPassword', $mailData['verify_code']) }}" class="btn">Reset Password</a>
            </div>
        </div>
    </div>
</body>
</html>