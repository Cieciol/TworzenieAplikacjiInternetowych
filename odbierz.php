<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 12.10.17
 * Time: 17:41
 */
echo 'dane odebrane z formularza: <br/>';
if (isset($_REQUEST['nazw']) && ($_REQUEST['nazw'] != "")) {
    $nazwisko = htmlspecialchars(trim($_REQUEST['nazw']));
    echo 'Nazwisko: ' . $nazwisko . '<br/>';
} else echo 'nie wpisano nazwiska';

if (isset($_REQUEST['wiek']) && ($_REQUEST['wiek'] != "")) {
    $wiek = htmlspecialchars(trim($_REQUEST['wiek']));
    echo 'Wiek: ' . $wiek . '<br/>';
} else echo 'nie wpisano wieku<br/>';

if (isset($_REQUEST['panstwo']) && ($_REQUEST['panstwo'] != "")) {
    $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
    echo 'Państwo: ' . $panstwo . '<br/>';
} else echo 'nie wybrano państwa<br/>';

if (isset($_REQUEST['email']) && ($_REQUEST['email'] != "")) {
    $email = htmlspecialchars(trim($_REQUEST['email']));
    echo 'Adres email: ' . $email . '<br/>';
} else echo 'nie wpisano adresu email <br>';

if (isset($_REQUEST['tutorial']) && ($_REQUEST['tutorial'] != "")) {
    $tutorials = $_REQUEST['tutorial'];
    echo 'wybrane tutoriale: ';
    foreach ($tutorials as $tutorial) {
        echo htmlspecialchars(trim($tutorial)) . ', ';
    }
    echo '<br/>';

} else echo 'nie wybrano tutorialu <br>';

if (isset($_REQUEST['zaplata'])) {
    echo 'wybrany sposób zapłaty: ';
    echo $_REQUEST['zaplata'];
} else echo 'nie wybrano sposobu zapłaty <br>';
?>