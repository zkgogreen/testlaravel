<?php
include "assets/inc/config.php";
$query =  pg_query("SELECT DISTINCT provinsi FROM peserta WHERE kategori='".$_POST[kategori]."' ");
$jml=pg_num_rows($query);
if ($jml >= 1){
	echo"<option value='pilihprovinsi' selected>-- Pilih Semua Provinsi --</option>";
	while($provinsi=pg_fetch_assoc($query)){
	echo '<option>'.$provinsi[provinsi].'</option>';
}
}else{
echo "<option value='pilihprovinsi' selected>--Data Provinsi Tidak Ada, Pilih Yang Lain--</option>";
}
 ?>
