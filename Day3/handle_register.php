<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $room_number = $_POST['room_number'];
    
    // 1. Email Validation (Way 1: filter_var)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format (using filter_var).";
    }
    
    // 2. Email Validation (Way 2: preg_match)
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!preg_match($email_pattern, $email)) {
        $errors[] = "Invalid email format (using regex).";
    }

    // 3. Password Validation (Bonus)
    // a. Minimum 8 chars
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }
    // b. Allow alphanumeric, underscores, and @
    // c. Allow Capital characters
    if (!preg_match('/^[a-zA-Z0-9_@]+$/', $password)) {
        $errors[] = "Password contains invalid characters. Only alphanumeric, underscores, and @ are allowed.";
    }

    // 4. Room Number validation
    $valid_rooms = ['Application1', 'Application2', 'Cloud'];
    if (!in_array($room_number, $valid_rooms)) {
        $errors[] = "Invalid room selection.";
    }

    // 5. Profile Picture Validation
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp = $_FILES['profile_pic']['tmp_name']; // Fix: should be tmp_name
        $file_type = $_FILES['profile_pic']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (!in_array($file_ext, $allowed_extensions)) {
            $errors[] = "Profile picture must be an image (jpg, jpeg, png, gif).";
        }
        
        // Ensure it's a photo using mime type or getimagesize
        $check = getimagesize($_FILES['profile_pic']['tmp_name']);
        if ($check === false) {
            $errors[] = "File is not a valid image.";
        }
    } else {
        $errors[] = "Please upload a profile picture.";
    }

    if (empty($errors)) {
        // Success - Store data
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $image_name = time() . '_' . $_FILES['profile_pic']['name'];
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $upload_dir . $image_name);
        
        // Format: fname:lname:email:password:room:image
        $user_data = "{$first_name}:{$last_name}:{$email}:{$password}:{$room_number}:{$image_name}" . PHP_EOL;
        
        file_put_contents('users.txt', $user_data, FILE_APPEND);
        
        $_SESSION['success'] = "Registration successful! You can now login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit();
    }
}
?>
