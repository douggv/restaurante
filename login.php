<?php
    include 'app/config.php';
?>
<?php
    // incluimos la alerta desde alert.php
    include 'alert.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Sabor & Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { 
            --dorado: #c5a059; 
            --oscuro: #1a1a1a; 
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
        }

        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 20px; /* Un poco más de espacio arriba por el navbar */
        }

        .card-login {
            background: rgba(255, 255, 255, 0.98);
            border: none;
            border-radius: 0;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px; /* Un poco más angosto que el registro para elegancia */
        }

        .card-header {
            background-color: var(--oscuro);
            color: var(--dorado);
            text-align: center;
            padding: 30px;
            border: none;
        }

        .card-header h2 { 
            font-family: 'Playfair Display', serif; 
            margin: 0; 
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-label { 
            font-size: 0.75rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            color: #555; 
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 0;
            padding: 12px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: var(--dorado);
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.15);
        }
        
        .btn-login {
            background-color: var(--oscuro);
            color: var(--dorado);
            border: 1px solid var(--dorado);
            border-radius: 0;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover { 
            background-color: var(--dorado); 
            color: white; 
        }

        .footer-links a {
            color: var(--oscuro);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .footer-links a:hover {
            color: var(--dorado);
        }
    </style>
</head>
<body>

    <?php include 'layout/nav.php'; ?>

    <div class="main-container">
        <div class="card card-login">
            <div class="card-header">
                <i class="bi bi-shield-lock mb-2 fs-1"></i>
                <h2>Bienvenido</h2>
                <p class="small mb-0 text-white-50">Ingresa tus credenciales</p>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <?php if(isset($_SESSION['mensaje'])): ?>
                    <div class="alert <?= $_SESSION['color'] ?> py-2 small rounded-0">
                        <?= $_SESSION['mensaje'] ?>
                    </div>
                <?php endif; ?>

                <form action="./app/controllers/controllers_cliente/login.php" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="ejemplo@correo.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="********" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login mb-4">Entrar</button>

                    <div class="footer-links text-center">
                        <p class="mb-1"><a href="recuperar_password.php">¿Olvidaste tu contraseña?</a></p>
                        <p class="mb-0">¿No tienes cuenta? <a href="register.php" class="fw-bold">Regístrate aquí</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>