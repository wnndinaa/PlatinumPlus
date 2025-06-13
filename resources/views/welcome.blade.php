<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Simple Homepage</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            text-align: center;
            padding: 100px;
        }

        .container {
            background: white;
            padding: 30px 40px;
            margin-left: 240px;
            box-sizing: border-box;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            display: inline-block;
            max-width: 900px;
            text-align: left;
        }

        .message {
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }


    </style>
</head>
<body>
    @include('navigation')

    <div class="container">
        @if(session('success'))
            <div class="message success-message">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="message error-message">{{ session('error') }}</div>
        @endif

        <h1>Welcome to Platinum Plus</h1>
        <p>Your trusted platform for managing expert domains, publications, reports, and more.</p>

        @php
            $user = session('user');
        @endphp

    <script>
        setTimeout(() => {
            const message = document.querySelector('.message');
            if (message) {
                message.style.opacity = '0';
                setTimeout(() => message.style.display = 'none', 500);
            }
        }, 5000);
    </script>
</body>
</html>
