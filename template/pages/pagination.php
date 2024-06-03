<?php
    $halaman = @$_GET['page'];

    switch ($halaman) {
        case 'dokumentasi':
            include"halaman_dokumen.php";
        break;
        case 'buat_dokumen':
            include"buat_dokumen.php";
        break;
        case 'dokumen_masuk':
            include"dokumen_masuk.php";
        break;
        case "riwayat_masuk":
            include"riwayat_masuk.php";
            break;
        case "riwayat_keluar":
            include "riwayat_keluar.php";
            break;
        
        default:
            include"dashboard.php";
            echo "<script> $('#preloader').addClass('d-none'); </script>";
            break;
    }

?>