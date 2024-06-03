<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button class="btn btn-primary"
        type="button"
        id="approvalButton"
        
        onclick="approveDocument()">Approved
    </button>
    <script>
        function approveDocument() {
            // Mengganti tombol menjadi teks 'Approved'
            document.getElementById('approvalButton').innerHTML = 'Approved';
            // Menghapus event listener agar tombol tidak dapat diklik lagi
            document.getElementById('approvalButton').removeAttribute('onclick');
        }
    </script>
    </body>
</html> -->

<?php

$options = ['cost' => 12,];
echo password_hash("re", PASSWORD_DEFAULT, $options);

echo '<br><br>Argon2i hash: ' . password_hash('bima1', PASSWORD_ARGON2I);

?>



<?php 
    public function documentIn2($id_user){
        $docIn = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi AND A.status='accept' OR A.penerima='all'=B.id_user AND A.status='accept' ORDER BY no_dokumen DESC");
        mysqli_fetch_assoc($docIn);
        if ($docIn->num_rows > 0){
            return $docIn;
        } else {
            return false;
        }
    }
?>



<?php
if(isset($_SESSION['lvl'])){
    $lvl = $_SESSION['lvl'];
    if($lvl == 'approval'){
        $hasilIn = $ListQuery->documentIn($_SESSION["id_user"]);
        if ($hasilIn){
            foreach($hasilIn as $row){
                ?>
                <tr>
                    <td><?=$no++; ?></td>
                    <td><?=$row["inv_dokumen"];?></td>
                    <td><?=$row["nama_dokumen"];?></td>
                    <td><?=$row["jenis_dokumen"];?></td>
                    <td><?=$row["pengirim"]; ?></td>
                    <td><?=$row["dari_div"]; ?></td>
                    <td><?=$row["kepada_div"]; ?></td>
                    <td><?=$row["penerima"]; ?></td>
                    <td><?=$row["file_dokumen"]; ?></td>
                    <td><?=$row["status"]; ?></td>
                    <td><?=$row["tgl_masuk"]; ?></td>
                    <td><?=$row["tgl_diterima"]; ?></td>
                    <td class="text-center">
                        <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                        <a  class="btn btn-primary" 
                            data-toggle="modal" 
                            href='#modalid'
                            onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                            '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                            ><i class="typcn typcn-eye"></i>
                        </a>
                        <!-- <form action="" method="POST" name="info"> -->
                        <!-- Form View Dokumen Mulai -->
                        
                        
                        <?php
                            if (isset($_SESSION['lvl'])){
                                $lvl = $_SESSION['lvl'];
                                if($lvl == 'approval'){ ?>
                                    <!-- dropdown button approve & decline maulai-->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                            <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                        </div>
                                    </div>
                                    <!-- dropdown button approve & decline selesai-->
                                <?php
                                } elseif ($lvl == 'petugas'){
                                //    echo "none";
                                }
                            }
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        }else{
            echo "tidak ada data";
        }
    } elseif ($lvl == 'petugas'){
        $hasilIn2 = $ListQuery->documentIn2($_SESSION["id_user"]);
        if ($hasilIn2){
            foreach($hasilIn2 as $row){
                ?>
                <tr>
                    <td><?=$no++; ?></td>
                    <td><?=$row["inv_dokumen"];?></td>
                    <td><?=$row["nama_dokumen"];?></td>
                    <td><?=$row["jenis_dokumen"];?></td>
                    <td><?=$row["pengirim"]; ?></td>
                    <td><?=$row["dari_div"]; ?></td>
                    <td><?=$row["kepada_div"]; ?></td>
                    <td><?=$row["penerima"]; ?></td>
                    <td><?=$row["file_dokumen"]; ?></td>
                    <td><?=$row["status"]; ?></td>
                    <td><?=$row["tgl_masuk"]; ?></td>
                    <td><?=$row["tgl_diterima"]; ?></td>
                    <td class="text-center">
                        <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                        <a  class="btn btn-primary" 
                            data-toggle="modal" 
                            href='#modalid'
                            onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                            '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                            ><i class="typcn typcn-eye"></i>
                        </a>
                        <!-- <form action="" method="POST" name="info"> -->
                        <!-- Form View Dokumen Mulai -->
                        
                        
                        <?php
                            if (isset($_SESSION['lvl'])){
                                $lvl = $_SESSION['lvl'];
                                if($lvl == 'approval'){ ?>
                                    <!-- dropdown button approve & decline maulai-->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                            <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                        </div>
                                    </div>
                                    <!-- dropdown button approve & decline selesai-->
                                <?php
                                } elseif ($lvl == 'petugas'){
                                //    echo "none";
                                }
                            }
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        }else{
            echo "tidak ada data";
        }
    }
}




$hasilIn = $ListQuery->documentIn($_SESSION["id_user"]);
if ($hasilIn){
    foreach($hasilIn as $row){
        ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$row["inv_dokumen"];?></td>
            <td><?=$row["nama_dokumen"];?></td>
            <td><?=$row["jenis_dokumen"];?></td>
            <td><?=$row["pengirim"]; ?></td>
            <td><?=$row["dari_div"]; ?></td>
            <td><?=$row["kepada_div"]; ?></td>
            <td><?=$row["penerima"]; ?></td>
            <td><?=$row["file_dokumen"]; ?></td>
            <td><?=$row["status"]; ?></td>
            <td><?=$row["tgl_masuk"]; ?></td>
            <td><?=$row["tgl_diterima"]; ?></td>
            <td class="text-center">
                <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                <a  class="btn btn-primary" 
                    data-toggle="modal" 
                    href='#modalid'
                    onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                    '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                    ><i class="typcn typcn-eye"></i>
                </a>
                <!-- <form action="" method="POST" name="info"> -->
                <!-- Form View Dokumen Mulai -->
                
                
                <?php
                    if (isset($_SESSION['lvl'])){
                        $lvl = $_SESSION['lvl'];
                        if($lvl == 'approval'){ ?>
                            <!-- dropdown button approve & decline maulai-->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                    <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                </div>
                            </div>
                            <!-- dropdown button approve & decline selesai-->
                        <?php
                        } elseif ($lvl == 'petugas'){
                        //    echo "none";
                        }
                    }
                ?>
                
            </td>
        </tr>
        <?php
    }
}else{
    echo "tidak ada data";
}

?>

<?php

$hasilIn = $ListQuery->documentIn($_SESSION["id_user"]);
$status = $ListQuery->documentIn($_POST["status"]);
if ($hasilIn){
    foreach($hasilIn as $row){
        ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$row["inv_dokumen"];?></td>
            <td><?=$row["nama_dokumen"];?></td>
            <td><?=$row["jenis_dokumen"];?></td>
            <td><?=$row["pengirim"]; ?></td>
            <td><?=$row["dari_div"]; ?></td>
            <td><?=$row["kepada_div"]; ?></td>
            <td><?=$row["penerima"]; ?></td>
            <td><?=$row["file_dokumen"]; ?></td>
            <td><?=$row["status"]; ?></td>
            <td><?=$row["tgl_masuk"]; ?></td>
            <td><?=$row["tgl_diterima"]; ?></td>
            <td class="text-center">
                <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                <a  class="btn btn-primary" 
                    data-toggle="modal" 
                    href='#modalid'
                    onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                    '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                    ><i class="typcn typcn-eye"></i>
                </a>
                <!-- <form action="" method="POST" name="info"> -->
                <!-- Form View Dokumen Mulai -->
                
                
                <?php
                    if (isset($_SESSION['lvl'])){
                        $lvl = $_SESSION['lvl'];
                        if($lvl == 'approval'){ ?>
                            <!-- dropdown button approve & decline maulai-->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                    <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                </div>
                            </div>
                            <!-- dropdown button approve & decline selesai-->
                        <?php
                        } elseif ($lvl == 'petugas'){
                        //    echo "none";
                        }
                    }
                ?>
                
            </td>
        </tr>
        <?php
    }
}else if($status == 'Accept'){
    $hasilIn2 = $ListQuery->docAcc($_SESSION["id_user"]);
    if ($hasilIn2){
        foreach($hasilIn2 as $row){
            ?>
            <tr>
                <td><?=$no++; ?></td>
                <td><?=$row["inv_dokumen"];?></td>
                <td><?=$row["nama_dokumen"];?></td>
                <td><?=$row["jenis_dokumen"];?></td>
                <td><?=$row["pengirim"]; ?></td>
                <td><?=$row["dari_div"]; ?></td>
                <td><?=$row["kepada_div"]; ?></td>
                <td><?=$row["penerima"]; ?></td>
                <td><?=$row["file_dokumen"]; ?></td>
                <td><?=$row["status"]; ?></td>
                <td><?=$row["tgl_masuk"]; ?></td>
                <td><?=$row["tgl_diterima"]; ?></td>
                <td class="text-center">
                    <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                    <a  class="btn btn-primary" 
                        data-toggle="modal" 
                        href='#modalid'
                        onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                        '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                        ><i class="typcn typcn-eye"></i>
                    </a>
                    <!-- <form action="" method="POST" name="info"> -->
                    <!-- Form View Dokumen Mulai -->
                    
                    
                    <?php
                        if (isset($_SESSION['lvl'])){
                            $lvl = $_SESSION['lvl'];
                            if($lvl == 'approval'){ ?>
                                <!-- dropdown button approve & decline maulai-->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                        <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                    </div>
                                </div>
                                <!-- dropdown button approve & decline selesai-->
                            <?php
                            } elseif ($lvl == 'petugas'){
                            //    echo "none";
                            }
                        }
                    ?>
                    
                </td>
            </tr>
            <?php
        }
    }

}

?>

<?php 
    $hasilIn = $ListQuery->documentIn($_SESSION["id_user"] && $_POST["status"]);
    if ($hasilIn = "pendingDari"){
        foreach($hasilIn as $row){
            ?>
            <tr>
                <td><?=$row["inv_dokumen"];?></td>
                <td><?=$row["nama_dokumen"];?></td>
                <td><?=$row["jenis_dokumen"];?></td>
                <td><?=$row["pengirim"]; ?></td>
                <td><?=$row["dari_div"]; ?></td>
                <td><?=$row["kepada_div"]; ?></td>
                <td><?=$row["penerima"]; ?></td>
                <td><?=$row["file_dokumen"]; ?></td>
                <td><?=$row["status"]; ?></td>
                <td><?=$row["tgl_masuk"]; ?></td>
                <td><?=$row["tgl_diterima"]; ?></td>
                <td><?=$row["tgl_selesai"];?></td>
                <td class="text-center">
                    <!-- Modal button untuk melihat rincian dokumen yang dikirim mulai -->
                    <a  class="btn btn-primary" 
                        data-toggle="modal" 
                        href='#modalid'
                        onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                        '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                        ><i class="typcn typcn-eye"></i>
                    </a>
                    <!-- <form action="" method="POST" name="info"> -->
                    <!-- Form View Dokumen Mulai -->

                    <?php
                        if (isset($_SESSION['lvl'])){
                            $lvl = $_SESSION['lvl'];
                            if($lvl == 'approval'){ ?>
                                <!-- dropdown button approve & decline maulai-->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="statusAcc('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
                                        <a class="dropdown-item" onclick="statusReject('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Reject</a>
                                    </div>
                                </div>
                                <!-- dropdown button approve & decline selesai-->
                            <?php
                            } elseif ($lvl == 'petugas'){
                                $status=['status'];
                                if($status=['status']){?>

                                <div class="btn-group">
                                    <button id="finish" onclick="statusFinish('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>','finish')" class="btn btn-primary">Finish</button>
                                </div>
                                <!-- dropdown button approve & decline selesai-->
                                <?php }
                            //    echo "none";
                            }
                        }
                    ?>
                    
                </td>
            </tr>
            <?php
        }
    }else{
        echo "tidak ada data";
    }
?>





<!-- BUTTON -->
<?php
    if(isset($_SESSION['lvl'])){
        $lvl = $_SESSION['lvl'];
        if($lvl == 'petugas'){ ?>
            <!-- Form View Dokumen Mulai -->
            <a  class="btn btn-primary"
                data-toggle="modal" 
                href='#modalid'
                onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                ><i class="typcn typcn-eye"></i>
            </a>
            

            <div class="btn-group">
                <button id="finish" onclick="statusFinish('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')" class="btn btn-primary">Finish</button>
            </div>
            <!-- dropdown button approve & decline selesai-->
            
        <?php } 
    }
?>