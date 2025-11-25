<?php

include_once("KontrakViewSirkuit.php");
include_once(__DIR__ . "/../models/Sirkuit.php");

class ViewSirkuit implements KontrakViewSirkuit
{
    public function tampilSirkuit($listSirkuit): string
    {
        $tbody = '';
        $no = 1;
        foreach ($listSirkuit as $sirkuit) {
            $tbody .= '<tr>';
            $tbody .= '<td>' . $no++ . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getNama()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getNegara()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getPanjang()) . ' KM</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getTikungan()) . '</td>';
            $tbody .= '<td>
                        <a href="sirkuit.php?screen=edit&id=' . $sirkuit->getId() . '" class="btn btn-edit">Edit</a>
                        <form method="POST" action="sirkuit.php" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="' . $sirkuit->getId() . '">
                            <button type="submit" class="btn btn-delete" onclick="return confirm(\'Hapus?\')">Hapus</button>
                        </form>
                       </td>';
            $tbody .= '</tr>';
        }

        $template = file_get_contents(__DIR__ . '/../template/skin_sirkuit.html');
        $template = str_replace('<!-- PHP WILL INJECT ROWS HERE -->', $tbody, $template);
        return $template;
    }

    public function tampilFormSirkuit($data = null): string
    {
        $template = file_get_contents(__DIR__ . '/../template/form_sirkuit.html');
        if ($data) {
            $template = str_replace('value="add" id="sirkuit-action"', 'value="edit" id="sirkuit-action"', $template);
            $template = str_replace('value="" id="sirkuit-id"', 'value="' . $data['id'] . '" id="sirkuit-id"', $template);
            $template = str_replace('name="nama" id="nama" type="text"', 'name="nama" id="nama" type="text" value="' . $data['nama'] . '"', $template);
            $template = str_replace('name="negara" id="negara" type="text"', 'name="negara" id="negara" type="text" value="' . $data['negara'] . '"', $template);
            $template = str_replace('name="panjang" id="panjang" type="number"', 'name="panjang" id="panjang" type="number" value="' . $data['panjang_km'] . '"', $template);
            $template = str_replace('name="tikungan" id="tikungan" type="number"', 'name="tikungan" id="tikungan" type="number" value="' . $data['jumlah_tikungan'] . '"', $template);
        }
        return $template;
    }
}
?>