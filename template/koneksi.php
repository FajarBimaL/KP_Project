<?php

session_start();
ini_set("display_errors","on");
// pembuatan class parent database untuk koneksi database
class database{
    public $host = "localhost"; 
    public $user = "root";
    public $password = "";
    public $dbname = "db_dokumentasi";
    public $conn;

    // membuat fungsi untuk koneksi database
    public function __construct()
    {
        $this->conn = mysqli_connect($this->host,$this->user,$this->password,$this->dbname);
    }
}

class register extends database{
    public function registrasi($id_divisi, $nama_user, $pass, $lvl){
        $duplicate = mysqli_query($this->conn, "SELECT * FROM tb_user where nama_user = '$nama_user'");
        if(mysqli_num_rows($duplicate) > 0 ){
            return 10;
            // username telah digunakan
        } else {
            if($pass){             
                $queryPass = mysqli_query($this->conn, "INSERT INTO tb_user (id_divisi, nama_user, pass, lvl) VALUES ('$id_divisi', '$nama_user', '$pass', '$lvl')");
                // password_hash($pass, PASSWORD_DEFAULT);
                mysqli_fetch_assoc($queryPass);
                
                return 1;
                // registrasi berhasil
            }
        }
    }

    // public function lvlRegis(){
    //     $queryLevel = mysqli_query($this->conn, "SELECT lvl FROM tb_user");
    //     mysqli_fetch_assoc($queryLevel);
    //     if ($queryLevel->num_rows > 0){
    //         return $queryLevel;
    //     } else {
    //         return false;
    //     }
    // }
}

// membuat class global child dan inheritance class database
class masuk extends database {
    public $id_user;
    public $nama_user;
    public $lvl;

    // membuat publik fungsi user login
    public function userMasuk($nama_user,$pass){
        $queryLog = mysqli_query($this->conn, "SELECT * FROM tb_user where nama_user = '$nama_user'");
        $row = mysqli_fetch_assoc($queryLog);
        $passNow = $row['pass'];

        // kondisi if pada halaman login
        if(mysqli_num_rows($queryLog) > 0 ){
            if($pass == $passNow || password_verify($pass,$passNow)){
                $this->id_user = $row["id_user"];
                $this->nama_user = $row["nama_user"];
                $this->lvl = $row["lvl"];
                // $this->$pass=password_verify($pass,$passNow);
                return 1;
                // login berhasil
            }
            else{
                return 10;
                // pass salah
            }
        }
        else{
            return 100;
            // user tidak terdaftar
        }
    }
    // membuat publik fungsi id user, dengan mengambil (public $id_user)
    public function userID(){
        return $this->id_user;
    }

    // membuat publik fungsi id user, dengan mengambil (public $nama_user)
    public function nmUser(){
        return $this->nama_user;
    }

    // membuat publik fungsi id user, dengan mengambil (public $lvl_user)
    public function lvlUsr(){
        return $this->lvl;
    }

    // publik fungsi untuk mengambil data user yang berhasil login dan akan ditampilkan dalam dashboard.
    public function userSelected($id_user){
        // $hasilSelect = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE id_user = '$id_user'"); (query percobaan)

        $hasilSelect = mysqli_query($this->conn, "SELECT A.nama_user,A.lvl,B.deskripsi FROM tb_user A, tb_divisi B WHERE A.id_user='$id_user' AND A.id_divisi=B.id_divisi");
        return mysqli_fetch_assoc($hasilSelect);
    }

}

// membuat listQuery untuk menampilkan(show),membuat(create),dan mengupdate(update) data dari database
class listQuery extends database {

    // fungsi untuk pengisian form dokumen
    public function isiForm($id_divisi, $id_divisi_kepada, $no_dokumen, $inv_dokumen, $nama_dokumen, $pengirim, $dari_div, $kepada_div, $penerima, $file_dokumen, $jenis_dokumen,$status){
        // menampilkan nama divisi pada tabel dokumen ($dari div) yang diambil dari database tb_divisi (untuk menampilkan data agar terlihat saat di tabel field (dari div))
        $queryNama = mysqli_query($this->conn,"SELECT * FROM tb_divisi WHERE id_divisi=$id_divisi");
        $hasilQueryNama = mysqli_fetch_array($queryNama);
        $dari_div=$hasilQueryNama[1];
        echo $dari_div;

        // menampilkan nama divisi pada tabel dokumen untuk field (kepada divisi) yang diambil dari database tb_divisi (untuk menampilkan data agar terlihat saat di tabel field (kepada div))
        $queryNama2 = mysqli_query($this->conn,"SELECT * FROM tb_divisi WHERE id_divisi=$id_divisi_kepada");
        $hasilQueryNama2 = mysqli_fetch_array($queryNama2);
        $kepada_div=$hasilQueryNama2[1];
        echo $kepada_div;

        // pembuatan no dokumen (seperti no invoice)
        // $queryNoDoc = mysqli_query($this->conn, "SELECT MAX(no_dokumen) AS no_dokumen FROM tb_dokumen WHERE YEAR(tgl_masuk) = YEAR(NOW())");
        $queryNoDoc = mysqli_query($this->conn, "SELECT MAX(no_dokumen) AS no_dokumen FROM tb_dokumen WHERE id_divisi_kepada=$id_divisi_kepada AND YEAR(tgl_masuk) = YEAR(NOW())");
        // deklarasi $hasilQuery untuk update no dokumen, jika tidak melakukan deklarasi akan terjadi error.
        $hasilQuery=mysqli_fetch_array($queryNoDoc);

        // if kondisi untuk melakukan update no dokumen
        if($hasilQuery['no_dokumen']==''){
            $bulan=date("m/Y");
            $inv_dokumen='1/'.$kepada_div.'/'.$bulan;
            $no_dokumen=1;
        } else {
            $bulan=date("m/Y");
            $no_dokumen=(int)$hasilQuery['no_dokumen']+1;
            $inv_dokumen=$no_dokumen.'/'.$kepada_div.'/'.$bulan;
        }
        // query insert data, setelah semua kondisi diatas berhasil di eksekusi
        $query = mysqli_query($this->conn, "INSERT INTO tb_dokumen (id_divisi, id_divisi_kepada, no_dokumen, inv_dokumen, nama_dokumen, pengirim, dari_div, kepada_div, penerima, file_dokumen, jenis_dokumen,status, tgl_masuk) VALUES ('$id_divisi','$id_divisi_kepada','$no_dokumen','$inv_dokumen','$nama_dokumen','$pengirim','$dari_div','$kepada_div','$penerima','$file_dokumen','$jenis_dokumen','$status',NOW())");
        // mysqli_query($this->conn, $query);
        // return mysqli_fetch_assoc($query);

    }

    // function insertDok(){
    //     $table = $_POST['table'];
    //     unset($_POST['act']);
    //     unset($_POST['table']);

    //     $column = implode(',',array_keys($_POST));
    //     $values = implode(','.array_values($_POST));
    //     $valuess=[];
    //     foreach($_POST as $key => $value){
    //         $valuee="'".$value."'";
    //         $valuess[]=$valuee;
    //     }
    //     $values = join(',',$valuess);
    //     $result = mysqli_query($this->conn, "INSERT INTO $table ($column) VALUES ($values)");
    //     return $result;

    // }

    // fungsi untuk menampilkan hasil dokumen keluar yang telah di buat setelah mengisi form dokumen
    public function document($id_user){
        // $viewDoc = mysqli_query($this->conn, "SELECT * FROM tb_dokumen");
        $viewDoc = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B, tb_divisi C WHERE A.id_divisi=C.id_divisi AND B.id_user='$id_user' AND B.id_divisi = C.id_divisi");
        // $viewDoc = mysqli_query($this->conn, "SELECT * FROM tb_user A, tb_dokumen B WHERE A.id_user=$id_user AND B.penerima='Amad' OR (B.kepada_div='Akuntansi' AND B.penerima='all')");
        mysqli_fetch_assoc($viewDoc);
        if ($viewDoc->num_rows > 0){
            return $viewDoc;
        } else {
            return false;
        }
    }

    
    // fungsi untuk menampilkan data yang berada di database, dengan ketentuan tertentu.
    // yaitu jika user yang login adalah divisi IT maka data dokumen yang diambil dari database hanya dokumen yang dikirim untuk divisi IT saja.
    public function documentIn($id_user){

        // $queryStatus = mysqli_query($this->conn,"SELECT status FROM tb_dokumen");
        // $hasilQueryStatus = mysqli_fetch_array($queryStatus);
        // $status=$hasilQueryStatus[0];
        // echo $status;

        // $docIn = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE A.penerima=B.$nama_user OR (kepada_div = 'IT' AND penerima = 'all')"); (percobaan 1)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND kepada_div='IT'"); (percobaan 2)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B, tb_divisi C WHERE A.id_divisi=C.id_divisi AND B.id_user='$id_user' AND B.id_divisi = C.id_divisi");
        $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi=B.id_divisi AND status='pendingDari' OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");

        
        mysqli_fetch_assoc($docIn);
        if ($docIn->num_rows > 0){
            return $docIn;
        } else {
            return false;
        }
    }

    public function documentIn2($id_user){

        // $queryStatus = mysqli_query($this->conn,"SELECT status FROM tb_dokumen");
        // $hasilQueryStatus = mysqli_fetch_array($queryStatus);
        // $status=$hasilQueryStatus[0];
        // echo $status;

        // $docIn = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE A.penerima=B.$nama_user OR (kepada_div = 'IT' AND penerima = 'all')"); (percobaan 1)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND kepada_div='IT'"); (percobaan 2)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B, tb_divisi C WHERE A.id_divisi=C.id_divisi AND B.id_user='$id_user' AND B.id_divisi = C.id_divisi");
        $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi AND status='pendingKepada' OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        
        mysqli_fetch_assoc($docIn);
        if ($docIn->num_rows > 0){
            return $docIn;
        } else {
            return false;
        }
    }

    public function documentIn3($id_user){

        // $queryStatus = mysqli_query($this->conn,"SELECT status FROM tb_dokumen");
        // $hasilQueryStatus = mysqli_fetch_array($queryStatus);
        // $status=$hasilQueryStatus[0];
        // echo $status;

        // $docIn = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE A.penerima=B.$nama_user OR (kepada_div = 'IT' AND penerima = 'all')"); (percobaan 1)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND kepada_div='IT'"); (percobaan 2)
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        // $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B, tb_divisi C WHERE A.id_divisi=C.id_divisi AND B.id_user='$id_user' AND B.id_divisi = C.id_divisi");
        $docIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi AND status='Accept' OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        
        mysqli_fetch_assoc($docIn);
        if ($docIn->num_rows > 0){
            return $docIn;
        } else {
            return false;
        }
    }

    public function riwayatMasuk($id_user){
        $hisIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi_kepada=B.id_divisi AND status='Finish' OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");

        mysqli_fetch_assoc($hisIn);
        if ($hisIn->num_rows > 0){
            return $hisIn;
        } else { 
            return false;
        }
    }

    public function riwayatKeluar($id_user){
        $hisIn = mysqli_query($this->conn,"SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=$id_user AND A.id_divisi=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");

        mysqli_fetch_assoc($hisIn);
        if ($hisIn->num_rows > 0){
            return $hisIn;
        } else { 
            return false;
        }
    }


    // fungsi untuk menampilkan nama divisi untuk button select (dari divisi & kepada divisi)
    public function divisi(){
        $queryDiv = mysqli_query($this->conn, "SELECT id_divisi,deskripsi FROM tb_divisi");
        mysqli_fetch_assoc($queryDiv);
        if ($queryDiv->num_rows > 0){
            return $queryDiv;
        } else {
            return false;
        }
    }

    public function lvlPenerima(){
        // $queryLVL = mysqli_query($this->conn,"SELECT * FROM tb_user WHERE lvl='approval'");
        $queryLVL = mysqli_query($this->conn,"SELECT * FROM tb_user");
        mysqli_fetch_assoc($queryLVL);
        if ($queryLVL->num_rows > 0){
            return $queryLVL;
        } else {
            return false;
        }
    }

    // public function approve($id_dokumen,$status){
    //     $approval = mysqli_query($this->conn, "UPDATE tb_dokumen SET status='$status', tgl_diterima=(NOW()) WHERE id_dokumen=$id_dokumen");
    //     return mysqli_fetch_assoc($approval);
    // }

    function updateStatus(){
        $table = $_POST['table'];
        $field = $_POST['field'];
        $id = $_POST['id'];
        // $id_user = $_SESSION["id_user"];
        // $id_dokumen = $_POST['id_dokumen'];
        $status = $_POST['status'];
        // $status = $_POST['status'];
        $result = mysqli_query($this->conn, "UPDATE $table SET status='$status', tgl_diterima=(NOW()) WHERE $field='$id'");
        // $result = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=id_user AND A.id_divisi_kepada=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        // $result = mysqli_query($this->conn,"DELETE FROM $table WHERE $field='$id'");
        
        
        // $result = mysqli_query($this->conn, "SELECT * FROM $table WHERE $field='$id' AND $status='$status'");
        return $result;
    }

    function rejectStatus(){
        $table = $_POST['table'];
        $field = $_POST['field'];
        $id = $_POST['id'];
        $status = $_POST['status'];

        $result = mysqli_query($this->conn, "UPDATE $table SET status='$status' WHERE $field='$id'");
        return $result;


    }

    function finishDoc(){
        $table = $_POST['table'];
        $field = $_POST['field'];
        $id = $_POST['id'];
        // $id_user = $_SESSION["id_user"];
        // $id_dokumen = $_POST['id_dokumen'];
        $status = $_POST['status'];
        // $status = $_POST['status'];
        // $nama_dokumen = $_POST['nama_dokumen'];
        $result = mysqli_query($this->conn, "UPDATE $table SET status='$status',tgl_selesai=(NOW()) WHERE $field='$id'");
        // $result = mysqli_query($this->conn, "INSERT INTO tb_docHist (nama_dokumen) VALUES ($nama_dokumen)");
        // $result = mysqli_query($this->conn, "SELECT * FROM tb_dokumen A, tb_user B WHERE B.id_user=id_user AND A.id_divisi_kepada=B.id_divisi OR A.penerima='all'=B.id_user ORDER BY no_dokumen DESC");
        // $result = mysqli_query($this->conn,"DELETE FROM $table WHERE $field='$id'");
        
        
        // $result = mysqli_query($this->conn, "SELECT * FROM $table WHERE $field='$id' AND $status='$status'");
        return $result;
    }

    // function insertAfterAcc(){
    //     $table=$_POST['tabel'];
    //     unset($_POST['act']);
    //     unset($_POST['tabel']);

    //     $column = implode(',',array_keys($_POST));
    //     $value = implode(',',array_values($_POST));
    //     $valuees = [];
    //     foreach ($_POST as $key => $values){
    //         $valuee = "'".$values."'";
    //         $valuees[] = $valuee;
    //     }
    //     $value = join(',',$valuees);
    //     $result = mysqli_query($this->conn,"INSERT INTO $table($column) VALUES($value)");
    //     return $result;
    // }

}

?>