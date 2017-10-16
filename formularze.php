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
    global $dane;
    if (isset($_REQUEST['nazw']) && ($_REQUEST['nazw'] != "")) {
        $nazwisko = htmlspecialchars(trim($_REQUEST['nazw']));
    } else $nazwisko = 'x';
    if (isset($_REQUEST['wiek']) && ($_REQUEST['wiek'] != "")) {
        $wiek = htmlspecialchars(trim($_REQUEST['wiek']));
    } else $wiek = 0;
    if (isset($_REQUEST['panstwo']) && ($_REQUEST['panstwo'] != "")) {
        $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
    } else $panstwo = 'x';
    if (isset($_REQUEST['email']) && ($_REQUEST['email'] != "")) {
        $email = htmlspecialchars(trim($_REQUEST['email']));
    } else $email = 'x';
    if (isset($_REQUEST['tutorial']) && ($_REQUEST['tutorial'] != "")) {
        $tutorials = $_REQUEST['tutorial'];
        $tutorials_stringified = '';
        foreach ($tutorials as $tutorial) {
            $tutorials_stringified = $tutorials_stringified . $tutorial . ',';
        }
    } else $tutorials_stringified = 'x';
    if (isset($_REQUEST['zaplata'])) {
        $zaplata = $_REQUEST['zaplata'];
    } else $zaplata = 'x';

    $dane =
        $nazwisko . ' '
        . $wiek . '   '
        . $panstwo . '    '
        . $email . '   '
        . $tutorials_stringified . '   '
        . $zaplata . "<br/>" . PHP_EOL;
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
    przygotuj_dane();
    if ($plik) {
        echo "ok";
        fwrite($plik, $GLOBALS['dane']);
        fclose($plik);
    } else echo "problemy z otwarciem pliku spróbuj później";

}

function find_and_echo(string $searched, $handle)
{

    while (!feof($handle)) {
        $line = fgets($handle);
        if (strpos($line, $searched)) echo $line;
    }
}

function pokaz_jezyk(string $language_nename)
{
    if ($file = fopen("plik.txt", "r")) {
        find_and_echo($language_nename, $file);
        fclose($file);
    } else echo "file not opened";

}

drukuj_form();
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
}
