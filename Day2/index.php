<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
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
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }
        h2 { text-align: center; color: #4a4a4a; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; display: flex; flex-direction: column; }
        label { margin-bottom: 8px; font-weight: 600; color: #555; }
        input[type="text"], input[type="email"], input[type="password"], textarea, select { 
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus { border-color: #667eea; outline: none; }
        .radio-group { display: flex; gap: 20px; align-items: center; }
        .checkbox-group { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .btn-container { display: flex; gap: 10px; margin-top: 20px; }
        button { 
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }
        button[type="submit"] { background: #667eea; color: white; }
        button[type="submit"]:hover { background: #5a6fd6; transform: translateY(-2px); }
        button[type="reset"] { background: #f0f0f0; color: #555; }
        button[type="reset"]:hover { background: #e0e0e0; }
        .error { color: #ff4d4d; font-size: 14px; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>User Registration</h2>
    <form action="done.php" method="POST">
        
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo $_GET['fn'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo $_GET['ln'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $_GET['em'] ?? ''; ?>">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Country</label>
            <select name="country">
                <option value="">Select Country</option>
                <option value="egypt">Egypt</option>
                <option value="usa">USA</option>
            </select>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
        </div>

        <div class="form-group">
            <label>Skills</label>
            <input type="checkbox" name="skills[]" value="php"> PHP
            <input type="checkbox" name="skills[]" value="j2se"> J2SE <br>
            <input type="checkbox" name="skills[]" value="mysql"> MySQL
            <input type="checkbox" name="skills[]" value="postgresql"> PostgreSQL
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>Department</label>
            <input type="text" name="department" value="OpenSource" readonly>
        </div>

        <div class="form-group">
            <label>Captcha</label>
            <div>
                <p style="margin:0; color: gray;">mossee45c</p>
                <input type="text" name="captcha_input">
                <small>Please insert the code in the box below</small>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>

    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="users.php" style="color: #667eea; text-decoration: none; font-weight: 600;">View Registered Users</a>
    </div>
    </div>

</body>
</html>
