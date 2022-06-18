<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../application/styles/letterTemplate.css">
    <script src="https://kit.fontawesome.com/d31da07a9e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../application/styles/style.css">
    <script src="../../application/scripts/navbar.js" defer></script>
    <title>Document</title>
</head>

<body>
    <?=include('../application/views/navbar.php')?>
    
    <main class="wrapper" id = "wrapper">
        <div class="sidebar" id="sidebar">
            <button onclick="location.href='http://localhost/TehnologiiWeb/empub/public/main'" class="sidebar-buttons">
                <i class="fa-solid fa-inbox"></i>
                Inbox
            </button>
            <button class="sidebar-buttons" id="stats">
                <i class=" fa-solid fa-chart-line"></i>
                Statistics
            </button>
            <button class="sidebar-buttons"  id="settings">
                <i class=" fa-solid fa-gear"></i>
                Settings
            </button>
        </div>

        <!--<div class="meniu-wrap">
            <input type="checkbox" id="checkbox" class="toggler">
            <div class="hamburger">
                <div></div>
            </div>
        </div>-->
        <div class="common-section">
            <div class="row-style"></div>
        </div>

        <iframe id = "iframe" class="iframe" src="" marginwidth="0" marginheight="0" frameborder="0" ></iframe>
        <!--
        <div class="common-section logo-bar">
            <a href="#" title="Modern Logo"><img class="logo-image" src="../../application/images/LOGOT.png" alt="Modern Logo"></a>

            <div>
                <a href="#" class="brand-icons"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="brand-icons"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="brand-icons"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="brand-icons"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="brand-icons"><i class="fa-brands fa-linkedin"></i></a>
            </div>

        </div>

        <div>
            <a href="#"><img class="bannerImage" src="../../application/images/banner.jpg" alt=""></a>
        </div>

        <div class="white-background">
            <div class="email-container">
                <a href="#"><img src="../../application/images/email.png" alt=""></a>
                <p style="font-weight: bold; font-size: 17px;">Ecommerce</p>
                <p>Responsive HTML Email Template Course to master email developmnet.</p>
            </div>

            <div class="email-container">
                <a href="#"><img src="../../application/images/settings.png" alt=""></a>
                <p style="font-weight: bold; font-size: 17px;">Ecommerce</p>
                <p>Responsive HTML Email Template Course to master email developmnet.</p>
            </div>

            <div class="email-container">
                <a href="#"><img src="../../application/images/home.png" alt=""></a>
                <p style="font-weight: bold; font-size: 17px;">Ecommerce</p>
                <p>Responsive HTML Email Template Course to master email developmnet.</p>
            </div>
        </div>

        <div class="custom-design">
            <a href="#"><img class="custom-design-image" src="../img/keyboard.jpg" alt=""></a>
            <div class="custom-design-text">
                <p style="font-weight: bold; font-size: 18px;">Create Customs Designs</p>
                <p style="padding-bottom: 16px;">Over the years we build up a massive portfolio our clinet website and
                    email designs.</p>
                <a href="#" class="button">Read More</a>
            </div>
        </div> -->
    </main>


    <!--<script>
        function changeClass() {
            var menu = document.getElementById('sidebar');

            if (menu.classList.contains('transition-function')) {
                menu.classList.remove('transition-function');
            }
            else {
                menu.classList.add('transition-function');
            }
        }

        var checkbox = document.getElementById('checkbox').onclick = changeClass;
    </script>
-->
<script src="http://localhost/TehnologiiWeb/empub/application/scripts/mailPage.js">
        console.log("hello");
    </script>
</body>

</html>