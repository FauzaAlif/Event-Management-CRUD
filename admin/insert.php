<?php
// Sertakan file koneksi
require_once "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List App</title>
    <link rel="stylesheet" href="../style/indexstyle.css">
</head>
<body>

<div class="sidebar">
        <div class="logo"><img src="" alt=""></div>
            <ul class="menu">
                <li>
                    <a href="./index.php">
                        <h4>Dashboard</h4>
                    </a>
                </li>
                <li >
                    <a href="./edit.php">
                        <h4>List Data</h4>
                    </a>
                </li>
                <li class="active">
                    <a href="./insert.php">
                        <h4>Insert Data</h4>
                    </a>
                </li>
            </ul>
        </div>

    <div class="main--content">
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class=>
                    <label for="event" class="form-label">Nama Event</label>
                    <input type="text" class="form-control" id="event" name="event" required>
                </div>
    
                <div class=>
                    <label for="alamat" class="form-label">Alamat Event</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
    
                <div class=>
                    <label for="peserta" class="form-label">Jumlah Peserta</label>
                    <input type="text" class="form-control" id="peserta" name="peserta" required>
                </div>

                <div class=>
                    <label for="tanggal" class="form-label">Tanggal Event</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                
                <!-- Tombol Submit -->
                <div class=>
                    <button class="btn btn-secondary" type="submit" name="submit">Tambah Data</button>
                </div>
            </form>
        </div>
        <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event = $_POST["event"];
        $alamat = $_POST["alamat"];
        $peserta = $_POST["peserta"];
        $tanggal = $_POST["tanggal"];

        $sql = "INSERT INTO eventlist (nama_event, alamat_event, peserta_event, tanggal_event) VALUES ('$event', '$alamat', '$peserta', '$tanggal')";

        if (mysqli_query($conn, $sql)) {
        
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

        mysqli_close($conn);
        ?>
</body>
</html>
