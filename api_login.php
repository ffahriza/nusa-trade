<?php
session_start();
include 'koneksi.php';
header("Content-Type: application/json");

// Cek metode request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari request body (JSON)
    $input = json_decode(file_get_contents("php://input"), true);

    $email = $input["email"] ?? null;
    $password = $input["password"] ?? null;

    if (!$email || !$password) {
        echo json_encode([
            "status" => "error",
            "message" => "Email dan password harus diisi"
        ]);
        exit;
    }

    // Ambil data pengguna berdasarkan email
    $ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$email' LIMIT 1");
    $akun = $ambil->fetch_assoc();

    if ($akun) {
        if (password_verify($password, $akun['password'])) {
            // Login berhasil
            echo json_encode([
                "status" => "success",
                "message" => "Login berhasil",
                "data" => [
                    "id" => $akun['id'],
                    "nama" => $akun['nama'],
                    "email" => $akun['email'],
                    "level" => $akun['level']
                ]
            ]);
        } else {
            // Login gagal karena password tidak cocok
            echo json_encode([
                "status" => "error",
                "message" => "Password salah"
            ]);
        }
    } else {
        // Login gagal karena email tidak ditemukan
        echo json_encode([
            "status" => "error",
            "message" => "Email tidak ditemukan"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
?>
