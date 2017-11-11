<?php
//tworzymy uchwyt do bazy klienci:
include_once "lib/BazaForm.php";
$ob = new BazaForm("localhost", "root", "tom123", "klienci");
//if (isset($_POST['pokaz'])) {
var_dump($ob);
    echo $ob->select("select Nazwisko,Zamowienie from klienci",
        array("Nazwisko", "Zamowienie"));
//} else
//    if (isset($_POST['dodaj'])) {
        //pobierz dane z formularza, dokonaj ich walidacji
        //Skorzystaj w tym celu z pomocniczej funkcji
        //sformułuj zapytanie insert i wywołaj metodę:
        //$ob->insert($sql);
//    }
//else ...
?>