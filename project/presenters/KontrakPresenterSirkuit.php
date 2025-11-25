<?php

interface KontrakPresenterSirkuit
{
    public function tampilkanSirkuit(): string;
    public function tampilkanFormSirkuit($id = null): string;
    public function tambahSirkuit($nama, $negara, $panjang, $tikungan): void;
    public function ubahSirkuit($id, $nama, $negara, $panjang, $tikungan): void;
    public function hapusSirkuit($id): void;
}
?>