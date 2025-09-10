<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Online SMPN 1 Bawang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6e9de2; /* Soft Blue */
            --secondary-color: #79d1be; /* Soft Green Tosca */
            --white-bg: #ffffff;
            --text-color: #343a40;
            --border-radius: 0.8rem;
            --box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--text-color);
            min-height: 100vh;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.7) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: #333 !important; /* Darker text for better readability on light blur */
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(110, 157, 226, 0.3);
        }
        
        .btn-secondary {
             border-radius: var(--border-radius);
        }

        .card {
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            background-color: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .card-header {
            background: linear-gradient(45deg, rgba(110, 157, 226, 0.8), rgba(121, 209, 190, 0.8));
            color: var(--white-bg);
            font-weight: 600;
            border-bottom: none;
        }

        .form-control {
            border-radius: var(--border-radius);
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(110, 157, 226, 0.25);
            background-color: rgba(255, 255, 255, 0.8);
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">PPDB Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar.php">Pendaftaran</a></li>
                <li class="nav-item"><a class="nav-link" href="cek_status.php">Cek Pengumuman</a></li>
                <li class="nav-item"><a class="nav-link" href="admin/index.php">Login Admin</a></li>
            </ul>
        </div>
    </div>
</nav>