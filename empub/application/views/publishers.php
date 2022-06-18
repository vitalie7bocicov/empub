

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/publishers.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/style.css">
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
    <title>EMPub</title>
</head>



<body>
<?=include('../application/views/navbar.php')?>

<section class="container">

    <div class="config-menu">
        <form action="#" class="search-bar" id="search">
            <input type="text" name="q"  placeholder="search"  id="search-input">
            <button class="publisher-search">
          <span class="material-icons">
            search
          </span>
            </button>
        </form>
    </div>

    <div class="publishers-list" id="publishers-list">

    </div>

</section>

<script type="module" src="http://localhost/TehnologiiWeb/empub/application/scripts/publishers.js" defer></script>
</body>
</html>