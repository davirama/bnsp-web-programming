<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Akun Pastiori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
        }

        h4 {
            color: #666;
        }

        p {
            margin-bottom: 20px;
            color: #777;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>{{ $mailData['title'] }}</h3>
        <h4>{{ $mailData['body'] }}</h4>

        <p>Silahkan klik tombol berikut untuk konfirmasi Akun Pastiori Anda:</p>

        <a href="{{ env('APP_URL') }}/confirm-account/{{ $mailData['token'] }}" class="button">Konfirmasi Akun</a>


    </div>
</body>

</html>
