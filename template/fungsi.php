<?php
require "koneksi.php";
$conKoneksi = new listQuery();
$action = $_POST['act'];

if(isset($action)){
    if($action=='updateStatusTerima'){
        $command=$conKoneksi->updateStatus($_POST);
        // $command=$conKoneksi->docAcc($id_user);
        if($command==1){
            echo json_encode(array("status"=>"Diterima"));
        }else{
            echo json_encode(array("status"=>"Error"));
        }
    } else if($action=='updateStatusTolak'){
        $command=$conKoneksi->rejectStatus($_POST);
        if($command==1){
            echo json_encode(array("status"=>"Ditolak"));
        }else{
            echo json_encode(array("status"=>"Error"));
        }
    } else if($action=="dokumenSelesai"){
        $command=$conKoneksi->finishDoc($_POST);
        if($command==1){
            echo json_encode(array("status"=>"Selesai"));
        }else{
            echo json_encode(array("status"=>"Error"));
        }
    }
    // else if($action == 'insertDoc'){
    //     $command=$conKoneksi->insertDok($_POST);
    //     if($command==1){
    //         echo json_encode(array("status"=>"Berhasil"));
    //     } else {
    //         echo json_encode(array("status"=>"Error"));
    //     }
    // }
}
?>