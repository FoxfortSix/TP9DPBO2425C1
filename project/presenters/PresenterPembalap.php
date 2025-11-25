<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap;
    private $viewPembalap;
    private $listPembalap = [];

    public function __construct($tabelPembalap, $viewPembalap)
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        try {
            if ($this->tabelPembalap->getAllPembalap()) {
                $this->initListPembalap();
            }
        } catch (Exception $e) {
            $this->listPembalap = [];
        }
    }

    public function initListPembalap()
    {
        $data = $this->tabelPembalap->getAllPembalap();
        $this->listPembalap = [];

        foreach ($data as $row) {
            $pembalap = new Pembalap(
                $row['id'],
                $row['nama'],
                $row['tim'],
                $row['negara'],
                $row['poinMusim'],
                $row['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    public function tampilkanPembalap(): string
    {
        $this->initListPembalap();
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    public function tampilkanFormPembalap($id = null): string
    {
        if ($id) {
            $data = $this->tabelPembalap->getPembalapById($id);
            return $this->viewPembalap->tampilFormPembalap($data);
        } else {
            return $this->viewPembalap->tampilFormPembalap();
        }
    }

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }

    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }

    public function hapusPembalap($id): void
    {
        $this->tabelPembalap->deletePembalap($id);
    }
}
?>