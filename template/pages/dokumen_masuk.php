<?php

?>
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<link href="sweet-alert2.css" rel="stylesheet" type="text/css">

<!-- table menampilkan data dokumen yang masuk selesai -->
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Dokumen Masuk</h4>
            <div class="table-responsive">
                <table id="dokumenMasuk" class="table table-hover">
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

                        $hasilIn2 = $ListQuery->documentIn2($_SESSION["id_user"]);
                        if ($hasilIn2){
                            foreach($hasilIn2 as $row){ ?>
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
                                                        <a class="dropdown-item" onclick="statusAcc2('<?=$row['id_dokumen'];?>','<?=$row['nama_dokumen'];?>')">Accept</a>
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
                        
                        $hasilIn3 = $ListQuery->documentIn3($_SESSION["id_user"]);
                        if ($hasilIn3){
                            foreach($hasilIn3 as $row){ ?>
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
                                    
                                    <?php
                                        if(isset($_SESSION['lvl'])){
                                            $lvl = $_SESSION['lvl'];
                                            if($lvl == 'Petugas'){ ?>
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
                                                
                                            <?php } else if($lvl == 'approval'){ ?>
                                                <a  class="btn btn-primary"
                                                    data-toggle="modal" 
                                                    href='#modalid'
                                                    onclick="modalid(<?=$row['id_dokumen'];?>,'<?=$row['inv_dokumen'];?>', '<?=$row['nama_dokumen'];?>', '<?=$row['pengirim'];?>', '<?=$row['dari_div'];?>', '<?=$row['kepada_div'];?>',
                                                                    '<?=$row['penerima'];?>', '<?=$row['file_dokumen'];?>', '<?=$row['status'];?>')"
                                                    ><i class="typcn typcn-eye"></i>
                                                </a>
                                            <?php }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
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
                                    <input type="text" class="form-control" name="status" id="modal_status" style="border: none; font-weight:bold;" readonly><br>                                                                                                
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
                                    <input type="text" class="form-control" name="nama_dokumen" id="modalnama_doc" style="border: none; font-weight:bold;" readonly>
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

<!-- pembuatan js script -->
<!-- <script>
    $(document).ready(function(){
        $('#dokumenMasuk').DataTable();
    });
</script> -->
<script>
    // <!-- script onclick dari button view mulai -->
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
    new DataTable('#dokumenMasuk');
    // new DataTable('#dokumenMasuk',{
    //     ajax: 'server_side.php',
    //     processing: true,
    //     serverSide: true,
    //     // order: [],
    //     // columnDefs : [{
    //     //     "target" : [0,12],
    //     //     "orderable" : false
    //     //     // "defaultContent":"-",
    //     //     // "targets": "_all"
    //     // }]
    //     // "columnDefs": [{"render": createManageBtn, "data": null, "targets": [0]}]

    // });
    // new DataTable('#dokumenMasuk', {
    //     ajax : 'server_side.php',
    //     processing: true,
    //     serverSide: true
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

    function statusAcc2(id,nama){
        swal({
            title:"Terima dokumen "+ "'" + nama+ "'" +" ini?",
            type:"question",
            showCancelButton:true
        }).then(function(){
            $.ajax({
                url: "fungsi.php",
                type: "POST",
                data:{act:"updateStatusTerima",id:id,table:"tb_dokumen",field:"id_dokumen",status:"Accept"},
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
<!-- <script type="text/javascript">
    function createManageBtn(){
        return '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>';
    }
</script> -->


