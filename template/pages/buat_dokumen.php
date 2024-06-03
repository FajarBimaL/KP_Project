<?php
// echo "Create Dokumen";
// require "koneksi.php";
// $mysqli = new database();

// $isiDoc = new formDoc();

if(isset($_POST['submit'])){
    $hasil = $ListQuery->isiForm(
        $_POST["nama_dokumen"],
        $_POST["pengirim"],
        $_POST["file_dokumen"],
        $_POST["jenis_dokumen"]
    );
}
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Dokumentasi</h4>
            <form method="POST" class="form-sample">
                <div class="form-group">
                    <label for="">Document Name</label>
                    <input type="text" name="nama_dokumen" class="form-control" placeholder="Document Name">
                </div>
                <div class="form-group">
                    <label for="">Pengirim</label>
                    <input type="text" name="pengirim" class="form-control" placeholder="Pengirim">
                </div>
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
                <div class="form-group">
                    <label for="">Jenis Dokumen</label>
                    <!-- <input type="text" class="form-control" placeholder="Pengirim"> -->
                    <select class="form-control col-sm-3" name="jenis_dokumen" id="jenis_dokumen" required="required">
                        <option value="Internal">Internal</option>
                        <option value="Eksternal">Eksternal</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
