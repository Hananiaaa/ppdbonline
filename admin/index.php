<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - PPDB Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6e9de2; /* Soft Blue */
            --secondary-color: #a4c3b2; /* Soft Sage */
            --border-radius: 0.4rem;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, var(--primary-color), var(--secondary-color));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        .card-header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
            text-align: center;
            font-size: 1.25rem;
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
            box-shadow: 0 4px 8px rgba(110, 157, 226, 0.4);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(110, 157, 226, 0.25);
        }
    </style>
</head>
<body>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">Login Admin</div>
        <div class="card-body p-4">
            <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                Username atau password salah!
            </div>
            <?php endif; ?>
            <form action="proses_login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>