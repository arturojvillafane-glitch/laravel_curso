<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>{{ $msj2 }}</p>
    <p>{{ $age }}</p>
    <a href="{{ route('bio') }}">Welcome</a>

    @if($name !== "Andres Cruz")
    Es true
    @else
        no es pepe
        No es true
    @endif

</body>
</html>