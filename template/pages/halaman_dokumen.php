<!-- tabel halaman dokumen mulai -->
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

if(isset($_POST['submit'])){
    $hasil = $ListQuery->isiForm(
        // $_POST["no_dokumen"],
        // $_POST["inv_dokumen"],
        $_POST["id_divisi"],
        $_POST["id_divisi_kepada"],
        $_POST["no_dokumen"],
        $_POST["inv_dokumen"],
        $_POST["nama_dokumen"],
        $_POST["pengirim"],
        $_POST["dari_div"],
        $_POST["kepada_div"],
        $_POST["penerima"],
        $_POST["file_dokumen"],
        $_POST["jenis_dokumen"],
        $_POST["status"]
    );
}
?>
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<link href="sweet-alert2.css" rel="stylesheet" type="text/css">


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Dokumen Keluar</h4>
            <div class="row">
                <?php
                    if(isset($_SESSION['lvl'])){
                        $lvl = $_SESSION['lvl'];
                        if($lvl == 'Petugas'){ ?>
                            <a class="btn btn-primary" data-toggle="modal" href='#modal-id'><i class="typcn typcn-document btn-icon-append"></i></a>
                    <?php }
                    }
                ?>
                
                <!-- Form pembuatan laporan dokumen mulai -->
                <div class="modal fade" id="modal-id">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                <h4 class="modal-title">Dokumentasi</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="submit" class="form-sample">
                                    <div class="form-group">
                                        <label for="">Document Name</label>
                                        <input type="text" name="nama_dokumen" class="form-control" placeholder="Document Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pengirim</label>
                                        <input type="text" name="pengirim" class="form-control" value="<?= $user["nama_user"]; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Dari divisi</label><br>
                                        <!-- <input type="text" name="pengirim" class="form-control" placeholder="Pengirim"> -->
                                        <select class="col-sm-6" name="id_divisi">
                                            <?php
                                                $listDiv = $ListQuery->divisi();
                                                if ($listDiv){
                                                    foreach($listDiv as $hasil){
                                                        echo "<option value='$hasil[id_divisi]'>$hasil[deskripsi]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kepada divisi</label><br>
                                        <!-- <input type="text" name="pengirim" class="form-control" placeholder="Pengirim"> -->
                                        <select class="col-sm-6" name="id_divisi_kepada">
                                            <?php
                                                $listDiv2 = $ListQuery->divisi();
                                                if ($listDiv2){
                                                    foreach($listDiv2 as $hasil){
                                                        echo "<option value=$hasil[id_divisi]>$hasil[deskripsi]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Radio button select penerima mulai (masih gagal)-->
                                    <!-- <div class="form-group">
                                        <label for="">Penerima</label><br>
                                        <input type="text" name="pengirim" class="form-control" placeholder="Pengirim">
                                        <select class="col-sm-6" name="penerima">

                                        </select>
                                    </div> -->
                                    <!-- Radio button select penerima selesai-->


                                    <div class="form-group">
                                        <label for="">Penerima</label><br>
                                        <!-- <input type="text" name="pengirim" class="form-control" placeholder="Pengirim"> -->
                                        <select class="col-sm-6" name="penerima">
                                            <?php
                                                $listLVL = $ListQuery->lvlPenerima();
                                                if ($listLVL){
                                                    foreach($listLVL as $hasil){
                                                        
                                                        echo "<option value=$hasil[nama_user]>$hasil[nama_user]</option>";
                                                    }
                                                        echo "<option>ALL</option>";

                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- input text untuk field penerima mulai -->
                                    <!-- <div class="form-group">
                                        <label for="">Penerima</label>
                                        <input type="text" name="penerima" class="form-control" placeholder="Penerima">
                                    </div> -->
                                    <!-- input text untuk field penerima mulai -->

                                    <!-- field upload file dokumen mulai -->
                                    <div class="form-group">
                                        <label for="">File Document</label>
                                        <!-- <input type="text" class="doc[]" class="file-upload-default"> -->
                                        <div class="input-group col-xs-12">
                                            <input type="file" name="file_dokumen" class="form-control file-upload-info"  placeholder="Upload Document">
                                            <!-- <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span> -->
                                        </div>
                                    </div>
                                    <!-- field upload file dokumen mulai -->

                                    <!-- field jenis dokumen mulai -->
                                    <div class="form-group">
                                        <label for="jenis_dokumen">Jenis Dokumen</label>
                                        <!-- <input type="text" class="form-control" placeholder="Pengirim"> -->
                                        <select class="form-control col-sm-3" name="jenis_dokumen" id="jenis_dokumen" required="required">
                                            <option value="Internal">Internal</option>
                                            <option value="Eksternal">Eksternal</option>
                                        </select>
                                    </div>
                                    <!-- field jenis dokumen selesai -->
                                    <input type="hidden" name="status" class="form-control" value="pendingDari">

                                    
                                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Form pembuatan laporan dokumen selesai -->
            </div><br>
            <!-- Tabel untuk menampilkan dokumen yang telah dibuat (mulai) -->
            <div class="table-responsive">
                <?php
                    print_r($_SESSION);
                ?>
                <table id="dokumenKeluar" class="table table-hover">
                    <thead>
                    <tr>
                            <!-- <th>#</th> -->
                            <th>Inv.Dok</th>
                            <th>nama dokumen</th>
                            <th>jenis dokumen</th>
                            <th>pengirim</th>                           
                            <th>dari div</th>
                            <th>Kepada div</th>
                            <th>penerima</th>
                            <th>file</th>
                            <th>Status</th>
                            <th>Masuk</th>
                            <th>Acc</th>
                            <th>Finish</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            // $newView = new viewDoc();
                            $hasilIn = $ListQuery->documentIn($_SESSION["id_user"]);
                            if ($hasilIn){ 
                                foreach($hasilIn as $row){?>
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
                                        <a  class="btn btn-primary"
                                            data-toggle="modal"
                                            href="#modalid"
                                            onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                                            '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')">
                                            <i class="typcn typcn-eye"></i>
                                        </a>

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
                                <?php }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabel untuk menampilkan dokumen yang telah dibuat (selesai) -->
        </div>
        <?php
        // print_r($row["dari_div"]);
        // print_r($row["kepada_div"]);
        ?>
    </div>
</div>
<!-- tabel halaman dokumen selesai -->
<!-- modal form detail dokumentasi mulai -->
<div class="modal fade" id="modalid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dokumen</h4>
            </div>
            <form class="form-sample">
                <div class="modal-body">
                    <input type="text" name="id_dokumen" id="modalid_doc" hidden>
                    <!-- <h6 class="col-sm-1" name="inv_dokumen" id="modal_inv" value=""></h6> -->
                    <!-- <input class="col-sm-2" type="text" name="inv_dokumen" id="modal_inv" style="border: none;"> -->
                    <!-- main row -->
                    <div class="row">                                                                                    
                        <div class="col-md-6">
                            <div class="form-group row">                                                                 
                                <label for="" class="col-sm-4 col-form-label">No Dokumen :</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="inv_dokumen" id="modal_inv" style="border: none; font-weight:bold;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Status :</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="status" id="modal_status" style="border: none; font-weight:bold; " readonly><br>                                                                                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row 1 -->
                    <div class="row">                                                                                    
                        <div class="col-md-6">
                            <div class="form-group row">                                                                 
                                <label for="" class="col-sm-4 col-form-label">Nama Dokumen :</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="nama_dokumen" id="modalnama_doc" style="border: none; font-weight:bold;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Pengirim :</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="pengirim" id="modal_pengirim" style="border: none; font-weight:bold;" readonly><br>                                                                                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row 2 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <!-- label -->
                                <label class="col-sm-3 col-form-label" for="">Dari Divisi :</label>
                                <div class="col-md-10">
                                    <!-- input -->
                                    <input type="text" class="form-control" name="dari_div" id="modal_dari" style="border: none; font-weight:bold;" readonly><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <!-- label -->
                                <label class="col-sm-3 col-form-label" for="">Kepada Divisi :</label>
                                <div class="col-md-10">
                                    <!-- input -->
                                    <input type="text" class="form-control" name="kepada_div" id="modal_kepada" style="border: none; font-weight:bold;" readonly><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <!-- label -->
                                <label for="" class="col-sm-3 col-form-label">Penerima :</label>
                                <div class="col-md-10">
                                    <!-- input -->
                                    <input type="text" class="form-control" name="penerima" id="modal_penerima" style="border: none; font-weight:bold;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <!-- label -->
                                <label for="" class="col-sm-3 col-form-label">File :</label>
                                <div class="col-md-10">
                                    <!-- input -->
                                    <input type="text" class="form-control" name="file_dokumen" id="modal_file" style="border: none; font-weight:bold;" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-danger">Decline</button>
                <button type="button" class="btn btn-primary d-none">Approve</button> -->
            </div>
        </div>
    </div>
</div>
<!-- modal form detail dokumentasi selesai -->
<!-- script jquery & js-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="sweet-alert2.js"></script>

<script>
    function modalid(id_dokumen,inv_dokumen, nama_dokumen, pengirim, dari_div, kepada_div, penerima, file_dokumen,status){
    document.getElementById('modalid_doc').value = id_dokumen;
    document.getElementById('modal_inv').value = inv_dokumen;
    document.getElementById('modalnama_doc').value = nama_dokumen;
    document.getElementById('modal_pengirim').value = pengirim;
    document.getElementById('modal_dari').value = dari_div;
    document.getElementById('modal_kepada').value = kepada_div;
    document.getElementById('modal_penerima').value = penerima;
    document.getElementById('modal_file').value = file_dokumen;
    document.getElementById('modal_status').value = status;
    }
    // datatables
    new DataTable('#dokumenKeluar');
    // new DataTable('#dokumenKeluar',{
    //     ajax: 'server_side.php',
    //     processing: true,
    //     serverSide: true,
    //     // "columnDefs": [{"render": createManageBtn, "data": null, "targets": [0]}]

    // });

        // button dropdown accept
        function statusAcc(id,nama){
        swal({
            title:"Terima dokumen "+ "'" + nama+ "'" +" ini?",
            type:"question",
            showCancelButton:true
        }).then(function(){
            $.ajax({
                url: "fungsi.php",
                type: "POST",
                data:{act:"updateStatusTerima",id:id,table:"tb_dokumen",field:"id_dokumen",status:"pendingKepada"},
                // data:{act:"updateStatusTerima",id:id,id:"id_dokumen",status:"Accept"},
                // data: {act:"insertAfterACC"},
                dataType: "JSON",
                success:function(data){
                    if(data.status=="Diterima"){
                        // $('#act').val('insertAfterACC');
                        // $(".insertData");
                        swal({
                            title:"Dokumen "+"'"+nama+"'"+" berhasil diterima!",
                            type: "success",
                        }).then(function(){
                            location.reload();
                        })
                    }else if (data.status=="Error"){
                        swal({
                            title:"Maaf! Data belum berhasil di update!",
                            type:"warning",
                        }).then(function(){
                            swal.close();
                        });
                    }
                }
            })
        })
    }
    // button dropdown Reject
    function statusReject(id,nama){
        swal({
            title:"Tolak dokumen "+ "'" + nama+ "'" +" ini?",
            type:"question",
            showCancelButton:true,
        }).then(function(){
            $.ajax({
                url: "fungsi.php",
                type:"POST",
                data:{act:"updateStatusTolak",id:id,table:"tb_dokumen",field:"id_dokumen",status:"Reject"},
                // data:{act:"updateStatusTolak",id:id,id:"id_dokumen",status:"Reject"},
                dataType:"JSON",
                success: function(data){
                    if(data.status=="Ditolak"){
                        swal({
                            title:"Dokumen "+"'"+nama+"'"+" telah ditolak!",
                            type: "info",
                        }).then(function(){
                            location.reload();
                        })
                    }else if(data.status=="Error"){
                        swal({
                            title:"Maaf! Data belum berhasil di update!",
                            type:"warning",
                        }).then(function(){
                            swal.close();
                        });
                    }
                }
            })
        })
    }
    function statusFinish(id,nama,buttonId){
        swal({
            title:"Proses Dokumen "+ "'" + nama+ "'" +" telah selesai?",
            type:"question",
            showCancelButton:true
        }).then(function(){
            $.ajax({
                url: "fungsi.php",
                type: "POST",
                data:{act:"dokumenSelesai",id:id,table:"tb_dokumen",field:"id_dokumen",status:"Finish"},
                // data:{act:"updateStatusTerima",id:id,id:"id_dokumen",status:"Accept"},
                // data: {act:"insertAfterACC"},
                dataType: "JSON",
                success:function(data){
                    
                    if(data.status=="Selesai"){
                        // $('#act').val('insertAfterACC');
                        // $(".insertData");
                        // $("#" + buttonId).prop("disabled", true);
                        // $("#" + itemId).remove();

                        swal({
                            title:"Dokumen "+"'"+nama+"'"+" telah selesai diproses!",
                            type: "success",
                        }).then(function(){
                            location.reload();
                        })
                    }else if (data.status=="Error"){
                        swal({
                            title:"Maaf! Data belum berhasil di update!",
                            type:"warning",
                        }).then(function(){
                            swal.close();
                        });
                    }
                }
            })
        })
    }
</script>




