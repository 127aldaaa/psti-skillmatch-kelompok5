<!DOCTYPE html>
<html>
<head>
    <title>Tambah Hasil Tes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4">
            Tambah Hasil Tes
        </h2>

        <form action="proses_tambah.php" method="POST">

            <div class="mb-3">
                <label>Skor</label>

                <input type="number"
                       name="skor"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Rekomendasi</label>

                <input type="text"
                       name="rekomendasi"
                       class="form-control"
                       required>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Simpan

            </button>

        </form>

    </div>

</div>

</body>
</html>