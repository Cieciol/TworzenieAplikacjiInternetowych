<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 06.11.17
 * Time: 13:15
 */

//tworzymy uchwyt do bazy klienci:
include_once "lib/Baza.php";
include_once "formularz.html";


$ob = new Baza("localhost", "root", "tom123", "klienci");

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
    echo $ob->select("SELECT Nazwisko,Zamowienie FROM klienci.Klienci", array("Nazwisko", "Zamowienie"));
}

function dodaj()
{
    global $ob;
    $dane = validate();
    $sql = sanitate($dane);
    $ob->insert($sql);
}

function pokaz_jezyk(string $language_name)
{
    global $ob;
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

function sanitate($values)
{
    $sql = "INSERT INTO klienci.Klienci(Nazwisko, Wiek, Panstwo, Email, Zamowienie, Platnosc) VALUES ";
    $valuesArr = array();
    $nazwisko = $this->mysqli->real_escape_string($values['nazwisko']);
    $wiek = $this->mysqli->real_escape_string($values['wiek']);
    $panstwo = $this->mysqli->real_escape_string($values['panstwo']);
    $email = $this->mysqli->real_escape_string($values['email']);
    $zamowienie = handle_array($values['tutorial']);
    $platnosc = $this->mysqli->real_escape_string($values['zaplata']);
    $valuesArr[] = "('$nazwisko', '$wiek', '$panstwo', '$email', $zamowienie, '$platnosc')";


    $sql .= implode(',', $valuesArr);
    return $sql;
}


function handle_array($array_values)
{
    $returned_string = "";
    if (is_array($array_values)) {
        $returned_string .= "('";
        foreach ($array_values as $value) {
            $returned_string .= $this->mysqli->real_escape_string($value) . ", ";
        }
        $returned_string .= "')";
    } else $returned_string = $array_values;

    return $returned_string;
}