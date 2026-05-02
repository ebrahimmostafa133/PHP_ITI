<?php
$errors = [];

// Validation
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$gender = $_POST['gender'] ?? '';
$captcha_input = $_POST['captcha_input'] ?? '';

if (empty($first_name)) $errors[] = "First Name is required";
if (empty($last_name)) $errors[] = "Last Name is required";
if (empty($email)) {
    $errors[] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email format";
}
if (empty($gender)) $errors[] = "Gender is required";
if ($captcha_input != "mossee45c") $errors[] = "Invalid Captcha";

if (!empty($errors)) {
    echo "<div style='font-family: sans-serif; padding: 20px; background: #fff5f5; border: 1px solid #feb2b2; color: #c53030; border-radius: 8px; margin: 20px;'>";
    echo "<h3>Please fix the following errors:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul><a href='index.php?fn=$first_name&ln=$last_name&em=$email'>Go Back</a></div>";
    exit;
}

// Save to file
$data = date("Y-m-d H:i:s") . "|" . $first_name . "|" . $last_name . "|" . $email . "|" . $gender . "\n";
file_put_contents("customer.txt", $data, FILE_APPEND);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #333;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
        }
        h1 { color: #667eea; }
        .info { text-align: left; background: #f9f9f9; padding: 20px; border-radius: 8px; margin-top: 20px; }
        .info div { margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Successful!</h1>
        <p>Thanks <?php echo ($gender == 'male' ? 'Mr. ' : 'Miss ') . $first_name . ' ' . $last_name; ?></p>
        
        <div class="info">
            <h3>Your Information:</h3>
            <div><strong>First Name:</strong> <?php echo $first_name; ?></div>
            <div><strong>Last Name:</strong> <?php echo $last_name; ?></div>
            <div><strong>Email:</strong> <?php echo $email; ?></div>
            <div><strong>Gender:</strong> <?php echo ucfirst($gender); ?></div>
            <div><strong>Address:</strong> <?php echo $_POST['address'] ?? 'N/A'; ?></div>
            <div><strong>Department:</strong> <?php echo $_POST['department'] ?? 'OpenSource'; ?></div>
        </div>

        <a href="users.php" class="btn">View All Users</a>
    </div>
</body>
</html>


