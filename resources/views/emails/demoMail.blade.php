<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
        }

        h3 {
            color: #333333;
        }

        h4 {
            color: #555555;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #218838;
        }

        p {
            color: #555555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>{{ $mailData['title'] }}</h3>
        <h4>{{ $mailData['body'] }}</h4>

        <p>Silahkan klik tombol berikut untuk merubah password Anda:</p>

        <a href="{{ env('APP_URL') }}/reset-password/{{ $mailData['token'] }}" class="button">Reset Password</a>

        <p>Link ini akan berlaku selama 1 hari.</p>

        <p>Terimakasih</p>
    </div>
</body>

</html>
