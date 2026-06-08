<?php
include '../config.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM soal_tes WHERE id_soal='$id'");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents("php://input"), true);

    $pertanyaan = $input['pertanyaan'];

    $kategori_a = $input['kategori_a'];
    $kategori_b = $input['kategori_b'];
    $kategori_c = $input['kategori_c'];

    $opsi_a = $input['opsi'][0]['teks_jawaban'];
    $opsi_b = $input['opsi'][1]['teks_jawaban'];
    $opsi_c = $input['opsi'][2]['teks_jawaban'];

    $update = mysqli_query($conn, "
        UPDATE soal_tes SET
        pertanyaan='$pertanyaan',

        kategori_a='$kategori_a',
        kategori_b='$kategori_b',
        kategori_c='$kategori_c',

        opsi_a='$opsi_a',
        opsi_b='$opsi_b',
        opsi_c='$opsi_c'

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

            <label>Kategori A</label>

            <input 
                type="text"
                id="kategoriA"
                value="<?= $data['kategori_a']; ?>"
                placeholder="Contoh: Sistem Informasi"
            >

        </div>

        <div class="form-group">

            <label>Kategori B</label>

            <input 
                type="text"
                id="kategoriB"
                value="<?= $data['kategori_b']; ?>"
                placeholder="Contoh: Engineering"
            >

        </div>

        <div class="form-group">

            <label>Kategori C</label>

            <input 
                type="text"
                id="kategoriC"
                value="<?= $data['kategori_c']; ?>"
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

    const kategori_a = document.getElementById('kategoriA').value;
    const kategori_b = document.getElementById('kategoriB').value;
    const kategori_c = document.getElementById('kategoriC').value;

    const opsi = [

        {
            teks_jawaban: document.getElementById('opsiA').value,
            label:"A"
        },

        {
            teks_jawaban: document.getElementById('opsiB').value,
            label:"B"
        },

        {
            teks_jawaban: document.getElementById('opsiC').value,
            label:"C"
        }

    ];

    fetch('',{

        method:'POST',

        headers:{
            'Content-Type':'application/json'
        },

        body: JSON.stringify({

            pertanyaan,

            kategori_a,
            kategori_b,
            kategori_c,

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
```
