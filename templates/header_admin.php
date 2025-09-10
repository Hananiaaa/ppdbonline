<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PPDB Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6e9de2; /* Soft Blue */
            --secondary-color: #a4c3b2; /* Soft Sage */
            --white-bg: #ffffff;
            --border-radius: 0.4rem;
            --box-shadow: 0 4px 12px rgba(0,0,0,0.07);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
        }
        .navbar {
            background-color: var(--white-bg) !important;
            box-shadow: var(--box-shadow);
        }
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }
        .table .thead-dark th {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            background-color: var(--white-bg);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Admin PPDB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Pendaftar <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="proses_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>