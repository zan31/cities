<?php
include 'config.php';

    $lat = 46.05; // latitude of centre of bounding circle in degrees
    $lon = 14.5167; // longitude of centre of bounding circle in degrees

    $R = 6371;  // earth's mean radius, km
    
    //echo "$maxLat, $minLat, $maxLon, $minLon";

    $stmt1 = "SELECT 
        id_c, city,
        (
            $R *
            acos(cos(radians($lat)) * 
            cos(radians(lat)) * 
            cos(radians(lon) - 
            radians($lon)) + 
            sin(radians($lat)) * 
            sin(radians(lat)))
        ) AS distance 
            FROM cities
            HAVING distance BETWEEN 0.1 AND 10
            ORDER BY distance
            ";
    $points = $pdo->prepare($stmt1);
    $points->execute();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trip it out</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
    .container1{
        width:50%;
        margin:auto;
    }
</style>
</head>
    <body>
        <table>
            <?php
            foreach($points as $row) {
                echo $row['distance'].', '.$row['city'].'</br> ';
            }
            ?>
</table>
    </body>

</html>