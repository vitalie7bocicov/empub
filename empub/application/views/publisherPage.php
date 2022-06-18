<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../application/styles//main_style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../application/styles/style.css">
    <link rel="stylesheet" href="../../application/styles/visitor.css">
    <script src="../../application/scripts/navbar.js" defer></script>
    <title>EMPub</title>
</head>



<body>
    <header>

        <nav>
            <div class="logo">
                <a href="main.html">
                    <img src="../../application/images/white_logo.png" alt="Logo">
                </a>
            </div>
            <a href="#" class="hamburger">
                <div class="bar"></div>
            </a>
            <ul class="nav-links">
                <li>
                    <a href="main.html">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li id="account">
                    <a href="accountSettings.html">Account</a>
                </li>
                <li id="logout">
                    <a href="../index.html">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </header>

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
                        <option value="nr-views">Nr. of views</option>
                    </select>

                </div>

            </div>
            <form action="#" class="search-bar">
                <input type="text" name="q" placeholder="search" id="search-input">
                <button class="email-search">
                    <span class="material-icons" id="email1">
                        search
                    </span>
                </button>
            </form>

        </div>
        <div class="email-list" id = "email-list">
            <!--
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock " onclick="load_settings()">
                        <span class="material-icons email-locked" id="email2">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email3">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email4">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email5">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email6">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email7">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email8">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email9">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email10">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email11">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email12">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email13">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email14">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email15">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        17/04
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            Miro
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>
                        <span class="email-text"> - Here’s how your team did last week</span>
                    </div>
                </div>

                <div class="email-options">

                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-locked" id="email16">
                            lock
                        </span>
                    </a>

                </div>
            </div>

            <div class="email-row">
                <div class="email-date">
                    <span class="email-expiration-date">
                        20/07
                    </span>
                </div>
                <div class="email-content">
                    <div class="email-sender">
                        <h3>
                            service@intl.paypal.com
                        </h3>
                    </div>

                    <div class="email-message">
                        <span class="email-subject">Your transfer was successful</span>
                        <span class="email-text"> - Hi, there!
                            Looking for better solutions for all your content creation?</span>
                    </div>
                </div>

                <div class="email-options">
                    <a href="settingsPage.html" class="email-lock">
                        <span class="material-icons email-unlocked" id="email17">
                            lock_open
                        </span>
                    </a>

                </div>

            </div>
            -->
            <!-- email-list end -->
        </div>

        <div class="email-opened">
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