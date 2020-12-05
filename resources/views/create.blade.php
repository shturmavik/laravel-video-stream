<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.min.css">
    <title>Enter PIN</title>
</head>
<body class="bg-gray-600 flex h-screen items-center justify-center">
<form action="{{ route('pin.store') }}" method="POST">
    @csrf
    <input type="number" placeholder="Введите пароль" required name="pin" class="form-input text-xl">
    <button type="submit" class="form-input p-2 text-xl">Открыть</button>
</form>
</body>
</html>
