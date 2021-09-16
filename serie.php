<?php
$id = $_GET['id']
?>

<?php

$db = mysqli_connect("localhost", "root", "", "mySite");

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$records = mysqli_query($db, "select * from serie where id='$id'"); // fetch data from database

$data = mysqli_fetch_array($records)
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $data['SerieName']; ?></title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="poster/<?php echo $data['SeriePoster']; ?>" type="image/x-icon">
  <link rel="stylesheet" href="../css/serie/info-style.css">
</head>

<body>



  <div style="background-image: url('poster/<?php echo $data["SerieHeader"]; ?>');" class="titlem"></div>

  <div class="picm">
    <img src="poster/<?php echo $data['SeriePoster']; ?>" alt="">
  </div>



  <div class="chapm">
    <label for="">I Watch </label>
    <input disabled name="chapRead" type="number" value="<?php echo $data['episodeWatch'] ?>">
    <label for="">Total Episodes</label>
    <input disabled name="chap" type="number" value="<?php echo $data['episodeTotal'] ?>"><br>
    <a href="./seriech-server.php?id=<?php echo $data['id']; ?>"><button class="btnn btn-submit" type="submit"><i class="fas fa-edit"></i> Edit</button></a>

    </form>
    <a class="btnn" href="serie-list.php"><button class="show-serie"><i class="fas fa-eye"></i> Show All serie</button></a>
    <div class="chapters">
      <?php
      for ($i = 1; $i <= $data['episodeTotal']; $i++) { ?>

        <?php
        echo "<h3>Episode " . $i . " ";
        ?>
        <!-- <img class="imgep" src="episode/<?php echo $data["SerieName"] . "/" . $i . ".jpg"; ?>" alt=""> -->
      <?php
        if ($data['episodeWatch'] >= $i) {
          echo "<button class='readit'><i class='fas fa-eye-slash'></i> It has been watch</button>";
        } else {
          echo "<button class='read'><i class='fas fa-eye'></i> I didn't watch it</button>";
        };
        "</h3>";
      }


      ?>

    </div>
  </div>


</body>

</html>