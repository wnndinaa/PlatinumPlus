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
            max-width: 600px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 600;
            transition: opacity 0.5s ease;
        }
    </style>
</head>
<body>
    @include('navigation')
    <div class="container">
        <div id="successMessage" class="success-message">
            You have successfully logged in!
        </div>
        <h1>Welcome to Platinum Plus</h1>
        <p>Your trusted platform for managing expert domains, publications, reports, and more. Explore the features and make the most out of your experience.</p>
    </div>

    <script>
        // Hide the success message after 5 seconds
        setTimeout(() => {
            const message = document.getElementById('successMessage');
            if (message) {
                // Fade out effect
                message.style.opacity = '0';
                // After transition, hide the element completely
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500); // match the CSS transition duration
            }
        }, 5000);
    </script>
</body>
</html>
