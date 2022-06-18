<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d31da07a9e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../application/styles/style.css">
    <link rel="stylesheet" href="../../application/styles/mobileview.css">
    <script src="../../application/scripts/navbar.js" defer></script>
    <title>Document</title>
</head>

<body>
    <?php
    include('../application/views/navbar.php')
    ?>
    <main class="wrapper" id = "wrapper">
    
        <div class="common-section">
            <div class="row-style"></div>
        </div>

        <div class="email-opened" id="email-opened">
            <div class="overlay" id="overlay"></div>
            <form class="insert-password" id="insert-password">
                <label for="password">Please enter password: </label>
                <input type="password" name="password" id="password">
                <p class="incorect-password" id="incorectPass">Incorrect Password</p>
                <button type="submit" class="passwordButton">Submit</button>
            </form>
            
            <iframe id="email-frame" style="width: 100%; height: 100vh;"></iframe>
        </div>
    </main>
 
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/mobileView.js"></script>
</body>

</html>