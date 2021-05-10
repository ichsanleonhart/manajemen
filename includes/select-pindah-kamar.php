<?php

/***
* SIMRS Khanza Lite from version 0.1 Beta
* About : Porting of SIMRS Khanza by Windiarto a.k.a Mas Elkhanza as web and mobile app.
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
* Licence under GPL
***/

ob_start();
session_start();

include ('../config.php');
include ('../init.php');

$q = $_GET['q'];

$sql = query("
SELECT 
	a.kd_kamar AS id,
    b.nm_bangsal AS text,
    a.trf_kamar,
    a.kelas AS text2,
    a.status AS text3
FROM
	kamar as a,
    bangsal as b
WHERE
 	a.kd_bangsal = b.kd_bangsal
    AND
    a.status = 'KOSONG'
    AND
    (nm_bangsal LIKE '%".$q."%')");
	
//SELECT kd_jenis_prw AS id, nm_perawatan AS text, tarif_tindakanpr AS tarif FROM jns_perawatan_inap WHERE status ='1' AND (nm_perawatan LIKE '%".$q."%')");
$num = num_rows($sql);
if($num > 0){
	while($data = fetch_assoc($sql)){
		$tmp[] = $data;
	}
} else $tmp = array();

echo json_encode($tmp);

?>
