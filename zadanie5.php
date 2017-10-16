<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 13.10.17
 * Time: 16:20
 */

$studenci = array(
    321115 => [2, 3, 4, 3, 4, 5],
    311111 => [3, 4, 5, 2, 6, 4],
    311113 => [3, 3, 3, 2, 4, 5],
    311112 => [5, 3, 5, 3, 4, 2],
    311114 => [3, 4, 2, 4, 5, 2]
);
foreach ($studenci as $klucz => $wartosc) {
    print ('średnia studenta o numerze albumu:'. $klucz);
    print(' '.(array_sum($wartosc)/count($wartosc)).'<br/>');
print('<br/>');
}