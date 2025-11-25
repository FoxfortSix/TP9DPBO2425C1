<?php

include_once("models/DB.php");
include_once("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel
{
    public function __construct($host, $db_name, $username, $password)
    {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllPembalap(): array
    {
        $query = "SELECT * FROM pembalap";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getPembalapById($id): ?array
    {
        $query = "SELECT * FROM pembalap WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        $result = $this->getAllResult();
        return !empty($result) ? $result[0] : null;
    }

    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES (:nama, :tim, :negara, :poinMusim, :jumlahMenang)";
        $params = [
            ':nama' => $nama,
            ':tim' => $tim,
            ':negara' => $negara,
            ':poinMusim' => $poinMusim,
            ':jumlahMenang' => $jumlahMenang
        ];
        $this->executeQuery($query, $params);
    }

    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $query = "UPDATE pembalap SET nama = :nama, tim = :tim, negara = :negara, poinMusim = :poinMusim, jumlahMenang = :jumlahMenang WHERE id = :id";
        $params = [
            ':id' => $id,
            ':nama' => $nama,
            ':tim' => $tim,
            ':negara' => $negara,
            ':poinMusim' => $poinMusim,
            ':jumlahMenang' => $jumlahMenang
        ];
        $this->executeQuery($query, $params);
    }

    public function deletePembalap($id): void
    {
        $query = "DELETE FROM pembalap WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
    }
}
?>