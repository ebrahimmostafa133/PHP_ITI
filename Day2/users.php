<?php
$filename = "customer.txt";

// Handle Deletion
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    $lines = file($filename);
    if (isset($lines[$index])) {
        unset($lines[$index]);
        file_put_contents($filename, implode("", $lines));
        header("Location: users.php"); // Refresh to show changes
        exit;
    }
}

// Read records
$users = [];
if (file_exists($filename)) {
    $lines = file($filename);
    foreach ($lines as $index => $line) {
        $parts = explode("|", trim($line));
        if (count($parts) >= 5) {
            $users[] = [
                'index' => $index,
                'date' => $parts[0],
                'first_name' => $parts[1],
                'last_name' => $parts[2],
                'email' => $parts[3],
                'gender' => $parts[4]
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f4f7f6;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        h2 { color: #4a4a4a; margin-bottom: 20px; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #64748b; }
        tr:hover { background: #f1f5f9; }
        .gender-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .male { background: #e0f2fe; color: #0369a1; }
        .female { background: #fce7f3; color: #9d174d; }
        .delete-btn {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
            padding: 6px 12px;
            border: 1px solid #fee2e2;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .delete-btn:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn">← Back to Registration</a>
        <h2>Registered Customers</h2>
        
        <?php if (empty($users)): ?>
            <p style="text-align: center; color: #94a3b8; padding: 40px;">No users registered yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo date("M d, Y", strtotime($user['date'])); ?></td>
                            <td><?php echo $user['first_name'] . " " . $user['last_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <span class="gender-badge <?php echo strtolower($user['gender']); ?>">
                                    <?php echo $user['gender']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="users.php?delete=<?php echo $user['index']; ?>" 
                                   class="delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
