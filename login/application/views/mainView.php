<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/empub/public/styles/main_style.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/empub/public/styles/style.css">
  <script src="https://kit.fontawesome.com/d31da07a9e.js" crossorigin="anonymous"></script>
  <title>EMPub</title>
</head>

<body>
  <header>

    <nav>
      <div class="logo">
        <a href="main.html">
          <img src="/empub/public/images/white_logo.png" alt="Logo">
        </a>
      </div>
      <a href="#" class="hamburger">
        <div class="bar"></div>
        <!--<span class="bar "></span>
            <span class="bar "></span>-->
      </a>
      
      <ul class="nav-links">
        <li class="notHover">
            <form class="navbarSearchBar" action="" id="navbarSearchBar">
                <input type="text" placeholder="Search.." name="search" id="navbarInput" class="navbarInput">
                <button type="submit" class="buttonSubmit" id="buttonSubmitSearch"><i class="fa fa-search"></i></button>

                <div class="info_class" id="info_container"></div>
            </form>
        </li>
        <li>
          <a href="main.html">Home</a>
        </li>
        <li>
          <a href="doc.html">About</a>
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
            <option value="expiration-date" selected>Expiration date</option>
            <option value="publishing date">Publishing date</option>
            <option value="nr-views">Nr. of views</option>
          </select>

        </div>

      </div>
      <form action="#" class="search-bar">
        <input type="text" name="q" placeholder="search">
            <button class="email-search">
            <span class="material-icons">
                search
            </span>
            </button>
      </form>

    </div>
    <div class="email-list">
      <div class="email-row" onclick="location.href='letterTemplate.html'">
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
            <span class="material-icons email-locked">
              lock
            </span>
          </a>

          <a href="settingsPage.html" class="email-settings">
            <span class="material-icons">
              settings
            </span>
          </a>


          <a href="statistics.html" class="email-stats">
            <span class="material-icons">
              query_stats
            </span>
            <span class="email-views">15</span>
          </a>

          <a href="#" class="email-delete">
            <span class="material-icons">
              delete
            </span>
          </a>

        </div>
      </div>

      <div class="email-row" onclick="location.href='letterTemplate.html'">
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
            <span class="material-icons email-unlocked">
              lock_open
            </span>
          </a>

          <a href="settingsPage.html" class="email-settings">
            <span class="material-icons">
              settings
            </span>
          </a>


          <a href="statistics.html" class="email-stats">
            <span class="material-icons email-query-stats">
              query_stats
            </span>
            <span class="email-views">15</span>
          </a>

          <a href="#" class="email-delete">
            <span class="material-icons">
              delete
            </span>
          </a>

        </div>

      </div>



      <!-- email-list end -->
    </div>

  </section>
  <script src="/empub/public/scripts/navbar.js" defer></script>
  <script src="/empub/public/scripts/main.js"></script>
</body>
</html>