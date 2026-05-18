<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Rekomendasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f5f5f5;
            font-family:Arial;
        }

        .topbar{
            background:linear-gradient(to right,#007bff,#0056ff);
            padding:20px;
            border-bottom-left-radius:20px;
            border-bottom-right-radius:20px;
            color:white;
        }

        .logo{
            width:80px;
            border-radius:50%;
            background:white;
            padding:5px;
        }

        .menu-card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .menu-card:hover{
            transform:translateY(-5px);
        }

        .icon-box{
            width:70px;
            height:70px;
            border-radius:20px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
            color:white;
        }

        .blue{
            background:#0d6efd;
        }

        .green{
            background:#198754;
        }

        .purple{
            background:#6f42c1;
        }

        .orange{
            background:#fd7e14;
        }

        .section-title{
            font-size:40px;
            font-weight:bold;
            margin-bottom:20px;
        }

        a{
            text-decoration:none;
            color:black;
        }

    </style>

</head>

<body>

<div class="topbar">

    <div class="d-flex align-items-center">

        <img src="logo.png" class="logo me-3">

        <div>
            <h2>
                Sistem Rekomendasi Mahasiswa
            </h2>

            <p class="mb-0">
                PSTI SkillMatch
            </p>
        </div>

    </div>

</div>

<div class="container mt-5">

    <h1 class="section-title">
        Recent
    </h1>

    <div class="row g-4">

        <div class="col-md-6">

            <a href="history.php">

                <div class="menu-card">

                    <div class="d-flex">

                        <div class="icon-box blue me-4">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <div>

                            <h3>
                                Riwayat Tes
                            </h3>

                            <p>
                                Lihat semua hasil tes sebelumnya
                            </p>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-md-6">

            <a href="terbaru.php">

                <div class="menu-card">

                    <div class="d-flex">

                        <div class="icon-box green me-4">
                            <i class="bi bi-award-fill"></i>
                        </div>

                        <div>

                            <h3>
                                Rekomendasi Terbaru
                            </h3>

                            <p>
                                Hasil rekomendasi terbaru
                            </p>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-md-6">

            <a href="compare.php">

                <div class="menu-card">

                    <div class="d-flex">

                        <div class="icon-box purple me-4">
                            <i class="bi bi-book-fill"></i>
                        </div>

                        <div>

                            <h3>
                                Compare Hasil
                            </h3>

                            <p>
                                Bandingkan hasil lama dan baru
                            </p>

                        </div>

                    </div>

                </div>

            </a>

        </div>

       

    </div>

</div>

</body>
</html>