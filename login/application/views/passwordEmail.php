<?php

$str = 
'<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <p>Hello dear '.$user->getEmail().'</p>
        <p>Your generated password is '.$generatePass.'</p>
    </body>
</html>';