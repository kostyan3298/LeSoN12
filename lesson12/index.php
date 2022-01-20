<?php
if (isset($_POST['btn'])) {
    setcookie('text', date('d/m/Y h:i -'). $_POST['userText'], time()+3600);
}

if (isset($_COOKIE['text'])) $text=$_COOKIE['text'];  else $text='';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="index.php" method="POST">
<input type='text' name='userText'>
<input type='submit' name='btn'>
</form>

<?php
if ($text!='') echo "<p>$text</p>"
?>

</body>
</html>


















