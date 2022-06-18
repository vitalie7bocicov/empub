

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/main_style.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/style.css">
  <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
  <title>EMPub</title>
</head>



<body>
  <?=include('../application/views/navbar.php')?>

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
                <option value="publication_date" selected>Publication date</option>
                <option value="expiration_date" >Expiration date</option>
                <option value="views">Nr. of views</option>
          </select>

        </div>

      </div>
      <form action="#" class="search-bar" id="search">
        <input type="text" name="q"  placeholder="search"  id="search-input">
        <button class="email-search">
          <span class="material-icons">
            search
          </span>
        </button>
      </form>

    </div>
    <div class="email-list" id="email-list">
<!--      <div class="email-row" onclick="location.href='letterTemplate.html'">-->
<!--        <div class="email-date">-->
<!--          <span class="email-expiration-date">-->
<!--            17/04-->
<!--          </span>-->
<!--        </div>-->
<!--        <div class="email-content">-->
<!--          <div class="email-sender">-->
<!--            <h3>-->
<!--              Miro-->
<!--            </h3>-->
<!--          </div>-->
<!---->
<!--          <div class="email-message">-->
<!--            <span class="email-subject">Tensor-Reloaded team Weekly Digest</span>-->
<!--            <span class="email-text"> - Here’s how your team did last week</span>-->
<!--          </div>-->
<!--        </div>-->
<!---->
<!--        <div class="email-options">-->
<!---->
<!--          <a href="../../public/html/settingsPage.html" class="email-lock">-->
<!--            <span class="material-icons email-locked">-->
<!--              lock-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!--          <a href="../../public/html/settingsPage.html" class="email-settings">-->
<!--            <span class="material-icons">-->
<!--              settings-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!---->
<!--          <a href="../../public/html/statistics.html" class="email-stats">-->
<!--            <span class="material-icons">-->
<!--              query_stats-->
<!--            </span>-->
<!--            <span class="email-views">15</span>-->
<!--          </a>-->
<!---->
<!--          <a href="#" class="email-delete">-->
<!--            <span class="material-icons">-->
<!--              delete-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!--        </div>-->
<!--      </div>-->
<!---->
<!--      <div class="email-row" onclick="location.href='letterTemplate.html'">-->
<!--        <div class="email-date">-->
<!--          <span class="email-expiration-date">-->
<!--            20/07-->
<!--          </span>-->
<!--        </div>-->
<!--        <div class="email-content">-->
<!--          <div class="email-sender">-->
<!--            <h3>-->
<!--              service@intl.paypal.com-->
<!--            </h3>-->
<!--          </div>-->
<!---->
<!--          <div class="email-message">-->
<!--            <span class="email-subject">Your transfer was successful</span>-->
<!--            <span class="email-text"> - Hi, there!-->
<!--              Looking for better solutions for all your content creation?</span>-->
<!--          </div>-->
<!--        </div>-->
<!---->
<!--        <div class="email-options">-->
<!--          <a href="../../public/html/settingsPage.html" class="email-lock">-->
<!--            <span class="material-icons email-unlocked">-->
<!--              lock_open-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!--          <a href="../../public/html/settingsPage.html" class="email-settings">-->
<!--            <span class="material-icons">-->
<!--              settings-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!---->
<!--          <a href="../../public/html/statistics.html" class="email-stats">-->
<!--            <span class="material-icons email-query-stats">-->
<!--              query_stats-->
<!--            </span>-->
<!--            <span class="email-views">15</span>-->
<!--          </a>-->
<!---->
<!--          <a href="#" class="email-delete">-->
<!--            <span class="material-icons">-->
<!--              delete-->
<!--            </span>-->
<!--          </a>-->
<!---->
<!--        </div>-->

      </div>



      <!-- email-list end -->
    </div>

  </section>
  
  <script type="module" src="http://localhost/TehnologiiWeb/empub/application/scripts/main.js" defer></script>
</body>
</html>