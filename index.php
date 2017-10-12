<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
    galeria(4,2);

    function galeria($rows, $cols){
        for($i = 1 ; $i<=$rows*$cols ; $i++){
            print("<img src='miniaturki/obraz$i.JPG' alt='obraz$i' />");
            if ($i%$cols === 0)
                print ("</br>");
        }
    }
?>

</body>
</html>