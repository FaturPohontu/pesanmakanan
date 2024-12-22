<?php 
    session_start();
    include ("koneksi.php");
    
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  
        $nama = $_POST['nama'] ?? '';
        $telp = $_POST['telp'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            echo "Password tidak cocok!";
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM db_cust WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['alert'] = "warning|Email Sudah Digunakan!";
        $stmt->close();
        header("Location: ../register.php");
        exit();
    }
    $stmt->close();
    
        $stmt = $conn->prepare("INSERT INTO `db_cust` (`nama`, `telp`, `email`, `pass`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $telp, $email, $hashed_password);
    
        if ($stmt->execute()) {
            $_SESSION['alert'] = "success|Berhasil Daftar!";
            header("Location: ../register.php"); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    $conn->close();
    ?>
    