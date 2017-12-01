<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 12.11.17
 * Time: 22:27
 */
include "User.php";

session_start();

$user = unserialize($_SESSION['user']);

echo "ID sesji".session_id()."<br>";
echo "zawartość zmiennej \$_SESSION['username'] : ".$user->getUserName()."</br>";
echo "zawartość zmiennej \$_SESSION['fullname'] : ".$user->getFullName()."</br>";
echo "zawartość zmiennej \$_SESSION['email'] : ".$user->getEmail()."</br>";
echo "zawartość zmiennej \$_SESSION['status'] : ".($user->getStatus() == USER::STATUS_USER ? "USER" : "ADMIN" )."</br>";
 session_destroy();


echo "<br/>><a href='test1.php'> link </a>";