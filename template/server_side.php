<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'tb_dokumen';
 
// Table's primary key
$primaryKey = 'id_dokumen';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    // array( 'db' => 'inv_dokumen', 'dt' => 0 ),
    array( 'db' => 'inv_dokumen', 'dt' => 1 ),
    array( 'db' => 'nama_dokumen',  'dt' => 2 ),
    array( 'db' => 'jenis_dokumen',  'dt' => 3 ),
    array( 'db' => 'pengirim',   'dt' => 4 ),
    array( 'db' => 'dari_div',     'dt' => 5 ),
    array( 'db' => 'kepada_div',     'dt' => 6 ),
    array( 'db' => 'penerima',     'dt' => 7 ),
    array( 'db' => 'file_dokumen',     'dt' => 8 ),
    
    array(
        'db'        => 'status',
        'dt'        => 9,
        'formatter' => function( $d) {
            // return ($d == 1)?"Accept":"Reject";
            return $d == "Accept" ? "Accept":"Reject";
        }
    ),

    array(
        'db'        => 'tgl_masuk',
        'dt'        => 10,
        'formatter' => function( $d) {
            return date( 'jS M y', strtotime($d));
        }
    ),

    array(
        'db'        => 'tgl_diterima',
        'dt'        => 11,
        'formatter' => function( $d) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    

);
 
// SQL server connection information
$sql_details = array(
    'user' => 'fajar',
    'pass' => 'P@ssw0rd131',
    'db'   => 'db_dokumentasi',
    'host' => '192.168.2.254'
    // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);