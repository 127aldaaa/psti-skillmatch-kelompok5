<?php
include '../config.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM soal_tes WHERE id_soal='$id'");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents("php://input"), true);

    $pertanyaan = $input['pertanyaan'];
    $kategori   = $input['kategori'];

    $opsi_a = $input['opsi'][0]['teks_jawaban'];
    $opsi_b = $input['opsi'][1]['teks_jawaban'];
    $opsi_c = $input['opsi'][2]['teks_jawaban'];
    $opsi_d = $input['opsi'][3]['teks_jawaban'];

    $update = mysqli_query($conn, "
        UPDATE soal_tes SET
        pertanyaan='$pertanyaan',
        kategori='$kategori',
        opsi_a='$opsi_a',
        opsi_b='$opsi_b',
        opsi_c='$opsi_c',
        opsi_d='$opsi_d'
        WHERE id_soal='$id'
    ");

    if($update){

        echo json_encode([
            "success" => true,
            "message" => "Soal berhasil diperbarui"
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Soal</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg,#dbeafe,#eff6ff);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.container{
    width:100%;
    max-width:750px;
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,0.12);
}

.header{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    padding:25px;
    color:white;
}

.header h2{
    font-size:28px;
    margin-bottom:5px;
}

.header p{
    opacity:0.9;
    font-size:14px;
}

.form-content{
    padding:30px;
}

.form-group{
    margin-bottom:22px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #d1d5db;
    border-radius:12px;
    font-size:15px;
    transition:0.3s;
}

input:focus{
    border-color:#2563eb;
    outline:none;
    box-shadow:0 0 0 4px rgba(37,99,235,0.15);
}

.opsi-container{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
    margin-top:10px;
}

.opsi-box{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:15px;
}

.opsi-title{
    font-weight:bold;
    margin-bottom:10px;
    color:#2563eb;
}

.button-group{
    display:flex;
    gap:15px;
    margin-top:30px;
}

button{
    flex:1;
    padding:14px;
    border:none;
    border-radius:12px;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn-update{
    background:#2563eb;
    color:white;
}

.btn-update:hover{
    background:#1d4ed8;
}

.btn-kembali{
    background:#e5e7eb;
    color:#111827;
}

.btn-kembali:hover{
    background:#d1d5db;
}

@media(max-width:700px){

    .opsi-container{
        grid-template-columns:1fr;
    }

}

</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Edit Soal</h2>
        <p>Perbarui pertanyaan dan opsi jawaban</p>
    </div>

    <div class="form-content">

        <div class="form-group">
            <label>Pertanyaan</label>

            <input 
                type="text"
                id="pertanyaan"
                value="<?= $data['pertanyaan']; ?>"
                placeholder="Masukkan pertanyaan..."
            >
        </div>

        <div class="form-group">
            <label>Kategori</label>

            <input 
                type="text"
                id="kategori"
                value="<?= $data['kategori']; ?>"
                placeholder="Contoh: Pendidikan"
            >
        </div>

        <div class="form-group">

            <label>Opsi Jawaban</label>

            <div class="opsi-container">

                <div class="opsi-box">
                    <div class="opsi-title">Opsi A</div>

                    <input 
                        type="text"
                        id="opsiA"
                        value="<?= $data['opsi_a']; ?>"
                    >
                </div>

                <div class="opsi-box">
                    <div class="opsi-title">Opsi B</div>

                    <input 
                        type="text"
                        id="opsiB"
                        value="<?= $data['opsi_b']; ?>"
                    >
                </div>

                <div class="opsi-box">
                    <div class="opsi-title">Opsi C</div>

                    <input 
                        type="text"
                        id="opsiC"
                        value="<?= $data['opsi_c']; ?>"
                    >
                </div>

                <div class="opsi-box">
                    <div class="opsi-title">Opsi D</div>

                    <input 
                        type="text"
                        id="opsiD"
                        value="<?= $data['opsi_d']; ?>"
                    >
                </div>

            </div>

        </div>

        <div class="button-group">

            <button class="btn-kembali"
                onclick="window.location.href='data_soal.php'">
                Kembali
            </button>

            <button class="btn-update"
                onclick="updateSoal()">
                Update Soal
            </button>

        </div>

    </div>

</div>

<script>

function updateSoal(){

    const pertanyaan = document.getElementById('pertanyaan').value;
    const kategori   = document.getElementById('kategori').value;

    const opsi = [
        { teks_jawaban: document.getElementById('opsiA').value, label:"A" },
        { teks_jawaban: document.getElementById('opsiB').value, label:"B" },
        { teks_jawaban: document.getElementById('opsiC').value, label:"C" },
        { teks_jawaban: document.getElementById('opsiD').value, label:"D" }
    ];

    fetch('',{

        method:'POST',

        headers:{
            'Content-Type':'application/json'
        },

        body: JSON.stringify({
            pertanyaan,
            kategori,
            opsi
        })

    })

    .then(res => res.json())

    .then(data => {

        if(data.success){

            alert("✅ " + data.message);

            window.location.replace('data_soal.php');

        }else{

            alert("❌ " + data.message);

        }

    })

    .catch(() => {

        alert("❌ Gagal update soal");

    });

}

</script>

</body>
</html>