<!DOCTYPE html>
<html lang="en">

<head>
  <title>EMPub</title>

  <link rel="stylesheet" href="../styles/accountSettings.css">
  <link rel="stylesheet" href="../styles/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
</head>

<body>
 <header>

    <nav>
      <div class="logo">
        <a href="http://localhost/TehnologiiWeb/empub/public/main">
          <img src="../images/white_logo.png" alt="Logo">
        </a>
      </div>
      <a href="#" class="hamburger">
        <div class="bar"></div>
      </a>
      <ul class="nav-links">
        <li>
          <a href="http://localhost/TehnologiiWeb/empub/public/main">Home</a>
        </li>
        <li>
          <a href="doc.html">About</a>
        </li>
        <li id="account">
          <a href="http://localhost/TehnologiiWeb/empub/public/accountSettings">Account</a>
        </li>
        <li id="logout">
          <a href="http://localhost/TehnologiiWeb/empub/public/login">
            Logout
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <div class="center">
      <div class="headerDiv">
        <h3>Account Settings</h3>
      </div>
      <div class="content">
        <div class="profilePictureDiv">
          <h5>YOUR PICTURE PROFILE</h5>
          <img src="../images/defaultPicture.png" class="profilePicture" alt="profilePicture">
        </div>
  
        <div class="formDiv">
          <form id="form1">
            <label>First-Name</label><br>
            <input type="text" name="firstname" id="fname"><br>
  
            <label>Last-Name</label><br>
            <input type="text" name="lastname" id="lname"><br>
            <label>Email</label><br>
            <input type="email" name="mail" id="email" readonly><br><br>
            <label for="img" class="selectPicture">Select your profile picture</label><br>
            <input type="file" id="img" name="img" accept="image/*">
          </form>
        </div>
  
      </div>
      <button type="submit" form="form1" value="Save" id="saveBtn">SAVE</button>
    </div>
  </div>

  <script src="http://localhost/TehnologiiWeb/empub/application/scripts/accountSettings.js"></script>
</body>

</html>