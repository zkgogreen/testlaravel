<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// require_once dirname(__FILE__) . '/./dbconfig.php';
$dbHost = 'localhost';
$dbName = 'gis_demand';
$dbUser = 'root';
$dbPass = '';
$dbcon = new PDO("mysql:host=$dbHost;port=3306;dbname=$dbName", $dbUser, $dbPass);

header("Access-Control-Allow-Origin: *");
if (isset($_GET['command'])) {
	if ($_GET['command']=="POINT") {
		$id_desa = $_GET['id_desa']; 
		$desa = $_GET['desa']; 
		$kecamatan = $_GET['kecamatan']; 
		$kab_kota = $_GET['kab_kota']; 
		$provinsi = $_GET['provinsi']; 
		$nama = $_GET['nama']; 
		$telepon = $_GET['telepon']; 
		$email = $_GET['email']; 
		$jenis_usaha = $_GET['jenis_usaha']; 
		$produk = $_GET['produk']; 
		$nama_pic = $_GET['nama_pic']; 
		$kontak_pic = $_GET['kontak_pic']; 
		$pengusul = $_GET['pengusul']; 
		$keterangan = $_GET['keterangan']; 
		$thn_bantuan = $_GET['thn_bantuan'];
		$geometry = $_GET['geometry'];
		try {
			$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbcon->prepare("INSERT INTO pb_maps(id_desa, desa, kecamatan, kab_kota, provinsi, nama, 
			telepon, email, jenis_usaha, produk, nama_pic, kontak_pic, pengusul, keterangan, thn_bantuan, geom) VALUES(UPPER(:id_desa), UPPER(:desa), 
			UPPER(:kecamatan), UPPER(:kab_kota), UPPER(:provinsi), UPPER(:nama), UPPER(:telepon), 
			UPPER(:email), UPPER(:jenis_usaha), UPPER(:produk), UPPER(:nama_pic), UPPER(:kontak_pic), 
			UPPER(:pengusul), UPPER(:keterangan), UPPER(:thn_bantuan), ST_GeomFromText(:geometry, 4326))");
			
			$stmt->bindValue(":id_desa", $id_desa, PDO::PARAM_STR); 
			$stmt->bindValue(":desa", $desa, PDO::PARAM_STR); 
			$stmt->bindValue(":kecamatan", $kecamatan, PDO::PARAM_STR); 
			$stmt->bindValue(":kab_kota", $kab_kota, PDO::PARAM_STR); 
			$stmt->bindValue(":provinsi", $provinsi, PDO::PARAM_STR); 
			$stmt->bindValue(":nama", $nama, PDO::PARAM_STR); 
			$stmt->bindValue(":telepon", $telepon, PDO::PARAM_STR); 
			$stmt->bindValue(":email", $email, PDO::PARAM_STR); 
			$stmt->bindValue(":jenis_usaha", $jenis_usaha, PDO::PARAM_STR); 
			$stmt->bindValue(":produk", $produk, PDO::PARAM_STR); 
			$stmt->bindValue(":nama_pic", $nama_pic, PDO::PARAM_STR); 
			$stmt->bindValue(":kontak_pic", $kontak_pic, PDO::PARAM_STR); 
			$stmt->bindValue(":pengusul", $pengusul, PDO::PARAM_STR); 
			$stmt->bindValue(":keterangan", $keterangan, PDO::PARAM_STR); 
			$stmt->bindValue(":thn_bantuan", $thn_bantuan, PDO::PARAM_STR);
			$stmt->bindValue(":geometry", $geometry, PDO::PARAM_STR);
			if($stmt->execute()){
				$response = array("response"=>"200","message"=>"created");
				header('Content-Type: application/json');
				echo json_encode($response);
				$dbcon = null;
				exit;
			} else {
				$response = array("response"=>"500","message"=>$e->getMessage());
				header('Content-Type: application/json');
				echo json_encode($response);
				$dbcon = null;
				exit;
			}
		} catch (PDOException $e) {
			$response = array("response"=>"500","message"=>$e->getMessage());
			header('Content-Type: application/json');
			echo json_encode($response);
			$dbcon = null;
			exit;
		}
	} else {
		$response = array("response"=>"404","message"=>"Command is not properly set.");
		header('Content-Type: application/json');
		echo json_encode($response);
		$dbcon = null;
		exit;
	}
} else {
	$response = array("response"=>"404","message"=>"Command is not properly set.");
	header('Content-Type: application/json');
	echo json_encode($response);
	$dbcon = null;
	exit;
}
?>