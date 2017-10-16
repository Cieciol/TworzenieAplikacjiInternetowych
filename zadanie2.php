<?php
/**
 * Created by PhpStorm.
 * User: tomek
 * Date: 12.10.17
 * Time: 22:27
 */

$zm1 = 134;
$zm2 = 67.67;
$zm3 = 1;
$zm4 = 0;
$zm5 = true;
$zm6 = "0";
$doc_root = "~/PhpstormProjects/untitled";
$zm7 = "Ala ma kota a kot ma Ale";
$zm8 = [1, 2, 3, 4];
$zm9 = [];
$zm10 = ["zielony", "czerwny", "niebieski"];
$zm11 = new DateTime();

is_everything($zm1);
is_everything($zm2);
is_everything($zm3);
is_everything($zm4);
is_everything($zm5);
is_everything($zm6);
is_everything($zm7);
is_everything($zm8);
is_everything($zm9);
is_everything($zm10);
is_everything($zm11);


function is_everything($zm)
{
    if (is_object($zm)) echo date_format($zm, 'Y-m-d H:i:s') . '<br/>';
    elseif (is_array($zm)) {
        for ($i = 0; $i < count($zm); $i++) {
            print ($zm[$i] . ' ');
        }
        print('<br/>print_r ');
        print_r($zm);
        print('<br/>vardump ');
        var_dump($zm);
        print('<br/>');

    } else print($zm . '<br/>');
    print('is bool? ');
    if (is_bool($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('is int? ');
    if (is_int($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('is numeric? ');
    if (is_numeric($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('is string? ');
    if (is_string($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('is array? ');
    if (is_array($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('is object? ');
    if (is_object($zm)) print ("YES <br/>"); else print ("NO <br/>");
    print('<br/>');
    print('<br/>');
    print('<br/>');


}

