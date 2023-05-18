<?php

class Animal {
    public $nama, $jenis;

    public function __construct($nama, $jenis) {
        $this->nama = $nama;
        $this->jenis = $jenis;
    }

    public function getInfo() {
        return "Ini adalah {$this->nama} dan jenisnya adalah {$this->jenis}.";
    }
}

class Kucing extends Animal {
    private $sifat;

    public function __construct($nama, $jenis, $sifat) {
        parent::__construct($nama, $jenis);
        $this->sifat = $sifat;
    }

    public function getInfoLengkap() {
        return "{$this->getInfo()} Sifat dari kucing ini {$this->sifat}.";
    }
}

class Anjing extends Animal {
    private $sifat;

    public function __construct($nama, $jenis, $sifat) {
        parent::__construct($nama, $jenis);
        $this->sifat = $sifat;
    }

    public function getInfoLengkap() {
        return "{$this->getInfo()} Sifat dari anjing ini {$this->sifat}.";
    }
}

$animal1 = new Animal("semut", "serangga");
$animal2 = new Kucing("kucing", "mamalia", "liar");
$animal3 = new Anjing("anjing", "mamalia", "cerdas");
echo $animal1->getInfo();
echo "<br>";
echo $animal2->getInfoLengkap();
echo "<br>";
echo $animal3->getInfoLengkap();
