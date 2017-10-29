<?php

if (isset($_POST['zapisz']) && $_POST['zapisz']=='Zapisz' && !isset($_GET['pic'])) {
    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $typ = $_FILES['zdjecie']['type'];
        if ($typ == 'image/jpeg') {
            echo 'ok';
            move_uploaded_file($_FILES['zdjecie']['tmp_name'], './zdjecia/'.$_FILES['zdjecie']['name']);
        
            $link = $_FILES['zdjecie']['name'];
            $random = uniqid(rand);
            $zdj = './zdjecia/'.$random.'.jpg';
            copy('./zdjecia/'.$link, $zdj);

            header('Content-Type: image/jpeg');
            list($width,$height) = getimagesize($zdj);

            $wys = $_POST['wys'];
            $szer = $_POST['szer'];

            $skala_wys = 1;
            $skala_szer = 1;
            $skala = 1;
            if ($width > $szer) {
                $skala_szer = $szer/$width;
            }

            if ($height > $wys) {
                $skala_wys = $wys/$height;
            }

            if ($skala_wys <= $skala_szer) {
                $skala = $skala_wys;
            } else {
                $skala = $skala_szer;
            }

            $newH = $height*$skala;
            $newW = $width*$skala;

            $nowe = imagecreatetruecolor($newW, $newH);
            $obraz = imagecreatefromjpeg($zdj);

            imagecopyresampled($nowe, $obraz, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagejpeg($nowe, './miniatury/mini-'.$link, 100);

            imagedestroy($nowe);
            imagedestroy($obraz);
            unlink($zdj);

            $dlugosc = strlen($link);
            $dlugosc -= 4;
            $link = substr($link, 0, $dlugosc);

            header('location: ?pic='.$link);
        } else {
                header('loaction: index.html');
        }
    }
}



if (isset($_GET['pic']) && !empty($_GET['pic'])) {
    echo '<a href="zdjecia/'.$_GET['pic'].'.jpg">Zdjęcie</a><br/>';
    echo '<a href="miniatury/mini-'.$_GET['pic'].'.jpg">Miniatura</a><br/><br/>';
    echo '<a href="zdjecia.html">Powrót</a>';
    $katalog_miniatur="./miniatury";
    $katalog_zdjec = "./zdjecia";
    $kat=@opendir($katalog_miniatur) or die("Nie można otworzyć katalogu");
    echo "<h3>$katalog_miniatur</h3>";
    while ($plik=readdir($kat)) {
        if ($plik !=='.' && $plik !=='..') {
            $nazwa_zdj = substr($plik, 5);
            echo '<a href='.$katalog_zdjec.'/'.$nazwa_zdj.'><img src='.$katalog_miniatur.'/'.$plik.' width="100" height="100"> </a>';
        }
    }
    closedir($kat);
}
