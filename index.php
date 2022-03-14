<?php
include 'config.php';
$error="";
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
    <?php
    if (isset($_GET['error'])) {
    ?>
        <div class="alert alert-danger" id="error" role="alert">Nekatero mesto ni dovolj veliko</div>
    <?php
    }
    ?>
    <div class="container1">
        <h1 class="display-3">Trip it out</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="city1" class="form-label">Start</label>
                <input type="text" name="city1" class="form-control" id="city1">
            </div>
            <div class="mb-3">
                <label for="city2" class="form-label">Finish</label>
                <input type="text" name="city2" class="form-control" id="city2">
            </div>
            <button type="submit" name="Submit" class="btn btn-primary">Calculate</button>
        </form>    
    </div>
    
        <script type="text/javascript">
            setTimeout(function () {
                // Closing the alert
                document.querySelector('#error').style.display = "none";
            }, 2500);
    </script>



<?php
$stmt = $pdo->prepare('SELECT * FROM cities WHERE city = ?;');
$stmt1 = $pdo->prepare('SELECT * FROM cities WHERE city = ?;');

if(isset($_POST['Submit'])) {
    $city_name = $_POST['city1'];
    $city_name1 = $_POST['city2'];
    if($stmt->execute([$city_name])){
        if($stmt->rowcount() === 1) {
            if($stmt1->execute([$city_name1])) {
                if($stmt1->rowcount() === 1) {
                    header("Location:index.php?lepo");
                }
                else {
                    header("Location:index.php?error");
                    $error = "Mesto 1";
                }
            }
            else {
                $error = "unknown2";
            }
        }
        else{
            header("Location:index.php?error");
            $error = "Mesto 2";
        }
    }
    else {
        $error = "unknown";
    }
    
}

?>











</body>

</html>