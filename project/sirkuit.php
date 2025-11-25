<?php

include_once("models/DB.php");
include_once("models/TabelSirkuit.php");
include_once("views/ViewSirkuit.php");
include_once("presenters/PresenterSirkuit.php");

$tabelSirkuit = new TabelSirkuit('localhost', 'mvp_db', 'root', '');
$viewSirkuit = new ViewSirkuit();
$presenter = new PresenterSirkuit($tabelSirkuit, $viewSirkuit);

if (isset($_GET['screen'])) {
    if ($_GET['screen'] == 'add') {
        echo $presenter->tampilkanFormSirkuit();
    } else if ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
        echo $presenter->tampilkanFormSirkuit($_GET['id']);
    }
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'add') {
        $presenter->tambahSirkuit($_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
    } else if ($action == 'edit') {
        $presenter->ubahSirkuit($_POST['id'], $_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
    } else if ($action == 'delete') {
        $presenter->hapusSirkuit($_POST['id']);
    }
    header("Location: sirkuit.php");
    exit();
} else {
    echo $presenter->tampilkanSirkuit();
}
?>