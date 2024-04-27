<?php
// Sertakan file koneksi
require_once "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
                <li class="active">
                    <a href="./edit.php">
                        <h4>List Data</h4>
                    </a>
                </li>
                <li>
                    <a href="./insert.php">
                        <h4>Insert Data</h4>
                    </a>
                </li>
            </ul>
    </div>

<div class="main--content">
    <div class="row">
        <div class="col-lg-6">
        </div>
    </div>
        <div class="header--wrapper">
            <div class ="header--title">
                <h2>Edit Event</h2>
            </div>
        </div>
        <div class="tabular--wrapper">
            <div class="table-container">
            <form method="post">
                <?php
                

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                    // Tangkap data dari formulir update
                    $edited_event_name = $_POST['edited_event_name'];
                    $edited_event_address = $_POST['edited_event_address'];
                    $edited_event_participants = $_POST['edited_event_participants'];
                    $edited_event_date = $_POST['edited_event_date'];
                    $edit_id = $_POST['edit_id'];
                
                    // Query SQL UPDATE untuk meng-update data acara
                    $sql_update = "UPDATE eventlist SET nama_event='$edited_event_name', alamat_event='$edited_event_address', peserta_event='$edited_event_participants', tanggal_event='$edited_event_date' WHERE id_event='$edit_id'";
                
                    // Eksekusi query update
                    if (mysqli_query($conn, $sql_update)) {
                        header("Location: edit.php");
                        exit();
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }


                // Tangkap ID acara dari URL
                if (isset($_POST['edit_id'])) {
                    $edit_id = $_POST['edit_id'];
                
                    // Query untuk mengambil detail acara berdasarkan ID
                    $sql = "SELECT * FROM eventlist WHERE id_event = $edit_id";
                    $result = mysqli_query($conn, $sql);
                
                    // Mengecek apakah ada data yang ditemukan
                    if (mysqli_num_rows($result) > 0) {
                        // Menampilkan data pada formulir untuk diedit
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <!-- Formulir untuk mengedit data acara -->
                        <form method="post">
                            <!-- Field untuk mengedit nama acara -->
                            <label for="edited_event_name">Nama Event:</label><br>
                            <input type="text" id="edited_event_name" name="edited_event_name" value="<?php echo $row['nama_event']; ?>"><br>
                            
                            <!-- Field untuk mengedit alamat acara -->
                            <label for="edited_event_address">Alamat:</label><br>
                            <input type="text" id="edited_event_address" name="edited_event_address" value="<?php echo $row['alamat_event']; ?>"><br>
                            
                            <!-- Field untuk mengedit jumlah peserta acara -->
                            <label for="edited_event_participants">Jumlah Peserta:</label><br>
                            <input type="text" id="edited_event_participants" name="edited_event_participants" value="<?php echo $row['peserta_event']; ?>"><br>
                            
                            <!-- Field untuk mengedit tanggal acara -->
                            <label for="edited_event_date">Tanggal:</label><br>
                            <input type="date" id="edited_event_date" name="edited_event_date" value="<?php echo $row['tanggal_event']; ?>"><br><br>
                            
                            <!-- Hidden field untuk menyimpan ID acara yang diedit -->
                            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                            
                            <!-- Tombol "Update" untuk mengirimkan formulir -->
                            <button type="submit" name="update">Update</button>
                        </form>
                        <?php
                    } else {
                        echo "Tidak ada data yang ditemukan.";
                    }
                } else {
                    echo "ID acara tidak ditemukan.";
                }
                

                // Menutup koneksi
                mysqli_close($conn);
                ?>
            </form>
            </div>
        </div>
    </div>
    
    </body>
</html>
