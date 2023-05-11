<?php
    

    function segitiga1($baris, $simbol) {
        for ($a=1; $a<=$baris; $a++) {
            for($b=0 ; $b<$a ; $b++) {
                echo "$simbol ";
            }
            echo "<br>";
        }
    };

    function segitiga2($baris, $simbol ) {
        for ($a=1; $a<=$baris; $a++) {
            for($b=$baris ; $b>=$a ; $b--) {
                echo "$simbol ";
            }
            echo "<br>";
        }
    };

    function segitiga3($baris, $simbol ) {
        for ($a=1; $a<=$baris; $a++) {
            for($b=$baris-1 ; $b>=$a ; $b--) {
                echo "&nbsp ";
            }
            for($c=1 ; $c<=$a; $c++) {
                echo "$simbol";
            }
            echo "<br>";
        }
    };

    function segitiga4($baris, $simbol ) {
        for ($a=1; $a<=$baris; $a++) {
            for($c=1 ; $c<$a; $c++) {
                echo "&nbsp ";
            }
            for($b=$baris ; $b>=$a ; $b--) {
                echo "$simbol";
            }
            echo "<br>";
        }
    };


    function pilihPattern($pattern, $baris = 5, $simbol = '*') {
        if ($pattern == 'segitiga1') {
            segitiga1($baris, $simbol);
        } elseif ($pattern == 'segitiga2') {
            segitiga2($baris, $simbol);
        } elseif ($pattern == 'segitiga3') {
            segitiga3($baris, $simbol);
        } elseif ($pattern == 'segitiga4') {
            segitiga4($baris, $simbol);
        } else {
            echo "Pilihan pattern salah!";
        }
    }

    pilihPattern('segitiga2', 15, '+');



?>
