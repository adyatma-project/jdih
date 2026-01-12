<style>
    /* Menggunakan Variabel CSS yang sama dengan Home agar konsisten */
    :root {
        --primary: #2563eb;       
        --bg-body: #f8fafc;       
        --text-main: #0f172a;     
        --text-muted: #64748b;    
    }

    /* Header Section */
    .contact-header {
        background: linear-gradient(135deg, #2563eb, #0ea5e9);
        padding: 60px 0 80px;
        color: white;
        margin-bottom: -50px; /* Efek overlap */
        border-radius: 0 0 50px 50px;
    }

    .contact-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 2.5rem;
    }

    /* Contact Cards */
    .contact-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        text-align: center;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.1);
        border-color: var(--primary);
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #eff6ff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
        transition: all 0.3s;
    }

    .contact-card:hover .icon-box {
        background: var(--primary);
        color: #fff;
    }

    .card-label {
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .card-value {
        font-weight: 600;
        color: var(--text-main);
        font-size: 1.1rem;
    }

    /* Map Section */
    .map-container {
        background: #fff;
        padding: 15px;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        margin-top: 40px;
    }
    
    .map-frame {
        width: 100%;
        height: 450px;
        border-radius: 15px;
        border: 0;
    }
</style>

<div class="contact-header text-center">
    <div class="container">
        <h1 class="contact-title">Hubungi Kami</h1>
        <p class="opacity-75">Kami siap melayani kebutuhan informasi hukum Anda.</p>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center bg-transparent p-0 mt-3">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" class="text-white text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Kontak</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container" style="padding-bottom: 80px;">
    
    <div class="row g-4 justify-content-center">
        
        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="card-label">Alamat Kantor</div>
                <div class="card-value">
                    <?php echo isset($profil->alamat) ? $profil->alamat : '-'; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <div class="card-label">Email Resmi</div>
                <div class="card-value">
                    <?php 
                        $email = isset($profil->email) ? $profil->email : '-'; 
                        if($email != '-') {
                            echo '<a href="mailto:'.$email.'" class="text-decoration-none text-dark">'.$email.'</a>';
                        } else {
                            echo '-';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="icon-box">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="card-label">Telepon / Fax</div>
                <div class="card-value">
                    <?php echo isset($profil->no_telp) ? $profil->no_telp : '-'; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 align-items-center">
        <div class="col-lg-12">
            <div class="text-center mb-4">
                <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a;">
                    <?php echo isset($profil->nama_instansi) ? $profil->nama_instansi : 'JDIH Kabupaten Donggala'; ?>
                </h3>
                <p class="text-muted">Silakan kunjungi kantor kami pada jam kerja (Senin - Jumat, 08.00 - 16.00 WITA)</p>
            </div>
            
            <div class="map-container">
                <iframe 
                    class="map-frame"
                    src="https://maps.google.com/maps?q=<?php echo urlencode(isset($profil->alamat) ? $profil->alamat : 'Kantor Bupati Donggala'); ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

</div>