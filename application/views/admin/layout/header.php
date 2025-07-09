<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            width: 16%;
            left: 0;
            height: 100%;
            transition: width 0.3s ease-in-out;
        }

        .sidebar.small {
            width: 5%;
        }

        .sidebar .content {
            font-size: 20px;
            max-width: 80%;
        }

        .sidebar.small .content {
            display: none;
        }

        .sidebar h1,
        .sidebar ul,
        .sidebar .logout-btn,
        .sidebar hr {
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
            max-width: 80%;
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

        .menu-btn:focus {
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
            max-height: 8%;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            /* Added border bottom instead of shadow */
            position: fixed;
            width: calc(100% - 16%);
            left: 16%;
            transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
            top: 0;
            z-index: 1000;
        }


        .header p {
            color: #5F5F5F;
        }

        .sidebar.small+.header {
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
            margin-left: 15%;
            padding: 2rem;
            transition: margin-left 0.3s ease-in-out;
            padding-top: 80px;
            padding-bottom: 100px;
            overflow-x: hidden;
        }

        .small+.main-content {
            margin-left: 5%;
        }

        .footer {
            background-color: #B7B7B7;
            padding: 1rem;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: calc(100% - 16%);
            left: 16%;
            max-height: 8%;
            transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .footer p {
            color: #4B4B4B;
        }

        .small+.footer {
            left: 5%;
            width: calc(100% - 5%);
        }

        .modal-body p {
            color: #4B4B4B;
        }

        .modal-title {
            color: #4B4B4B;
        }

        .btn {
            margin-bottom: 20px;
            text-decoration: none;
            color: white !important;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: #B00B0B !important;
        }

        .btn-secondary {
            background-color: #6c757d !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
        }

        .btn-warning {
            background-color: #6c757d !important;
            color: white !important;
        }

        .btn-delete {
            background-color: #B00B0B !important;
            color: white !important;
        }


        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table thead th,
        .table tbody td {
            color: black;
            font-size: 0.875rem;
        }

        .card-header h1 {
            display: inline-block;
            margin-right: 20px;
            font-size: 1.25rem;
        }

        .card {
            background-color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header {
            background-color: #DFDFDF;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-body {
            padding: 1rem;
        }

        .table thead th {
            border-bottom: 2px solid #B00B0B;
        }

        .table tbody td {
            border-bottom: 1px solid #B00B0B;
        }

        .modal-body p {
            text-align: justify;
        }

        .modal-content {
            border-radius: 8px;
        }

        .dataTables_filter {
            text-align: right;
            margin-bottom: 10px;
        }

        .dataTables_filter input {
            width: 300px;
            display: inline-block;
            vertical-align: middle;
        }

        .dataTables_length select {
            width: 100px;
            display: inline-block;
            vertical-align: middle;
        }

        .dataTables_paginate {
            float: right;
            margin-top: 10px;
        }

        .dataTables_paginate .paginate_button {
            padding: 0.5rem;
            margin-left: 2px;
            border-radius: 5px;
            cursor: pointer;
            color: #B00B0B !important;
            background-color: white;
            border: 1px solid #B00B0B;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #B00B0B;
            color: white !important;
        }

        .dataTables_paginate .paginate_button.disabled {
            pointer-events: none;
            color: #B00B0B !important;
            background-color: white;
            border: 1px solid #B00B0B;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dataTables_wrapper .dataTables_filter label {
            font-size: 0.75rem;
            white-space: nowrap;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background-color: white;
            border: 1px solid #B00B0B;
            color: black;
            overflow-x: hidden;
            height: 2rem;
            font-size: 0.75rem;
            padding: 0.25rem;
            width: 150px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        .card {
            background-color: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header {
            background-color: #DFDFDF;
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }
.card p{
    color: #4B4B4B;
}
        .card-body {
            padding: 1rem;
        }

        .btn-submit {
            display: block;
            width: 200px;
            /* Adjusted button width */
            margin: 20px auto;
            /* Centered the button */
            background-color: #B00B0B;
            /* Updated button color */
            color: white;
            /* Button text color */
            padding: 10px 20px;
            /* Added padding for better spacing */
            border: none;
            /* Removed border */
            border-radius: 25px;
            /* Rounded corners */
            font-size: 1rem;
            /* Adjusted font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Added box shadow for depth */
            transition: background-color 0.3s ease;
            /* Smooth transition for background color */
        }

        .btn-submit:hover {
            background-color: #900909;
            /* Darker shade on hover */
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            margin-bottom: 20px;
        }

        .form-group label {
            color: black;
            /* Set label color to black */
        }
        .notification-icon {
    position: relative;
    left: -20%; 
    margin-top: 10%;
    max-width: 30%;
}
.modal-lg {
    max-width: 80%;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.modal .close {
    position: absolute;
    left: 90%;
    max-width: 5%;
}

    </style>

</head>
<?php
// Ambil data notifikasi dari session
$countPending = $this->session->userdata('countPending');
// Ambil data untuk modal dari session
$modalData = $this->session->userdata('modalData');
?>
<body>
    <div class="sidebar " id="sidebar">
        <div class="header-container">
            <h1 class="content">PARANGTRITIS KLINIK AC MOBIL</h1>
            <button class="menu-btn" id="menuBtn">☰</button>
        </div>
        <hr class="content">
        <div class="nav-container">
            <div class="nav flex-column content">
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-item nav-link">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="<?php echo site_url('admin/data_member'); ?>" class="nav-item nav-link">
                    <i class="fas fa-users"></i> Data Member
                </a>

                <a href="<?php echo site_url('admin/transaksi'); ?>" class="nav-item nav-link">
                    <i class="fas fa-money-check-alt"></i> Transaksi
                </a>
                <a href="<?php echo site_url('admin/suku_cadang'); ?>" class="nav-item nav-link">
                    <i class="fas fa-tools"></i> Suku cadang
                </a>
                <a href="<?php echo site_url('admin/laporan'); ?>" class="nav-item nav-link">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
            </div>
        </div>

        <button class="logout-btn content" onclick="window.location.href='<?php echo base_url('auth/logout'); ?>'">Log Out</button>
    </div>

    <div class="header">
        <div class="welcome-text mt-4">
            <p>Selamat datang <?php echo isset($user['Nama']) ? $user['Nama'] : 'User'; ?><br>Halaman admin Parangtritis Klinik AC Mobil.</p>
        </div>
        <div class="user-info">
            <button type="button" class="btn btn-primary notification-icon" data-toggle="modal" data-target="#notificationModal">
                <i class="fas fa-bell"></i>
                <?php
                $countPending = $this->Request_model->count_pending_requests();
                if ($countPending > 0) {
                    echo   $countPending . '</span>';
                }
                ?>
            </button>
            <img src="https://via.placeholder.com/40" alt="User" width="40" height="40">
            <span><?php echo isset($user['Nama']) ? $user['Nama'] : 'User'; ?></span>
        </div>
    </div>
  