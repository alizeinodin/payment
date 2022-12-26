<?php

session_start();
$token = md5(uniqid(mt_rand(), TRUE));
$_SESSION['csrf_token'] = $token;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="">
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    <input type="text">
    <input type="number">
    <input type="number">
    <input type="tel">
    <input type="submit">
</form>
</body>
</html>
