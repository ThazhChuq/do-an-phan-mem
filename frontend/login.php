<?php
session_start();
$message = ''; // Đảm bảo biến luôn tồn tại

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['userid'] = $id;
                $_SESSION['username'] = $username;
                header("Location: welcome.php");
                exit();
            } else {
                $message = "Mật khẩu không đúng.";
            }
        } else {
            $message = "Tên đăng nhập không tồn tại.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <style>
        .login-box {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
            margin: 50px auto;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            border-radius: 5px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Đăng nhập</h2>
        <form method="post" action="">
            Tên đăng nhập:
            <input type="text" name="username" required>

            Mật khẩu:
            <input type="password" name="password" required>

            <input type="submit" value="Đăng nhập">
        </form>
        <p class="message"><?php echo $message; ?></p>
        <p><a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>
