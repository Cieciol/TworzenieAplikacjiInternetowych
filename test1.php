<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 12.11.17
 * Time: 21:56
 */

include "User.php";

session_start();

$user = new User("Grzes","Grzes Grzesiowski","grzes@mail.com","passwird");

echo "ID sesji : ".session_id()."<br>";

$_SESSION['username'] = $user->getUserName();
$_SESSION['fullname'] = $user->getFullName();
$_SESSION['email'] = $user->getEmail();
$_SESSION['status'] = $user->getStatus() == user::STATUS_USER ? "USER" : "ADMIN";

$_SESSION['user'] = serialize($user);

echo "zawartość zmiennej \$_SESSION['username'] : ".$_SESSION['username']."</br>";
echo "zawartość zmiennej \$_SESSION['fullname'] : ".$_SESSION['fullname']."</br>";
echo "zawartość zmiennej \$_SESSION['email'] : ".$_SESSION['email']."</br>";
echo "zawartość zmiennej \$_SESSION['status'] : ".$_SESSION['status']."</br>";

echo "\$_COOKIE['PHPSSEID'] : ".$_COOKIE['PHPSESSID']."<br/>";

echo "<br/>><a href='test2.php'> link </a>";