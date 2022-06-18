<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../application/styles/main_style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../application/styles/style.css">
    <link rel="stylesheet" href="../../application/styles/publisherPage.css">
    <script src="../../application/scripts/navbar.js" defer></script>
    <title>EMPub</title>
</head>



<body>
    <?php
    include('../application/views/navbar.php')
    ?>

    <section class="container">

        <div class="config-menu">
            <div class="select-order">
                <select name="email-permission" id="email-permission">
                    <option value="all" selected>All</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>

                <div class="order">

                    <label for="order-by">Order by:</label>
                    <select name="order-by" id="order-by">
                        <option value="expiration_date" selected>Expiration date</option>
                        <option value="publication_date">Publishing date</option>
                    </select>

                </div>

            </div>
            <form action="#" class="search-bar" id="search">
                <input type="text" name="q" placeholder="search" id="search-input">
                <button class="email-search">
                    <span class="material-icons" id="email1">
                        search
                    </span>
                </button>
            </form>

        </div>
        <div class="email-list" id = "email-list">
        </div>

        <div class="email-opened" id="email-opened">
            <div class="overlay" id="overlay"></div>
            <form class="insert-password" id="insert-password">
                <label for="password">Please enter password: </label>
                <input type="password" name="password" id="password">
                <p class="incorect-password" id="incorectPass">Incorrect Password</p>
                <button type="submit" class="passwordButton">Submit</button>
            </form>
            
            <iframe id="email-frame" style="width: 100%; height: 100%;"></iframe>
        </div>
    </section>



</body>

<script type="module" src="http://localhost/TehnologiiWeb/empub/application/scripts/publisherUtil.js"></script>

</html>