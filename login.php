<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['parola']) ? $_POST['parola'] : ''; // ✅ match the form field name

    $users = array(
        'Admin' => array('password' => 'Admin123', 'role' => 'admin'),
        'Client' => array('password' => 'Client123', 'role' => 'client'),
        'Antrenor' => array('password' => 'Antrenor123', 'role' => 'antrenor')
    );

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Date incorecte!';
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body class="login-background">

<div class="login-container">
    <img src="21_GYM_logo.png" alt="21 GYM Logo" class="logo">
    <h2 class="slogan">Working <span class="outline">(out)</span> for a better future!</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="parola">Parola:</label>
        <input type="password" name="parola" id="parola" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
