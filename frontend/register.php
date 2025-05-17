<?php
$message = ''; 

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Tên đăng nhập đã tồn tại.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                $message = "Đăng ký thành công.";
            } else {
                $message = "Lỗi khi đăng ký.";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <style>
        .register-box {
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
    <div class="register-box">
        <h2>Đăng ký</h2>
        <form method="post" action="">
            Tên đăng nhập:
            <input type="text" name="username" required>

            Mật khẩu:
            <input type="password" name="password" required>

            <input type="submit" value="Đăng ký">
        </form>
        <p class="message"><?php echo $message; ?></p>
        <p><a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
