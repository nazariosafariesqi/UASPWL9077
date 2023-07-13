<?php
include 'koneksi.php';

// Fungsi untuk membuat data pinjaman
function createPinjaman($no_pinjaman, $no_anggota, $tgl_pinjaman, $nominal, $tenor) {
    global $conn;

    $maxNominal = getMaxNominal($tenor);

    if ($nominal > $maxNominal) {
        echo " Nominal pinjaman melebihi batas maksimal untuk tenor yang dipilih.";
        return;
    }

    $sql = "INSERT INTO Pinjaman (no_pinjaman, no_anggota, tgl_pinjaman, nominal, tenor) VALUES ('$no_pinjaman', '$no_anggota', '$tgl_pinjaman', '$nominal', '$tenor')";
    if ($conn->query($sql) === TRUE) {
        echo " Data pinjaman berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mendapatkan batas nominal maksimal berdasarkan tenor
function getMaxNominal($tenor) {
    if ($tenor == 3) {
        return 1500000;
    } elseif ($tenor == 9) {
        return 4500000;
    } elseif ($tenor == 15) {
        return 9000000;
    }
}

// Memproses input form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $no_pinjaman = $_POST["no_pinjaman"];
        $no_anggota = $_POST["no_anggota"];
        $tgl_pinjaman = $_POST["tgl_pinjaman"];
        $nominal = $_POST["nominal"];
        $tenor = $_POST["tenor"];
        createPinjaman($no_pinjaman, $no_anggota, $tgl_pinjaman, $nominal, $tenor);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pinjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Form Pinjaman</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="no_pinjaman">No. Pinjaman:</label>
            <input type="text" class="form-control" id="no_pinjaman" name="no_pinjaman" required>
        </div>
        <div class="form-group">
            <label for="no_anggota">No. Anggota:</label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" required>
        </div>
        <div class="form-group">
            <label for="tgl_pinjaman">Tgl. Pinjaman:</label>
            <input type="date" class="form-control" id="tgl_pinjaman" name="tgl_pinjaman" required>
        </div>
        <div class="form-group">
            <label for="nominal">Nominal:</label>
            <input type="text" class="form-control" id="nominal" name="nominal" required>
        </div>
        <div class="form-group">
            <label for="tenor">Tenor:</label>
            <select class="form-control" id="tenor" name="tenor" required>
                <option value="3">3 Bulan</option>
                <option value="9">9 Bulan</option>
                <option value="15">15 Bulan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="create">Tambah</button>
    </form>

    <br>

    <a href="anggota.php" class="btn btn-success">Ke Halaman Anggota</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
