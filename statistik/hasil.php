<?php
$conn = mysqli_connect("localhost", "root", "", "learning");

$query = mysqli_query($conn, "SELECT * FROM hasil_tes WHERE id=1");
$data = mysqli_fetch_assoc($query);

$programming = $data['programming'];
$design = $data['design_graphic'];
$networking = $data['networking'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Statistik Hasil Tes</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<h2>Grafik Hasil Tes</h2>

<canvas id="myChart"></canvas>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Programming', 'Design', 'Networking'],
        datasets: [{
            label: 'Hasil Tes',
            data: [
                <?php echo $programming; ?>,
                <?php echo $design; ?>,
                <?php echo $networking; ?>
            ],
            borderWidth: 1
        }]
    }
});
</script>

</body>
</html>
