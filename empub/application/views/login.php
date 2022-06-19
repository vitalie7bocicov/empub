
<!DOCTYPE html>
<html lang="en">
<head>
    <title>EMPub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Email publisher">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/logIN.css">
</head>

<body>

    <div class="center">
        <img src="http://localhost/TehnologiiWeb/empub/application/images/LOGOT.png" class="centerLOGO" width="200" height="auto" alt="empub logo">
        <p class="quote">
            the best email publisher.
        </p>
        <form class="orderC" id="formSubmit" action="http://localhost/TehnologiiWeb/empub/public/login/password" method="POST">
            <label for="email">new user? enter your email below to get started </label><br>
            <input id="email" type="email" name="email" placeholder="type your email..."><br>
            <input id="submitButton" type="submit" class="button-17">
        </form>
        <div class="copyright">

            Copyleft
            <span id="copyright">&copy;
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

    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/login.js">
    </script>
</body>

</html>