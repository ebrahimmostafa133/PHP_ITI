<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $found = false;

    if (file_exists('users.txt')) {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user_row) {
            $data = explode(':', $user_row);
            // data order: 0:fname, 1:lname, 2:email, 3:password, 4:room, 5:image
            if (isset($data[2]) && isset($data[3])) {
                if ($data[2] === $email && $data[3] === $password) {
                    $_SESSION['user_name'] = $data[0] . ' ' . $data[1];
                    $_SESSION['user_email'] = $data[2];
                    $_SESSION['user_image'] = $data[5];
                    $found = true;
                    break;
                }
            }
        }
    }

    if ($found) {
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Day 3</title>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #f8fafc;
        }
        .container {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        h2 { text-align: center; color: #38bdf8; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; display: flex; flex-direction: column; }
        label { margin-bottom: 8px; color: #94a3b8; }
        input { 
            padding: 12px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #f8fafc;
        }
        button { 
            width: 100%;
            padding: 14px;
            background: #38bdf8;
            color: #0f172a;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .error { color: #fca5a5; text-align: center; margin-bottom: 15px; }
        .success { color: #86efac; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="color: #38bdf8; text-decoration: none;">Don't have an account? Register</a>
        </div>
    </div>
</body>
</html>
