<?php

interface KontrakModelSirkuit
{
    public function getAllSirkuit(): array;
    public function getSirkuitById($id): ?array;
    public function addSirkuit($nama, $negara, $panjang, $tikungan): void;
    public function updateSirkuit($id, $nama, $negara, $panjang, $tikungan): void;
    public function deleteSirkuit($id): void;
}
?>