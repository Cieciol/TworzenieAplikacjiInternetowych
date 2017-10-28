<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 16.10.17
 * Time: 10:32
 */
include_once "formularz.html";
// funkcje pomocnicze
function przygotuj_dane()
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
    return filter_input_array(INPUT_GET, $filter);
}

function drukuj_form()
{


}

function pokaz()
{
    $plik = fopen('plik.txt', 'a+');
    echo fread($plik, filesize('plik.txt'));
    fclose($plik);
}

function dodaj()
{
    $plik = fopen('plik.txt', 'a+');
    $dane = przygotuj_dane();
    if ($plik && !poinformuj_o_bledach($dane)) {
        przygotuj_i_zapisz($dane,$plik);
    } else echo "problemy z otwarciem pliku spróbuj później";
    fclose($plik);
}
 function poinformuj_o_bledach ($dane) : bool {
    $czy_sa_bledy = false ;

    if(empty($dane['nazwisko'])){
        echo "Nazwisko było błędne lub puste!<br/>";
        $czy_sa_bledy = true;
    }
    if(empty($dane['wiek'])){
        echo "Wiek musi być z zakresu 13 do 90!<br/>";
        $czy_sa_bledy = true;
    }
    if(empty($dane['panstwo'])){
        echo "Wybrane państwo jest błędne!<br/>";
        $czy_sa_bledy = true;
    }
    if(empty($dane['email'])){
        echo "Email był błędny lub pusty!<br/>";
        $czy_sa_bledy = true;
    }
    if(empty($dane['tutorial'])){
        echo "Nie wybrano żadnego z tutoriali!<br/>";
        $czy_sa_bledy = true;
    }
    if(empty($dane['zaplata'])){
        echo "Nie wybrano sposobu zapłaty!<br/>";
        $czy_sa_bledy = true;
    }
    return $czy_sa_bledy;
}
function przygotuj_i_zapisz($dane,$plik){
    $tutorials = $dane['tutorial'];
    $tutorials_stringified = '';
    foreach ($tutorials as $tutorial) {
        $tutorials_stringified = $tutorials_stringified . $tutorial . ',';
    };
    $dane_string = $dane['nazwisko'].' '.
        $dane['wiek'].' '.
        $dane['panstwo'].' '.
        $dane['email'].' '.
        $tutorials_stringified.' '.
        $dane['zaplata'].PHP_EOL;
    fwrite($plik,$dane_string);
}
function pokaz_jezyk(string $language_nename)
{
    if ($file = fopen("plik.txt", "r")) {
        find_and_echo($language_nename, $file);
        fclose($file);
    } else echo "file not opened";

}
function find_and_echo(string $searched, $handle)
{

    while (!feof($handle)) {
        $line = fgets($handle);
        if (strpos($line, $searched)) echo $line;
    }
}

//przygotuj_plik();
if (isset($_REQUEST['pokaz'])) {
    pokaz();
} else if (isset($_REQUEST['dodaj'])) {
    dodaj();
} else if (isset($_REQUEST['pokazjava'])) {
    pokaz_jezyk("Java");
} else if (isset($_REQUEST['pokazphp'])) {
    pokaz_jezyk("PHP");
} else if (isset($_REQUEST['pokazcpp'])) {
    pokaz_jezyk("C\C++");
} else if (isset($_REQUEST['statystyki'])) {
    pokaz_statystyki();
}


function policz_linie()
{
    $ilosc_wpisow = 0;
    if ($file = fopen("plik.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            $ilosc_wpisow++;
        }
        fclose($file);
    } else echo "file not opened";
    return $ilosc_wpisow;
}

function policz_ponizej_18()
{
    $ilosc_wpisow = 0;
    if ($file = fopen("plik.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            $line_array = explode(" ", $line);
            if ($line_array[2] < 18) {
                $ilosc_wpisow++;
            }
        }
        fclose($file);
    } else echo "file not opened";
    return $ilosc_wpisow;
}

function policz_powyzej_50()
{
    $ilosc_wpisow = 0;
    if ($file = fopen("plik.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            $line_array = explode(";", $line);
            if ($line_array[1] > 50) {
                $ilosc_wpisow++;
            }
        }
        fclose($file);
    } else echo "file not opened";
    return $ilosc_wpisow;
}

function pokaz_statystyki()
{
    echo 'ilosc wszystkich wpisow wynosi ' . policz_linie() . '<br/>';
    echo 'ilość wpisów od osób poniżej 18 roku życia: ' . policz_ponizej_18() . '<br/>';
    echo 'ilość wpisów od osób powyżej 50 roku życia: ' . policz_powyzej_50() . '<br/>';
}