<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HolidayMaker</title>
        <link rel="stylesheet" type="text/css" href="../../../css/landing_styles.css">
        <link rel="stylesheet" type="text/css" href="../../../css/styles2.css">
        <link rel="stylesheet" type="text/css" href="../../../css/normalize.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    </head>
    <body>

        <section class="header">
            <div class="header-wrapper">
                <a href="?"><img src="../../../img/menu.png"></a>
                <div class="header-inner-wrapper">
                    <a href="?"><div class="button" id="header-button-call">
                        <img src="../../../img/phone.png">
                    </div>
                    </a>
                    <a href="?"><div class="button" id="header-button">
                        <div class="header-button-text">ЗАБРОНЮВАТИ</div>
                    </div></a>
                    <div id="header-info">+38 (066) 582-85-93<br>holidaymkr@gmail.com</div>
            </div>
        </div>


        </section>


        @yield('content')

        <section class="part-4">
            <div class="footer">
                <div class="social">
                    <div id="social-text">Social:</div>
                    <div id="social-img-container">
                        <a href="https://teleg.run/flexxxtentacion"><img src="../../../img/telegram.png"></a>
                        <a href="viber.com"><img src="../../../img/viber.png"></a>
                        <a href="facebook.com"><img src="../../../img/facebook.png"></a>
                    </div>
                </div>
                <div class="contacts">
                    <div id="contacts-text">Contacts:</div>
                    <div id="contacts-text2">+38 (066) 582-85-93<br>holidaymkr@gmail.com</div>
                </div>
            </div>
        </section>
        </body>
</html>
