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

        .flash-container {
            max-width: 500px;
            margin: 40px auto -20px auto;
        }
    </style>
</head>
<body>

    {{-- Flash Message Container --}}
    <div class="container flash-container">
        @if(session('success'))
            <div id="logout-success" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <div class="container">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Auto-hide flash success alert after 5 seconds --}}
    <script>
        setTimeout(function () {
            const alert = document.getElementById('logout-success');
            if (alert) {
                // Bootstrap fade-out
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => {
                    alert.remove();
                }, 300); // Wait for fade-out transition
            }
        }, 5000);
    </script>

</body>
</html>
