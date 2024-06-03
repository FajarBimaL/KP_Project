<?php
// echo "riwayat keluar";
?>


<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Riwayat Dokumen Keluar</h4>
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
                            $inHistory = $ListQuery->riwayatKeluar($_SESSION["id_user"]);
                            if ($inHistory){
                                foreach($inHistory as $row){ ?>
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
                                        </td>
                                    </tr>
                                <?php }
                            }

                        ?>
                    </tbody>
                    
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
                                    <input type="text" class="form-control" name="status" id="modal_status" style="border: none; font-weight:bold; color:green; " readonly><br>                                                                                                
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
</script>