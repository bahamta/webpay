<html>
    <head>
    <style TYPE="text/css">
            body { direction: rtl;}
    </style>
    </head>

    <body>

    <h1>اعلام نتیجه پرداخت برای شناسه: <?php echo $_GET["reference"] ?></h1>

    <p>
        وقتی این callback فراخوانی شود به این معنی است که پرداخت کننده نتیجه پرداخت
        را به شما اعلام کرده است. اما برای اینکه شما از این اعلام نتیجه مطمئن شوید لازم
        است به طور مستقیم از سرویس وب‌پی تأیید بگیرید.
    </p>
    <p>
        شما به عنوان فروشنده‌ای که می‌خواهید از نتیجه این پرداخت اطمینان پیدا کنید،
        لازم است مبلغ مورد پرداخت آن را بدانید و برای دریافت تأیید ارسال کنید.
    </p>
        
    <form method="POST" action="verify.php">
        مبلغ: <input type="number" name="amount_irr"/>
        <input type="submit" value="دریافت تأیید"/>
        <input type="hidden" name="reference" value="<?php echo $_GET["reference"] ?>">
    </form>

    </body>
</html>
