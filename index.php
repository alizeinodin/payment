<?php

session_start();
$token = md5(uniqid(mt_rand(), TRUE));
$_SESSION['csrf_token'] = $token;


?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <title>ثبت نام</title>
    <link rel="stylesheet" href="./styles/reset.css"/>
    <link rel="stylesheet" href="./styles/fontFaces.css"/>
    <link rel="stylesheet" href="./styles/main.css"/>
    <link rel="icon" href="./assets/images/logo.png"/>
</head>
<body>
<div class="main">
    <div class="formContainer">
        <span id="title">ثبت نام در سمینار</span>
        <form action="Controller/registerController.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <input type="text" name="name" placeholder="نام نام خانوادگی"/>
            <span class="error" id="name">نام وارد شده معتبر نمی باشد.</span>
            <input type="text" name="ssn" placeholder="کد ملی"/>
            <span class="error" id="nationcode"
            >کد ملی وارد شده معتبر نمی باشد.</span
            >
            <input type="text" name="stn" placeholder="شماره دانشجویی"/>
            <span class="error" id="stunumber"
            >شماره دانشجویی وارد شده معتبر نمی باشد.</span
            >
            <input type="tel" name="phone" placeholder="َشماره تلفن همراه"/>
            <span class="error" id="tell"
            >شماره تلفن وارد شده معتبر نمی باشد.</span
            >
            <span id="note"
            >‌در صورتی که دانشجو کامپیوتر دانشگاه بوعلی سینا هستید با وارد کردن
            شماره دانشجویی ثبت نام برای شما رایگان می شود.</span
            >
            <div class="btn">
                <input type="submit" value="ثبت نام و پرداخت"/>
                <span id="price">مبلغ: 20,000 تومان</span>
            </div>
        </form>
    </div>
    <div class="infoContainer">
        <canvas></canvas>
        <div class="content">
            <img src="./assets/images/logo.png" width="183px" height="240px"/>
            <h2>سمینار برنامه نویسی‌ فرانت اند و بک اند</h2>
            <p>
                سمیناری برای دانشجویان علاقه مند به حوزه برنامه‌نویسی وب کاری از
                انجمن مهندسی کامپیوتر دانشگاه بوعلی‌سینا
            </p>
        </div>
    </div>
</div>
<div class="footer">
    <div id="bgFooter1-border"></div>
    <div id="bgFooter1"></div>
    <div id="bgFooter2-border"></div>
    <div id="bgFooter2"></div>
    <div class="creator">
        <span> توسعه داده شده توسط: </span>
        <a href="https://t.me/Ali_zne">علی زین الدینی</a>
        <span> ، </span>
        <a href="https://t.me/ascchh">اسماء چگنی</a>
    </div>

</div>
<script src="./scripts/script.js"></script>
</body>
</html>
