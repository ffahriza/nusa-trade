<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* Full-height background styling */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('assets_home/img/bg1.jpg'); /* Background image path */
            background-size: cover;
            background-position: center;
        }
        /* Container for the form */
        .container-profile {
            width: 100%;
            max-width: 800px; /* Increased max width for a larger form */
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #d76c82;
            font-weight: bold;
            text-align: center;
            margin-bottom: 40px;
            font-size: 28px; /* Increased font size for the title */
        }
        .form-label {
            font-weight: bold;
            color: #333;
            font-size: 18px; /* Increased font size for labels */
        }
        .form-control {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px; /* Increased font size for input fields */
        }
        .btn-custom {
            background-color: #d76c82;
            color: white;
            font-weight: bold;
            border: none;
            width: 100%;
            padding: 15px;
            font-size: 18px; /* Increased font size for the button */
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #bf5b6c;
        }
    </style>
    
    
</head>
<?php
session_start();
include 'koneksi.php'
?>
<body>
    <div class="container-profile">
        <h2>Edit Profile</h2>
        <form action="process_profile.php" method="POST">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION["pengguna"]['nama'] ?>" required>

            <label class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["pengguna"]['email'] ?>" required>

            <label class="form-label">Phone:</label>
            <input type="telepon" class="form-control" name="phone" pleaceholder="<?php echo $_SESSION["pengguna"]['telepon'] ?>" required>

            <label class="form-label">Address:</label>
            <textarea class="form-control" name="address" rows="3" placeholder="<?php echo $_SESSION["pengguna"]['alamat'] ?>" required></textarea>

            <button type="submit" class="btn-custom">Save Changes</button>
            <br></br>
            <button type="button" role="button" href="index.php" class="btn-custom">Back to Dashboard</button>
        </form>
        
    </div>
</body>

</html>
