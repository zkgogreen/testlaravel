 <?php
$mysqli = new mysqli("192.168.100.158","dev_login","kominfo.gis2021","gis_demand");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?> 