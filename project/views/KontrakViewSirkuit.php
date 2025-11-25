<?php

interface KontrakViewSirkuit
{
    public function tampilSirkuit($listSirkuit): string;
    public function tampilFormSirkuit($data = null): string;
}
?>