<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Under Construction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 40px;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .loader {
            border: 5px solid rgba(255,255,255,0.3);
            border-top: 5px solid white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin: 0 auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            font-size: 14px;
            opacity: 0.8;
        }

        a {
            color: white;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>🚧 Coming Soon</h1>
        <p>We're working hard to launch our new website.<br>
           Stay tuned for something amazing!</p>
        <div class="loader"></div>
    </div>

    <footer>
        © 2026 Your Furnish Worlds
    </footer>

</body>
</html>