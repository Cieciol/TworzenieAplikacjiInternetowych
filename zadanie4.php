<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 13.10.17
 * Time: 15:51
 */

$studenci = array(
    321115 => "Wacław",
    311111 => "Bartosz",
    311113 => "Kamil",
    311112 => "Juzef",
    311114 => "Jurek",
);
foreach ($studenci as $klucz => $wartosc) {
    print (' $studenci[' . $klucz . ']=' . $wartosc . '<br /> ');
}
print('<br/>');
print('<br/>');
ksort($studenci);
print ("posortowane wg klucza <br/>");
foreach ($studenci as $klucz => $wartosc) {
    print ('$studenci[' . $klucz . ']=' . $wartosc . '<br /> ');
}
print('<br/>');
print('<br/>');
asort($studenci);
print ("posortowane wg wartości <br/>");

foreach ($studenci as $klucz => $wartosc) {
    print ('$studenci[' . $klucz . ']=' . $wartosc . '<br /> ');
}
