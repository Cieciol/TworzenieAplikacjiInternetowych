<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 13.11.17
 * Time: 11:17
 */

include "../lib/Baza.php";
include "../User.php";
include "../UserDB.php";

class UserManager
{

    private static $db;

    /**
     * UserManager constructor.
     */
    public function __construct()
    {
        if(!isset(self::$db)) self::$db = new Baza("localhost", "root", "tom123", "klienci");

    }

    function login($login, $pass){
        $passwFromBase = self::$db->executeQuery("select passwd from users where '$login' = user_name");
        var_dump($passwFromBase);
        if($passwFromBase == hash('md5', $pass)) echo "youre loggen in";
        elseif (!empty($passwFromBase)) echo "wrong login or password";
    }


    function logout(){

    }
    function getLoggedInUser($id){
        //wynik 1 - znaleziono wpis z id sesji w tabeli logged_in_users
        //wynik -1 - nie ma wpisu dla tego id w tabeli logged_in_users
    }

}