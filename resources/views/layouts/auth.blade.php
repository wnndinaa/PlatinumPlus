<!-- resources/views/layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Platinum Plus - Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
        }

        .main-content {
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 100px auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

</body>
</html>
