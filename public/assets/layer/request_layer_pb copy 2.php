<?php
/**
 * PHP GeoJSON Constructor, adpated from https://github.com/bmcbride/PHP-Database-GeoJSON
 */

# Connect to MySQL database
include "config.php";

# However the User's Query will be passed to the DB:
$sql = 'SELECT * from pb_maps';

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

# Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

# Loop through rows to build feature arrays
while($row = mysqli_fetch_assoc($rs)) {
    $feature = array(
        'id' => $row['id'],
        'type' => 'Feature', 
        'geometry' => array(
            'type' => 'Point',
            # Pass Longitude and Latitude Columns here
            'coordinates' => array($row['longitude'], $row['latitude'])
        ),
        # Pass other attribute columns here
        'properties' => array(
            'nama' => $row['Nama'],
            'telepon' => $row['telepon'],
            'email' => $row['email'],
            'jenis_usaha' => $row['jenis_usaha'],
            'produk' => $row['produk'],
            'desa' => $row['desa'],
            'kecamatan' => $row['kecamatan'],
            'kab_kota' => $row['kab_kota'],
            'provinsi' => $row['provinsi']
            )
        );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;
?>