<?php
session_start();
include 'koneksi.php'; // Adjust the path to match your structure

// Check if user is logged in
if (!isset($_SESSION["pengguna"])) {
    echo "<script>alert('You haven't signin!');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Get user ID from session
$id = $_SESSION["pengguna"]['id'];

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update query
    $query = "POST pengguna SET nama = '$name', email = '$email', telepon = '$phone', alamat = '$address' WHERE id = '$id'";
    
    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Profile updated successfully');</script>";
        echo "<script>location='edit_profile.php';</script>"; // Redirect back to the profile page
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
}
?>
