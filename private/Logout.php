<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout Page</title>
</head>
<body>
    <?php
        session_start();
        session_unset();
        session_destroy();
    ?>
    <script>
        window.location.href = '/EventManagement/public/index.php?active=login';
    </script>
    <?php
        exit();
    ?>
</body>
</html>
