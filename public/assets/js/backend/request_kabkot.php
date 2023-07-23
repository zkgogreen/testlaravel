<?php
// include "dbconfig.php";
// $query =  mysqli_query($mysqli, "SELECT DISTINCT r102n FROM podes20_spd_kp_dukcapil WHERE r101n='".$_POST[provinsi]."' ");
$con=mysqli_connect("192.168.100.158","dev_login","kominfo.gis2021","gis_demand");
$sql="SELECT DISTINCT r102n FROM podes20_spd_kp_dukcapil WHERE r101n='".$_POST[r101n]."'";
$query=mysqli_query($con, $sql) or die(mysqli_error());
$jml=mysqli_num_rows($query);
if ($jml >= 1){
	echo"<option value='pilihkabkot' selected>-- Pilih Semua Kab/kota --</option>";
	while($kabkot=mysqli_fetch_assoc($query)){
	echo '<option>'.$kabkot['r102n'].'</option>';
}
}else{
echo "<option value='pilihkabkot' selected>--Data Kab/Kota Tidak Ada, Pilih Yang Lain--</option>";
}
 ?>
