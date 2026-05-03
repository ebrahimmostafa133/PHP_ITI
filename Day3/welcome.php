<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION['user_name'];
$user_image = $_SESSION['user_image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Day 3</title>
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
            padding: 50px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 500px;
        }
        h1 { color: #38bdf8; margin-bottom: 20px; }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #38bdf8;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
        }
        .logout-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <?php if ($user_image && file_exists('uploads/' . $user_image)): ?>
            <img src="uploads/<?php echo htmlspecialchars($user_image); ?>" alt="Profile Picture" class="profile-pic">
        <?php else: ?>
            <div style="width: 150px; height: 150px; border-radius: 50%; background: #334155; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                No Image
            </div>
        <?php endif; ?>
        <p style="color: #94a3b8; font-size: 18px;">You have successfully logged in to Day 3 Lab.</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
