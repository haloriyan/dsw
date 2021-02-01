<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error {{ $code }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .container {
            position: absolute;
            top: 70px;left: 30%;right: 30%;
            text-align: center;
            font-family: Arial;
            color: #444;
        }
        .container p { font-size: 22px; }
        .container img {
            width: 90%;
        }
        .error {
            font-size: 200px;
            position: absolute;
            top: 150px;left: 20%;right: 20%;
            letter-spacing: 225px;
        }
        @media (max-width: 480px) {
            .container {
                left: 5%;right: 5%;top: 130px;
            }
            .container p { font-size: 18px; }
            .error {
                top: 45px;left: 5%;right: 5%;
                text-align: center;
                font-size: 50px;
                letter-spacing: 0px;
            }
        }
    </style>
</head>
<body>
    
<div class="error">{{ $code }}</div>

<div class="container">
    <img src="{{ asset('images/warning.png') }}">
    <p>{{ $message }}</p>
    <button class="biru mt-3 pl-5 pr-5" onclick="window.history.back(-1)">
        kembali
    </button>
</div>

</body>
</html>