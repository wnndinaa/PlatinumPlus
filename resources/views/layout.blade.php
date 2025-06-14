<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Platinum Plus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f8fa;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 240px;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            min-height: 90vh;
        }

        .pagination svg {
            height: 1rem;
            /* Reduce the size */
            width: 1rem;
        }

        .pagination nav>div:first-child {
            display: none;
            /* Optional: hide 'Showing x to y of z results' */
        }
    </style>
</head>

<body>

    {{-- Sidebar / Navigation --}}
    @include('navigation')

    <div class="container-fluid mt-5">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

</body>

</html>
