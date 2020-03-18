<?php

final class AuditLog
{
    public function save()
    {

    }

    private  function setMessage($tableName)
    {

    }

    private  function setAnggotaMessage()
    {
        $message = 'Menambahkan Anggota Baru';
        $message = 'Menonaktifkan Anggota';
        $message = 'Melakukan Simpanan %s';
        $message = 'Melakukan Pinjaman %s';
        $message = 'Melakukan Angsuran';

    }
}