<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Pro-X</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@2.0.0/modern-normalize.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/index.css') }}">
    <script src="https://kit.fontawesome.com/973236d171.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg">
</head>

<body>
    <nav class="nav">
        <div class="container">
            <div class="brand"><img src="{{ url('asset/images/logo.png') }}"></div>
            <div class="menu">
                <a class="menu-item menu-item-active float-left" href="">BERANDA</a>
            </div>
            <div class="ctas">
                <a class="sign-up" href="{{ route('login') }}">MASUK</a>
                <a class="sign-up" href="{{ route('register') }}">DAFTAR</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="hero">
            <h1 class="hero-headline">Haloo, Selamat Datang Di <span class="biru">Inventaris Pro-X</span>
                <br>Ciptakan <span class="biru">Inventaris</span> Yang Terorganisir
            </h1>
            <div class="hero-subline">
                <ul>
                    <li><i class="fa-regular fa-circle-check"></i><a class="subline"> Pemakaian Mudah</a></li>
                    <li><i class="fa-regular fa-circle-check"></i><a class="subline"> Hemat Waktu</a></li>
                    <li><i class="fa-regular fa-circle-check"></i><a class="subline"> Intensif Jangka Panjang</a></li>
                </ul>
            </div>
            <a class="hero-ctas" href="{{ route('register') }}">MULAI SEKARANG</a>
            <div class="img1">
                <img src="{{ url('asset/images/gambar1.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="sponsor-container">
        <div class="sponsor-headline">
            <h1>Sponsor</h1>
            <div class="sponsor-nav">
                <ul>
                    <li><img src="{{ url('asset/images/sp1.png') }}" alt="">|</li>
                    <li><img src="{{ url('asset/images/sp2.png') }}" alt="">|</li>
                    <li><img src="{{ url('asset/images/sp3.png') }}" alt="">|</li>
                    <li><img src="{{ url('asset/images/sp4.png') }}" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="ttg">
            <h1 class="ttg-headline">Tentang</h1>
            <div class="ttg-subline">
                <p>
                    Kami adalah tim yang berdedikasi untuk membantu Anda mengelola inventaris dengan lebih efisien.
                    Kami berkomitmen untuk memberikan dukungan terbaik kepada pelanggan kami
                    dan terus memperbarui layanan kami agar selalu memenuhi kebutuhan Anda.
                    Layanan kami menjadi solusi terkemuka untuk pengelolaan inventaris di seluruh dunia,
                    dengan fokus pada kemudahan penggunaan, keamanan data, dan pelayanan pelanggan yang unggul.
                </p>
            </div>
        </div>
        <div class="card-body">
            <div class="container-card">
                <div class="card">
                    <div class="head-card">
                        <img src="{{ url('asset/images/ttg1.png') }}" alt="">
                    </div>
                    <div class="body-card">
                        <h1>Harga Kompetitif</h1>
                        <p>Kami menawarkan harga yang bersaing agar layanan kami dapat diakses oleh berbagai jenis
                            bisnis.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="head-card">
                        <img src="{{ url('asset/images/ttg2.png') }}" alt="">
                    </div>
                    <div class="body-card">
                        <h1>Fleksibilitas</h1>
                        <p>Layanan kami dapat disesuaikan dengan kebutuhan bisnis Anda, tidak peduli seberapa besar atau
                            kecilnya.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="head-card">
                        <img style="margin-top:-80px" src="{{ url('asset/images/ttg3.png') }}" alt="">
                    </div>
                    <div class="body-card">
                        <h1>Fremium</h1>
                        <p>Kami menawarkan model 'freemium' yang memungkinkan Anda dapat menggunakan layanan gratis
                            hingga batas penggunaan tertentu. Setelah melewati batas ini, beberapa fitur mungkin
                            dinonaktifkan. Untuk akses penuh, Anda dapat mempertimbangkan berlangganan versi berbayar.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="head-card">
                        <img style="margin-top:-100px" src="{{ url('asset/images/ttg4.png') }}" alt="">
                    </div>
                    <div class="body-card">
                        <h1>Inovasi Berkelanjutan</h1>
                        <p>Kami terus memperbarui layanan kami agar selalu sesuai dengan perkembangan terkini dalam
                            manajemen inventaris.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="hero">
            <h1 class="hero-headline">Bersama, Kita Bisa Ciptakan <br>Pengalaman <span class="biru">Inventaris</span>
                Yang <br> Luar Biasa!
            </h1>
            <div class="hero-subline2">
                <p>
                    Zona tanpa resiko, coba sekarang dan rasakan perbedaannya!!
                </p>
            </div>
            <a class="hero-ctas" href="{{ route('register') }}">MULAI SEKARANG</a>
            <div class="img2">
                <img src="{{ url('asset/images/gambar2.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="footer-container">
        <div class="footer-nav">
            <ul>
                <li>Layanan</li>
                <li>Dukungan</li>
                <li>Perusahaan</li>
                <li>Kebijakan</li>
                <li>Peluang</li>
            </ul>
        </div>
        <div class="footer-icon">
            <ul>
                <li><i class="fa-regular fa-envelope"></i></li>
                <li><i class="fa-regular fa-calendar"></i></li>
                <li><i class="fa-solid fa-comment-dots"></i></li>
                <li><i class="fa-solid fa-shield-halved"></i></li>
                <li><i class="fa-regular fa-clock"></i></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>© 2023 InventarisPro-X. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> -->
</body>

</html>
