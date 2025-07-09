<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #DFDFDF;
            padding: 10px 20px;
            border-bottom: 2px solid #900;
        }
        .header h1, .header p, .header span {
            margin: 0;
            color: #5F5F5F;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info img {
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="welcome-message">
            <h1>Selamat datang !</h1>
            <p>Halaman inventory parangtritis klinik AC mobil.</p>
        </div>
        <div class="user-info">
            <img src="assets/img/user.png" alt="User Avatar" width="40" height="40">
            <span>User</span>
        </div>
    </header>
</body>
</html>
