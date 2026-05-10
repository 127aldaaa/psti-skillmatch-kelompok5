<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    $pertanyaan = $data['pertanyaan'];
    $kategori   = $data['kategori'];

    $opsi_a = $data['opsi'][0]['teks_jawaban'];
    $opsi_b = $data['opsi'][1]['teks_jawaban'];
    $opsi_c = $data['opsi'][2]['teks_jawaban'];
    $opsi_d = $data['opsi'][3]['teks_jawaban'];

    $query = "INSERT INTO soal_tes
    (pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, kategori)
    VALUES
    ('$pertanyaan','$opsi_a','$opsi_b','$opsi_c','$opsi_d','$kategori')";

    if(mysqli_query($conn, $query)){

        echo json_encode([
            "success" => true,
            "message" => "Soal berhasil disimpan"
        ]);

    } else {

        echo json_encode([
            "success" => false,
            "message" => mysqli_error($conn)
        ]);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Soal</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .opsi-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .label {
            width: 30px;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit {
            background: #28a745;
            color: white;
        }

        .btn-submit:hover {
            background: #218838;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Tambah Soal Minat & Bakat</h2>

    <input type="text" id="pertanyaan" placeholder="Masukkan pertanyaan">
    <input type="text" id="kategori" placeholder="Kategori (contoh: pendidikan)">

    <h4>Opsi Jawaban</h4>

    <div class="opsi-box">
        <div class="label">A</div>
        <input type="text" id="opsiA" placeholder="Jawaban A">
    </div>

    <div class="opsi-box">
        <div class="label">B</div>
        <input type="text" id="opsiB" placeholder="Jawaban B">
    </div>

    <div class="opsi-box">
        <div class="label">C</div>
        <input type="text" id="opsiC" placeholder="Jawaban C">
    </div>

    <div class="opsi-box">
        <div class="label">D</div>
        <input type="text" id="opsiD" placeholder="Jawaban D">
    </div>

    <button class="btn-back"
    onclick="window.location.href='data_soal.php'">
    Kembali
</button>

    <button class="btn-submit" onclick="submitSoal()">Simpan Soal</button>

</div>

<script>
function submitSoal() {
    const pertanyaan = document.getElementById('pertanyaan').value;
    const kategori = document.getElementById('kategori').value;

    const opsi = [
        { teks_jawaban: document.getElementById('opsiA').value, label: "A" },
        { teks_jawaban: document.getElementById('opsiB').value, label: "B" },
        { teks_jawaban: document.getElementById('opsiC').value, label: "C" },
        { teks_jawaban: document.getElementById('opsiD').value, label: "D" }
    ];

    if (!pertanyaan) {
        alert("Pertanyaan wajib diisi!");
        return;
    }

    fetch('tambah_soal.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            pertanyaan,
            kategori,
            opsi
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            alert("✅ " + data.message);

            document.getElementById('pertanyaan').value = '';
            document.getElementById('kategori').value = '';

            document.getElementById('opsiA').value = '';
            document.getElementById('opsiB').value = '';
            document.getElementById('opsiC').value = '';
            document.getElementById('opsiD').value = '';

        } else {
            alert("❌ " + data.message);
        }

    })
    .catch(() => {
        alert("❌ Gagal menyimpan soal");
    });
}
</script>

</body>
</html>