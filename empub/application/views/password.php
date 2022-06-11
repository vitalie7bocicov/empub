<html>
    <head>
        <title>EMPub</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/logIN.css">
    </head>

    <body>

        <div class="center">
            <img src="http://localhost/TehnologiiWeb/empub/application/images/LOGOT.png" class="centerLOGO">
            <p class="quote">
                the best email publisher.
            </p>
            <form class="orderC" id="submitForm" action="http://localhost/TehnologiiWeb/empub/public/main" method="POST">
                <input id="hidden" type="hidden" name="email" value=<?= $data['user'] ?>>
                <label for="password">We've sent you an email with the password. </label><br>
                <input id="password" type="password" name="password" placeholder="type your password..."><br><br>
                <p id="errMessage" class="hidden"></p>
                <input type="submit" class="button-17">
            </form>
            <div class="copyright">

                Copyleft
                <span id='copyright'>&copy;
                </span>
                2022
                <a href="empub.com">EMPub</a>. Very few rights reserved.
                <a href="/termsofservice/">
                    Terms
                    of
                    service.
                </a>
            </div>
        </div>

        <script src="http://localhost/TehnologiiWeb/empub/application/scripts/password.js"></script>
    </body>

</html>