<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Welcome to our Food ordering application</h2>
    <h4>your verification code:{{$data}}</h4>
    <p>Please click this link <a href="http://127.0.0.1:8000/activeaccount/{{$data}}">Click</a></p>
    <h2>For andorid app</h2>
    <p>Please click this link <a href="exp://192.168.0.104:19000/{{$data}}">Click</a></p>
</body>
</html>
