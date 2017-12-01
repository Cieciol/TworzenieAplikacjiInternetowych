<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 13.11.17
 * Time: 11:13
 */
include "./UserManager.php";

$login    = $_REQUEST['llog'];
$password = $_POST['passw'];

$userManager = new UserManager();
//var_dump($userManager);


if(!empty($login) && !empty($password)){
    $userManager->login($login,$password);
}else echo "podaj login i hasło";