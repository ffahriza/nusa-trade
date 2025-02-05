<?php
$koneksi = new mysqli("localhost", "root", "", "ptsri");
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
