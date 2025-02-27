<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <nav>
        <x-homeLink>
            Home
        </x-homeLink>
        <x-aboutLink>
            About
        </x-aboutLink>
        <x-contactLink>
            Contact
        </x-contactLink>
    </nav>
    {{ $slot }}
</body>
</html>