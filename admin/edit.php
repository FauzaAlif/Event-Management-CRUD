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
                <h2>Event Management List</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <form action="">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search" name="search" placeholder="Search" autocomplete="off">
                        <button type="submit" id="tombolCari">Search</button>
                    </form>

                </div>
                <img src="../assets/background.jpg" alt=""/>
            </div>            
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">Data Event</h3>
            <div class="table-container">
            <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>Alamat</th>
                            <th>Peserta</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query untuk mengambil data
                        $sql = "SELECT * FROM eventlist";
                        $result = mysqli_query($conn, $sql);

                        // Mengecek apakah ada data yang ditemukan
                        if (mysqli_num_rows($result) > 0) {
                            // Menampilkan data ke dalam tabel
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id_event'] . "</td>";
                                echo "<td>" . $row['nama_event'] . "</td>";
                                echo "<td>" . $row['alamat_event'] . "</td>";
                                echo "<td>" . $row['peserta_event'] . "</td>";
                                echo "<td>" . $row['tanggal_event'] . "</td>";
                                echo "<td>

                                    <form method='post' action='edit_event.php'>
                                        <input type='hidden' name='edit_id' value='" . $row['id_event'] . "'>
                                        <button style='color:green;' type='submit' name='edit'>Edit</button>
                                    </form>
                                
                                    <form method='post'>
                                         <input type='hidden' name='delete_id' value='" . $row['id_event'] . "'>
                                        <button style='color:red;' type='submit' name='delete'>Hapus</button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                        }
            
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Memeriksa apakah tombol delete ditekan
                            if (isset($_POST["delete"])) {
                                // Mengambil ID yang akan dihapus dari permintaan
                                $id_to_delete = $_POST["delete_id"];
                                
                                // Query untuk menghapus data berdasarkan ID
                                $sql_delete = "DELETE FROM eventlist WHERE id_event = $id_to_delete";
                        
                                // Menjalankan query
                                if (mysqli_query($conn, $sql_delete)) {
                                    echo "Data berhasil dihapus.";
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                            }
                        }

                        // Menutup koneksi
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    </body>
</html>