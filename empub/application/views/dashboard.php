<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/style.css">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/dashboard.css"/>
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
    <title>EMPub</title>
</head>



<body>
<header>
    <?php
    include('../application/views/navbar.php')
    ?>
<section class="container">

    <div class="config-menu">
    <div class="config-buttons">
        <button class="btn" id="btn"><i class="fa fa-plus"></i> Add user</button>
        <button class="btn" id="csv">Export</button>
    </div>

        <form action="#" class="search-bar" id="search">
            <input type="text" name="q"  placeholder="search"  id="search-input">
            <button class="publisher-search">
          <span class="material-icons">
            search
          </span>
            </button>
        </form>
    </div>

        <div id="myModal" class="modal">

            <div class="modal-content" >
                <span class="close">&times;</span><br>
                <form id="form1" method="POST">
                <label>First-Name</label><br>
                <input type="text" name="firstname" id="fname" class="input"><br>
                <label>Last-Name</label><br>
                <input type="text" name="lastname" id="lname" class="input"><br>
                <label>Email</label><br>
                <input type="email" name="mail" id="email" class="input" required><br><br>
                <button type="submit" id="create" for="form1">CREATE</button>
                 </form>
              
            </div>

        </div>


    <div class="publishers-list" id="publishers-list">

    </div>

</section>

<script type="module" src="http://localhost/TehnologiiWeb/empub/application/scripts/dashboard.js" defer></script>
</body>
</html>
