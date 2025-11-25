<?php

include_once("KontrakPresenterSirkuit.php");
include_once(__DIR__ . "/../models/TabelSirkuit.php");
include_once(__DIR__ . "/../models/Sirkuit.php");
include_once(__DIR__ . "/../views/ViewSirkuit.php");

class PresenterSirkuit implements KontrakPresenterSirkuit
{
    private $tabelSirkuit;
    private $viewSirkuit;
    private $listSirkuit = [];

    public function __construct($tabelSirkuit, $viewSirkuit)
    {
        $this->tabelSirkuit = $tabelSirkuit;
        $this->viewSirkuit = $viewSirkuit;
    }

    public function initListSirkuit()
    {
        $data = $this->tabelSirkuit->getAllSirkuit();
        $this->listSirkuit = [];
        foreach ($data as $row) {
            $this->listSirkuit[] = new Sirkuit($row['id'], $row['nama'], $row['negara'], $row['panjang_km'], $row['jumlah_tikungan']);
        }
    }

    public function tampilkanSirkuit(): string
    {
        $this->initListSirkuit();
        return $this->viewSirkuit->tampilSirkuit($this->listSirkuit);
    }

    public function tampilkanFormSirkuit($id = null): string
    {
        if ($id) {
            $data = $this->tabelSirkuit->getSirkuitById($id);
            return $this->viewSirkuit->tampilFormSirkuit($data);
        }
        return $this->viewSirkuit->tampilFormSirkuit();
    }

    public function tambahSirkuit($nama, $negara, $panjang, $tikungan): void
    {
        $this->tabelSirkuit->addSirkuit($nama, $negara, $panjang, $tikungan);
    }

    public function ubahSirkuit($id, $nama, $negara, $panjang, $tikungan): void
    {
        $this->tabelSirkuit->updateSirkuit($id, $nama, $negara, $panjang, $tikungan);
    }

    public function hapusSirkuit($id): void
    {
        $this->tabelSirkuit->deleteSirkuit($id);
    }
}
?>