<?php
include 'koneksi.php';

// Fungsi untuk membuat data anggota
function createAnggota($no_anggota, $nama, $alamat, $no_hp, $tgl_bergabung) {
    global $conn;

    $sql = "INSERT INTO anggota (no_anggota, nama, alamat, no_hp, tgl_bergabung) VALUES ('$no_anggota', '$nama', '$alamat', '$no_hp', '$tgl_bergabung')";
    if ($conn->query($sql) === TRUE) {
        echo " Data anggota berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk membaca data anggota
function readAnggota() {
    global $conn;

    $sql = "SELECT * FROM anggota";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>No. Anggota</th><th>Nama</th><th>Alamat</th><th>No. HP</th><th>Tgl Bergabung</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["no_anggota"]."</td><td>".$row["nama"]."</td><td>".$row["alamat"]."</td><td>".$row["no_hp"]."</td><td>".$row["tgl_bergabung"]."</td></tr>";
        }

        echo "</table>";
    } else {
        echo " Tidak ada data anggota.";
    }
}


// Fungsi untuk mengupdate data anggota
function updateAnggota($no_anggota, $nama, $alamat, $no_hp, $tgl_bergabung) {
    global $conn;

    $sql = "UPDATE anggota SET nama='$nama', alamat='$alamat', no_hp='$no_hp', tgl_bergabung='$tgl_bergabung' WHERE no_anggota='$no_anggota'";
    if ($conn->query($sql) === TRUE) {
        echo " Data anggota berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghapus data anggota
function deleteAnggota($no_anggota) {
    global $conn;

    $sql = "DELETE FROM anggota WHERE no_anggota='$no_anggota'";
    if ($conn->query($sql) === TRUE) {
        echo " Data anggota berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Memproses input form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $no_anggota = $_POST["no_anggota"];
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $no_hp = $_POST["no_hp"];
        $tgl_bergabung = $_POST["tgl_bergabung"];
        createAnggota($no_anggota, $nama, $alamat, $no_hp, $tgl_bergabung);
    } elseif (isset($_POST["update"])) {
        $no_anggota = $_POST["no_anggota"];
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $no_hp = $_POST["no_hp"];
        $tgl_bergabung = $_POST["tgl_bergabung"];
        updateAnggota($no_anggota, $nama, $alamat, $no_hp, $tgl_bergabung);
    } elseif (isset($_POST["delete"])) {
        $no_anggota = $_POST["no_anggota"];
        deleteAnggota($no_anggota);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    table {
        border-collapse: collapse;
    }
    table th, table td {
        padding: 30px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Tambah Anggota</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="no_anggota">No. Anggota:</label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No. HP:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="tgl_bergabung">Tgl Bergabung:</label>
            <input type="date" class="form-control" id="tgl_bergabung" name="tgl_bergabung" required>
        </div>
        <button type="submit" class="btn btn-primary" name="create">Tambah</button>
    </form>

    <br><br>
    <h2>Data Anggota</h2>
    <?php readAnggota()?>

    <br><br>
    <h2>Update Anggota</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="no_anggota">No. Anggota:</label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No. HP:</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="tgl_bergabung">Tgl Bergabung:</label>
            <input type="date" class="form-control" id="tgl_bergabung" name="tgl_bergabung" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>
    <br><br>
    <h2>Hapus Anggota</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="no_anggota">No. Anggota:</label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" required>
        </div>
        <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
    </form>

    <br>

    <a href="pinjaman.php" class="btn btn-success">Ke Halaman Pinjaman</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
