<!DOCTYPE html>
<html lang="en">

<head>
    <title>EMPub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/settingsPage.css">
    <script src="https://kit.fontawesome.com/d31da07a9e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/style.css">
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
</head>

<body>
    <?php
    include('../application/views/navbar.php')
    ?>
    
    <div class="conatiner">

        <div class="center1">
            <div class="headerDiv">
                <h3>Email Settings</h3>
            </div>

            <div class="sidebar" id="sidebar">
                <button onclick="location.href='http://localhost/TehnologiiWeb/empub/public/main'" class="sidebar-buttons"><i class="fa-solid fa-inbox"></i>
                    Inbox</button>
                <button class="sidebar-buttons" id="stats"><i
                        class="fa-solid fa-chart-line"></i> Statistics</button>
                <button class="sidebar-buttons" style="background-color: grey;"><i class="fa-solid fa-gear"></i>
                    Settings</button>
            </div>

            <div class="content">
                <form id="form" class="formContainer">
                    <div class="radio-buttons-div">
                        <label for="public" class="radio-buttons">Public
                            <input type="radio" name="publicationType" id="public" value="1">
                            <i class="fa-solid fa-circle-check checkState" id="check1"></i>
                        </label>

                        <label for="private" class="radio-buttons">&nbsp;Private
                            <input type="radio" name="publicationType" id="private" value="2">
                            <i class="fa-solid fa-circle-check checkState" id="check2"></i>
                        </label>

                        <label for="deleteButton" class="radio-buttons">Delete
                            <input type="radio" id="deleteButton" name="delete" value="delete">
                            <i class="fa-solid fa-square-xmark red" style="color: red"></i>
                        </label>
                    </div>

                    <div class="input-margin">
                        <label for="dateOfExpiration">Date: </label>
                        <input type="date" name="dateOfExpiration" id="dateOfExpiration">
                    </div>

                    <div class="input-margin">
                        <label for="timeofExpiration">Time:</label>
                        <input type="time" name="timeofExpiration" id="timeofExpiration">
                    </div>
                    <div class="input-margin displayNone" id="password">
                        <label id="passwordLabel" for="passwordInput"></label>
                        <input type="password" name="password" id="passwordInput">

                    </div>
                    <p id="message" class="hidden"></p>
                    <button type="submit" value="Save" class="buttonSettings">SAVE</button>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="http://localhost/TehnologiiWeb/empub/application/scripts/emailSettingsPage.js">
    </script>
</body>

</html>