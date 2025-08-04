<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            padding: 2rem 2.5rem;
            border: none;
            border-radius: 1.2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            max-width: 400px;
            width: 100%;
        }

        .header-text {
            font-size: 1.6rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        .btn-role {
            width: 100%;
            padding: 1rem;
            font-size: 1.15rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease-in-out;
        }

        .btn-role i {
            margin-right: 0.5rem;
            font-size: 1.3rem;
        }

        .btn-role:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <div class="header-text">Select Your Login Role</div>
        <div class="d-grid gap-3">
            <a href="{{ route('admin-login') }}" class="btn btn-primary btn-role">
                <i class="bi bi-shield-lock-fill"></i> Login as Admin
            </a>
            <a href="{{ route('login-page') }}" class="btn btn-outline-primary btn-role">
                <i class="bi bi-person-circle"></i> Login as User
            </a>
        </div>
    </div>
</body>
</html>
