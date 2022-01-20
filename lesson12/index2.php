<?php
function isUserExists($login){
    $path=_DIR_."/User.xml";
    $userExist=false;
    if(file_exists($path)){
        $xml=simplexml_load_file($path);
        foreach ($xml as $user){
            if ($user["name"]==$login) {
                $userExist=true;
                break; 
            }
        }
    }
    return $userExist;
}

function addUser($user, $password){
    $path=__DIR__."/User.xml";
    if(file_exists($path)){
        $xml=simplexml_load_file($path);
        $child=$xml->addChild("User");
        $child->addAttribute("name", $user);
        $child->Password=$password;
        $xml->asXML($path);
    } else{
        $xml=new XMLWriter();
        $xml->openMemory();
        $xml->startDocument();
        $xml->startElement("Users");
        $xml->startElement("User");
        $xml->writeAttribute("name", $user);
        $xml->writeElement("Password", $password);
        $xml->endElement();
        $xml->endElement();
        $xml->endDocument();
        file_put_contents($path,$xml->outputMemory(),FILE_APPEND |LOCK_EX);
    }

}
if (isset($_POST["register"])) {
    $path=__DIR__."/";
    $dir=$path.$_POST["name"];
    if (!is_dir($dir)){
        mkdir($dir,0777);
        addUser($_POST["name"],$_POST["password"]);
    } 
     
    
}

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
    <form action="index2.php" method="POST">
        <label for="name">Введите логин</label>
        <input type="text" name="name" id="name"><br/>
        <label for="password">Введите пароль</label>
        <input type="password" name="password" id="password"><br/>
        <input type="submit" name="register" value="Register">
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>