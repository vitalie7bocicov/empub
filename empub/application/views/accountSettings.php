<!DOCTYPE html>
<html lang="en">

<head>
  <title>EMPub</title>


  <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/style.css">
    <link rel="stylesheet" href="http://localhost/TehnologiiWeb/empub/application/styles/accountSettings.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="http://localhost/TehnologiiWeb/empub/application/scripts/navbar.js" defer></script>
</head>

<body>
    <?php
    include('../application/views/navbar.php')
    ?>
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
        <p class="hidden message" id="message">Update was successful!</p>
      <button type="submit" form="form1" value="Save" id="saveBtn">SAVE</button>

    </div>
  </div>

  <script src="http://localhost/TehnologiiWeb/empub/application/scripts/accountSettings.js"></script>
</body>

</html>