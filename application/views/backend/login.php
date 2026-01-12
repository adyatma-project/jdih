<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | JDIH Anggota Kabupaten Donggala</title>
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>template/ico/favicon.png" />

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #1e40af;
            --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fff;
            height: 100vh;
            overflow: hidden; /* Mencegah scroll bar ganda */
        }

        .login-wrapper {
            height: 100vh;
            display: flex;
            width: 100%;
        }

        /* --- SISI KIRI (VISUAL) --- */
        .left-side {
            flex: 1;
            background: var(--primary-gradient);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            text-align: center;
            overflow: hidden;
        }

        /* Pattern Background (Optional) */
        .left-side::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png'); /* Pattern halus */
            opacity: 0.1;
            animation: rotateBg 60s linear infinite;
        }

        @keyframes rotateBg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-content img {
            width: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
            animation: floatLogo 3s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* --- SISI KANAN (FORM) --- */
        .right-side {
            flex: 0 0 500px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            position: relative;
            box-shadow: -10px 0 30px rgba(0,0,0,0.05);
        }

        .login-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control-lg {
            font-size: 0.95rem;
            padding: 15px 20px;
            border-radius: 12px;
            border: 2px solid #f1f5f9;
            background-color: #f8fafc;
            transition: all 0.3s;
        }

        .form-control-lg:focus {
            background-color: #fff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-login {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .footer-copyright {
            position: absolute;
            bottom: 20px;
            left: 0; right: 0;
            text-align: center;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Responsif untuk Tablet & HP */
        @media (max-width: 992px) {
            .left-side { display: none; } /* Sembunyikan sisi kiri di layar kecil */
            .right-side { flex: 1; width: 100%; padding: 30px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    
    <div class="left-side">
        <div class="brand-content">
            <img src="<?php echo base_url('/assets/img/donggala.png'); ?>" alt="Logo Donggala">
            <h2 class="fw-bold mb-2">JDIH DONGGALA</h2>
            <p class="fs-5 opacity-75 fw-light">Jaringan Dokumentasi dan Informasi Hukum</p>
            <div style="width: 50px; height: 3px; background: rgba(255,255,255,0.5); margin: 20px auto;"></div>
            <p class="small opacity-75">"Mewujudkan Transparansi dan Aksesibilitas<br>Informasi Hukum Daerah"</p>
        </div>
    </div>

    <div class="right-side">
        
        <div class="login-header">
            <div class="d-lg-none mb-3">
                <img src="<?php echo base_url('/assets/img/donggala.png'); ?>" width="70" alt="Logo">
            </div>
            
            <h3 class="fw-bold text-dark">Selamat Datang! 👋</h3>
            <p class="text-muted">Silakan login untuk masuk ke panel anggota.</p>
        </div>

        <div class="w-100">
            <?php if(validation_errors()): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?php echo validation_errors(); ?></div>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('result_login')): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i>
                    <div><?php echo $this->session->flashdata('result_login'); ?></div>
                </div>
            <?php endif; ?>
        </div>

        <form action="<?php echo base_url('backend/index'); ?>" method="post">
            
            <div class="mb-3">
                <label class="form-label fw-bold small text-uppercase text-muted ls-1">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-person text-primary"></i></span>
                    <input type="text" name="username" id="username" class="form-control form-control-lg bg-light border-0" placeholder="Masukkan username" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small text-uppercase text-muted ls-1">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-primary"></i></span>
                    <input type="password" name="password" id="password" class="form-control form-control-lg bg-light border-0" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" name="submit" class="btn-login">
                MASUK <i class="bi bi-box-arrow-in-right ms-2"></i>
            </button>

            <div class="text-center mt-4">
                <a href="<?php echo base_url(); ?>" class="text-decoration-none text-muted small hover-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
                </a>
            </div>

        </form>

        <div class="footer-copyright">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Bagian Hukum Kab. Donggala.</p>
            <small>Versi 1.2.2</small>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>