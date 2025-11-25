<?php

include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);

if (isset($_GET['screen'])) {
    if ($_GET['screen'] == 'add') {
        $formHtml = $presenter->tampilkanFormPembalap();
        echo $formHtml;
    } else if ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
        $formHtml = $presenter->tampilkanFormPembalap($_GET['id']);
        echo $formHtml;
    }
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $presenter->tambahPembalap(
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    } else if ($action == 'edit') {
        $presenter->ubahPembalap(
            $_POST['id'],
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    } else if ($action == 'delete') {
        $presenter->hapusPembalap($_POST['id']);
    }

    header("Location: index.php");
    exit();
} else {
    $html = $presenter->tampilkanPembalap();
    echo $html;
}
?>