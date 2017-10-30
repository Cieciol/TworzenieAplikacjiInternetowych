<?php

$method = $_SERVER['REQUEST_METHOD'];
define("POST", "POST");
define("GET", "GET");
include 'User.php';


if ($method === GET) {
    przygotuj_form();
    pokaz_uzytkownikow();
}
if ($method === POST) {
    przygotuj_form();
    if (isset($_POST["rejestruj"])) {
        dodaj_uzytkownika();
    }

}

function przygotuj_form()
{
    echo
    '<h3>FORMULARZ REJESTRACJI:</h3>
<form name="ankieta_form" method="post" >
        Nazwa użytkownika: <br/>
        <input type="text" name="nazw"><br/>
        Hasło: <br/>
        <input type="password" name="hasl"><br/>
        Imie i nazwisko: <br/>
        <input type="text" name="imieinazw"><br/>
        E-mail: <br/>
        <input type="email" name="email"><br/>
        <input type="submit" name="rejestruj">   
        <input type="reset"> 
    </form>';
}
function dodaj_uzytkownika(){
    $user = User::chcekForm($_POST['nazw'],
        $_POST['hasl'],
        $_POST['imieinazw'],
        $_POST['email']);
    if(!empty($user)){
        $user->show();
        $user->save();
    }
    else echo "błędne podane przy rejestracji";
}
function pokaz_uzytkownikow(){
    echo 'Zarejestrowani użytkownicy:'.HTML_EOL;
    User::getAllUsers();
}

?>