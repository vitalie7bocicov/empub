<html>
<head>
    <title>EMPub</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/empub/public/styles/style.css">
    <link rel="stylesheet" href="/empub/public/styles/logIN.css">
</head>

<body>

    <div class="center">
        <img src="/empub/public/images/logot.png" class="centerLOGO">
        <p class="quote">
            the best email publisher.
        </p>
        <form class="orderC" action="./verifyPassword" method="POST">
            <input id="hidden" type="hidden" name="email" value=<?= $data['user'] ?>>
            <label for="password">Enter your password: </label><br>
            <input id="password" type="password" name="password" placeholder="type your password..."><br><br>
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
</body>

</html>