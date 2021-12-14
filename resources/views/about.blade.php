<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Привет, это страничка по адресу /about</h1>

    <div>
        <p>{{ $n ?? '' }}</p>
    </div>

    <a href="{{ route('about', ['numb' => 1]) }}">page 1</a>
    <br>
    <a href='{{ route('about', ['numb' => 2]) }}'>page 2</a>
    <br>
    <a href='{{ route('about', ['numb' => 3]) }}'>page 3</a>
</body>
</html>