<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIA | Login</title>
    <!-- Favicon -->
    <link href="<?= base_url('assets/img/brand/favicon.png')?>" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg,rgb(236, 236, 236) 0%,rgb(0, 8, 241) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            border: none;
        }
        .logo {
            max-width: 120px;
            margin: 0 auto 1.5rem;
            display: block;
        }
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .btn-primary {
            background: #6366f1;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            width: 100%;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }
        .form-label {
            color: #374151;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .checkbox-label {
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <img src="<?= base_url('assets/img/brand/logo.png')?>" alt="Gurindam Jaya" class="logo">
            
            <form role="form" action="<?= base_url('login') ?>" method="post">
                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           placeholder="Enter username" value="<?= $data->username ?>" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Enter password" value="<?= $data->password ?>" required>
                </div>
                
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label checkbox-label" for="rememberMe">Remember me</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>

    <?php
    $formErrorUsername = form_error('username');
    $formErrorPassword = form_error('password');
    if(!empty($formErrorUsername) || !empty($formErrorPassword)):
    ?>
    <script>
        $(window).on('load', function(){
            let pesan = "<?= $formErrorUsername ?> \n <?= $formErrorPassword ?>";
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: pesan
            });
        });
    </script>
    <?php endif; ?>

    <?php
    $pesan = $this->session->flashdata('pesan_error');
    if(!empty($pesan)):
    ?>
    <script>
        $(window).on('load', function(){
            let pesan = "<?= $pesan ?>";
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: pesan
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>