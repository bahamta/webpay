# راهنمای نمونه کد PHP

توجه داشته باشید که سرویس وب‌پی بر روی دو سرور جداگانه، با نام‌های production و test در حال اجرا و ارائه سرویس است. سرور production با اتصال به درگاه‌های شاپرک در حال ارائه سرویس اصلی است و پرداخت‌های آن در سیستم بانکی کشور انجام می‌شود. اما سرور test با استفاده از یک درگاه تستی این امکان را فراهم می‌کند که مرحله پرداخت خارج از سیستم بانکی اجرا و محیط مناسبی برای تست ایجاد شود.

آدرس این دو سرویس عبارتند از:

Production: <https://webpay.bahamta.com>

Test: <https://testwebpay.bahamta.com>

برای استفاده از هر یک از این دو سرویس، لازم است با ورود به سامانه مربوط، ثبت‌نام کرده و کلید ارتباط با API را دریافت نمود.

این نمونه کد از چند فایل تشکیل شده که توضیح مختصر آنها در ادامه آورده شده است.

## فایل 0-config.ini

این فایل حاوی کلید ارتباط با api است.

## فایل 0-storage.php

این فایل نقش یک دیتابیس موقت و بسیار ساده را ایفا می‌کند. به طور حتم یک برنامه کاربردی، دیتابیس قوی‌تری دارد و این کد ساده به کار نخواهد آمد. اما برای اجرای این نمونه کد کافی است.

## فایل 0-style.css

این فایل صرفاً برای بهبود زیبایی محتوای صفحات است و نبود آن اهمیت زیادی ندارد.

## فایل 1-form.html

یک صفحه html ساده است که یک مبلغ را از کاربر گرفته و با زدن دکمه پرداخت، یک درخواست به سرور وب‌پی فرستاده می‌شود. این کار از طریق فایل 2-request.php انجام می‌شود.

## فایل 2-request.php

یک درخواست پرداخت به وب‌پی فرستاده و یک آدرس برای آن دریافت می‌کند. اگر پرداخت کننده به این آدرس هدایت شود، می‌تواند پرداخت خود را انجام دهد. با پایان پرداخت نتیجه آن به 3-callback.php خبر داده می‌شود.

## فایل 3-callback.php

در زمان اعلام نتیجه پرداخت، این فایل فراخوانی می‌شود. از آنجا که اعلام نتیجه از طرف پرداخت کننده به این فایل می‌رسد، ممکن است در آن دستکاری شده باشد. به همین خاطر برای اطمینان از صحت نتیجه اعلام شده، لازم است که به طور مستقیم از سرویس وب‌پی تأیید دریافت نمایید. برای این کار، این فرم مبلغ پرداخت شده و شناسه پرداخت را (که از callbacl parameters دریافت کرده است) به فانکشن verify که در فایل 4-verify.php پیاده‌سازی شده است، می‌فرستند.

## فایل 4-verify.php

یک فانکشن در آن پیاده‌سازی شده است که مبلغ و شناسه دریافتی را برای دریافت تأیید، به سرویس وب‌پی فرستاده و نتیجه را برمی‌گرداند.