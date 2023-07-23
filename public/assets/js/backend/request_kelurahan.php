<?php
include "assets/inc/config.php";
$query =  pg_query("SELECT DISTINCT kelurahan FROM peserta WHERE kecamatan='".$_POST[kecamatan]."' ");
$jml=pg_num_rows($query);
if ($jml >= 1){
	echo"<option value='pilihkelurahan' selected>-- Pilih Semua kelurahan --</option>";
	while($kelurahan=pg_fetch_assoc($query)){
	echo '<option>'.$kelurahan[kelurahan].'</option>';
}
}else{
echo "<option value='pilihkelurahan' selected>--Data kelurahan Tidak Ada, Pilih Yang Lain--</option>";
}
 ?>
