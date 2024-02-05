<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>hello your reset password link </h2>
    <p>Here is token:{{$data}}</p>
    <a href="http://127.0.0.1:8000/resetpassword/{{$data}}">Click here</a>
</body>
</html>
