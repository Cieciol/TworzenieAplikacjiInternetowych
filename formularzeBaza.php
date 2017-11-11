<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 06.11.17
 * Time: 13:15
 */

//tworzymy uchwyt do bazy klienci:
include_once "lib/BazaForm.php";
include_once "formularz.html";


$ob = new BazaForm("localhost", "root", "tom123", "klienci");

if (isset($_REQUEST['pokaz'])) {
    pokaz();
} else if (isset($_REQUEST['dodaj'])) {
    dodaj();
} else if (isset($_REQUEST['pokazjava'])) {
    pokaz_jezyk("Java");
} else if (isset($_REQUEST['pokazphp'])) {
    pokaz_jezyk("PHP");
} else if (isset($_REQUEST['pokazcpp'])) {
    pokaz_jezyk("CPP");
} else if (isset($_REQUEST['statystyki'])) {
    pokaz_statystyki();
}

function pokaz()
{
    global $ob;
    echo $ob->select("select Nazwisko,Zamowienie from klienci.Klienci", array("Nazwisko", "Zamowienie"));
}

function dodaj()
{
    global $ob;
    $dane = validate();
    $ob->insert($dane);
}

function pokaz_jezyk(string $language_name){
    global$ob;
    echo $ob->select("select Nazwisko,Zamowienie from klienci.Klienci WHERE Zamowienie REGEXP '$language_name'", array("Nazwisko", "Zamowienie"));
}


function validate()
{
    $filter = array(
        'nazwisko' => array('filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/[A-Z]{1}[a-z]{2,15}/')),
        'wiek' => array('filter' => FILTER_VALIDATE_INT,
            'options' => array(
                'min_range' => 13,
                'max_range' => 90)),
        'panstwo' => FILTER_DEFAULT,
        'email' => FILTER_VALIDATE_EMAIL,
        'tutorial' => array('filter' => FILTER_DEFAULT,
            'flags' => FILTER_REQUIRE_ARRAY,
        ),
        'zaplata' => FILTER_DEFAULT
    );
    $dane = filter_input_array(INPUT_GET, $filter);

    if (!poinformuj_o_bledach($dane)) return $dane;
}

function poinformuj_o_bledach($dane): bool
{
    $czy_sa_bledy = false;

    if (empty($dane['nazwisko'])) {
        echo "Nazwisko było błędne lub puste!<br/>";
        $czy_sa_bledy = true;
    }
    if (empty($dane['wiek'])) {
        echo "Wiek musi być z zakresu 13 do 90!<br/>";
        $czy_sa_bledy = true;
    }
    if (empty($dane['panstwo'])) {
        echo "Wybrane państwo jest błędne!<br/>";
        $czy_sa_bledy = true;
    }
    if (empty($dane['email'])) {
        echo "Email był błędny lub pusty!<br/>";
        $czy_sa_bledy = true;
    }
    if (empty($dane['tutorial'])) {
        echo "Nie wybrano żadnego z tutoriali!<br/>";
        $czy_sa_bledy = true;
    }
    if (empty($dane['zaplata'])) {
        echo "Nie wybrano sposobu zapłaty!<br/>";
        $czy_sa_bledy = true;
    }
    return $czy_sa_bledy;
}