<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Day 3</title>
    <style>
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
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
            max-width: 550px;
            margin: 20px;
        }
        h2 { text-align: center; color: #38bdf8; margin-bottom: 30px; font-weight: 700; letter-spacing: -0.025em; }
        .form-group { margin-bottom: 20px; display: flex; flex-direction: column; }
        label { margin-bottom: 8px; font-weight: 500; color: #94a3b8; }
        input[type="text"], 
        input[type="email"], 
        input[type="password"], 
        input[type="file"],
        textarea, 
        select { 
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 15px;
            color: #f8fafc;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        input:focus, select:focus, textarea:focus { 
            border-color: #38bdf8; 
            outline: none; 
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
            background: rgba(15, 23, 42, 0.8);
        }
        .btn-container { display: flex; gap: 12px; margin-top: 30px; }
        button { 
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        button[type="submit"] { 
            background: #38bdf8; 
            color: #0f172a; 
        }
        button[type="submit"]:hover { 
            background: #7dd3fc; 
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(56, 189, 248, 0.3);
        }
        button[type="reset"] { 
            background: rgba(255, 255, 255, 0.05); 
            color: #94a3b8; 
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        button[type="reset"]:hover { 
            background: rgba(255, 255, 255, 0.1);
            color: #f8fafc;
        }
        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .success-msg {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #86efac;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        select option {
            background-color: #1e293b;
            color: #f8fafc;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>User Registration</h2>
        
        <?php if (isset($_SESSION['errors'])): ?>
            <div class="error-msg">
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <form action="handle_register.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" required>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                <small style="color: #64748b; margin-top: 4px;">8 chars, only lowercase, underscores allowed.</small>
            </div>

            <div class="form-group">
                <label>Room Number</label>
                <select name="room_number" required>
                    <option value="">Select Room</option>
                    <option value="Application1">Application1</option>
                    <option value="Application2">Application2</option>
                    <option value="Cloud">Cloud</option>
                </select>
            </div>

            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_pic" accept="image/*" required>
            </div>

            <div class="btn-container">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>

        </form>
        <div style="text-align: center; margin-top: 25px;">
            <p style="color: #94a3b8;">Already have an account? <a href="login.php" style="color: #38bdf8; text-decoration: none; font-weight: 600;">Login</a></p>
        </div>
    </div>

</body>
</html>
