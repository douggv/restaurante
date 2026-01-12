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
    <title><?php include 'layout/nav.php'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --dorado: #c5a059; --oscuro: #1a1a1a; }
        
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
            padding: 50px 20px;
        }

        .card-register {
            background: rgba(255, 255, 255, 0.98);
            border: none;
            border-radius: 0;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 450px;
        }

        .card-header {
            background-color: var(--oscuro);
            color: var(--dorado);
            text-align: center;
            padding: 25px;
            border: none;
        }

        .card-header h2 { font-family: 'Playfair Display', serif; margin: 0; }

        .form-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #555; }
        
        .btn-register {
            background-color: var(--oscuro);
            color: var(--dorado);
            border: 1px solid var(--dorado);
            border-radius: 0;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-register:hover { background-color: var(--dorado); color: white; }
    </style>
</head>
<body>

    <?php include 'layout/nav.php'; ?>

    <div class="main-container">
        <div class="card card-register">
            <div class="card-header">
                <h2>Crear Cuenta</h2>
                <p class="small mb-0 text-white-50">Únete a nuestra experiencia culinaria</p>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="./app/controllers/controllers_cliente/register.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control rounded-0" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control rounded-0" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control rounded-0" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control rounded-0" name="telefono" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control rounded-0" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-register">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>