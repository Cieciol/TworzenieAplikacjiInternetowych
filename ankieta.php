<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 23.10.17
 * Time: 10:25
 */

$method = $_SERVER['REQUEST_METHOD'];
define("POST", "POST");
define("GET", "GET");
define("ANKIETA_FILENAME", "ankieta.txt");

$tech = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];


if (!file_exists(ANKIETA_FILENAME) || filesize(ANKIETA_FILENAME) === 0) przygotuj_plik();
if ($method === GET) {
    przygotuj_form();
}
if ($method === POST) {
    if (isset($_POST["ankieta"])) {
        dodaj_wyniki();
    }
    wyswietl_wyniki();
}

function przygotuj_plik()
{
    $plik = fopen('ankieta.txt', 'w');
    foreach ($GLOBALS['tech'] as $single_tech) {
        fwrite($plik, $single_tech . " - 0" . PHP_EOL);
    }
}

function wyswietl_wyniki()
{
    $plik = fopen(ANKIETA_FILENAME, 'r');
    while (!feof($plik)) echo fgets($plik) . '<br/>';
    fclose($plik);
}

function przygotuj_form()
{
    echo '<form name="ankieta_form" method="post">';
    foreach ($GLOBALS['tech'] as $single_tech) {
        echo $single_tech . "<input type='checkbox' name='$single_tech'><br/>";
    }
    echo '<input type="submit" name="ankieta">';
    echo '</form>';
}

function dodaj_wyniki()
{
    $file = fopen(ANKIETA_FILENAME, 'r+');
    $new_text = "";

    if (!$file) {
        echo 'problem z otwarciem pliku';
        return -1;
    }
    while (!feof($file)) {
        $line = fgets($file);
        $line_array = explode(' ', $line);
        if ($_POST[$line_array[0]]) {
            $line_array[2] = $line_array[2] + 1;
            $line = implode(' ', $line_array) . PHP_EOL;
        }
        $new_text .= $line;
    }
    rewind($file);
    fputs($file, $new_text);
    fclose($file);
}

