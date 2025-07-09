<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sidebar Only</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #B00B0B;
            color: white;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            width: 20%;
            left: 0;
            height: 100%;
            transition: width 0.3s ease-in-out;
        }
        .sidebar.small {
            width: 5%;
        }
        .sidebar.small .content {
            display: none;
        }
        .sidebar h1, .sidebar ul, .sidebar .logout-btn, .sidebar hr {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        .sidebar h1 {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-align: left;
            justify-content: center;
            flex-grow: 1;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 1.5rem;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .logout-btn {
            background-color: white;
            color: #2c3e50;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            max-width: 100%;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: auto;
        }
        .sidebar .logout-btn:hover {
            background-color: #34495e;
            color: white;
        }
        .sidebar hr {
            width: 100%;
            margin: 0 0 1.5rem 0;
        }
        .menu-btn {
            font-size: 1.5rem;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            max-width: min-content;
            transition: transform 0.3s ease-in-out;
            position: absolute;
            right: -15px;
            top: -15px;
            outline: none;
            box-shadow: none;
        }
        .menu-btn:focus{
            outline: none;
            box-shadow: none;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            position: relative;
        }
        .sidebar.small .menu-btn {
            left: 70%;
            
            transform: translateX(-75%);
        }
        .nav-container {
            display: flex;
            flex-direction: column;
        }
        .header {
            background-color: #DFDFDF;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: calc(100% - 20%);
            left: 20%;
            transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
            top: 0;
            z-index: 1000;
        }
        .header p {
            color: #5F5F5F;
        }
        .sidebar.small + .header {
            left: 5%;
            width: calc(100% - 5%);
        }
        .welcome-text {
            font-size: 1.2rem;
            color: #5F5F5F;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info img {
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        .main-content {
            flex: 1;
            margin-left: 20%;
            padding: 2rem;
            transition: margin-left 0.3s ease-in-out;
            padding-top: 80px;
        }
        .sidebar.small + .main-content {
            margin-left: 5%;
        }
        .footer {
            background-color: #B7B7B7;
            padding: 1rem;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: calc(100% - 20%);
            left: 20%;
            transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        .footer p {
            color: #4B4B4B;
        }
        .small + .footer {
            left: 5%;
            width: calc(100% - 5%);
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="header-container">
            <h1 class="content">PARANGTRITIS KLINIK AC MOBIL</h1>
            <button class="menu-btn" id="menuBtn">☰</button>
        </div>
        <hr class="content">
        <div class="nav-container">
            <div class="nav flex-column content">
                <a href="#" class="nav-item nav-link" data-toggle="collapse" data-target="#sparepartMenu">
                    <i class="fas fa-cogs"></i> <p>Sparepart</p>
                </a>
                <div class="collapse" id="sparepartMenu">
                    <a href="#" class="nav-item nav-link ml-3">Ac Mobil</a>
                    <a href="#" class="nav-item nav-link ml-3">Tune Up</a>
                    <a href="#" class="nav-item nav-link ml-3">Ganti Oli</a>
                    <a href="#" class="nav-item nav-link ml-3">Servis Mesin Ringan</a>
                </div>
            </div>
        </div>
        <button class="logout-btn content">Log Out</button>
    </div>
    
    <div class="header">
        <div class="welcome-text">
            <p>Selamat datang user!<br>Halaman inventory parangtritis klinik AC mobil.</p>
        </div>
        <div class="user-info">
            <img src="https://via.placeholder.com/40" alt="User" width="40" height="40">
            <span>User</span>
        </div>
    </div>
    
    <div class="main-content">
        <!-- Content goes here -->
    </div>

    <div class="footer">
        <p>2001 Copyright by PARANGTRITIS KLINIK AC MOBIL</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="collapse"]').on('click', function() {
                var target = $(this).attr('href');
                $(target).toggleClass('show');
            });

            $('#menuBtn').on('click', function() {
                $('#sidebar').toggleClass('small');
                $('.header').toggleClass('small');
                $('.main-content').toggleClass('small');
                $('.footer').toggleClass('small');
            });
        });
    </script>
</body>
</html>
