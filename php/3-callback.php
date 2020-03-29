<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="0-style.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/font-face.css">
        <link rel="font" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/Vazir.woff2">
        <link rel="font" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/Vazir-Bold.woff2">
    </head>

    <body>

    <h1>اعلام نتیجه پرداخت</h1>

    <p>شناسه: <?php echo "<code>", $_GET["reference"], "</code>" ?></p>

    <p>
        وقتی این callback فراخوانی شود به این معنی است که پرداخت کننده نتیجه پرداخت
        را به شما اعلام کرده است. اما برای اینکه شما از نتیجه اعلام شده مطمئن شوید لازم
        است به طور مستقیم از سرویس وب‌پی تأیید بگیرید.
    </p>

    <?php
        include '0-storage.php';
        include '4-verify.php';

        $reference = $_GET["reference"];
        $amount = get_amount($reference);

        $verify_result = verify($reference, $amount);

        $data = json_decode($verify_result, true);

        if ($data["ok"]) {
            echo "<h3 class='success'>این پرداخت مورد تأیید است.</h3>";
        } else {
            echo "<h3 class='error'>این پرداخت مورد تأیید نیست.</h3>";
        }

        echo "پاسخ کامل دریافت شده:";
        echo "<pre><code>", $verify_result, "</code></pre>";
    ?>

    </body>
</html>
