<?php
include "assets/inc/config.php";
$query =  pg_query("SELECT DISTINCT kecamatan FROM peserta WHERE kategori='".$_POST[kategori]."' ");
$jml=pg_num_rows($query);
if ($jml >= 1){
	echo"<option value='pilihkecamatan' selected>-- Pilih Semua Kecamatan --</option>";
	while($kecamatan=pg_fetch_assoc($query)){
	echo '<option>'.$kecamatan[kecamatan].'</option>';
}
}else{
echo "<option value='pilihkecamatan' selected>--Data Kecamatan Tidak Ada, Pilih Yang Lain--</option>";
}
 ?>
