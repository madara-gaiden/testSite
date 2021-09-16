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
  <link rel="stylesheet" href="../css/serie/info-style.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="poster/<?php echo $data['SeriePoster']; ?>" type="image/x-icon">
</head>

<body>



  <div style="background-image: url('poster/<?php echo $data["SerieHeader"]; ?>');" class="titlem"></div>

  <div class="picm">
    <img src="poster/<?php echo $data['SeriePoster']; ?>" alt="">
  </div>

  <?php
  $chapRe = $data['episodeWatch'];
  $chapTo = $data['episodeTotal'];
  $watched = ($chapRe * 100) / $chapTo;


  $fRealease = $data['SerieDate'];
  $oneWeekLater = strtotime('+1 Week');

  $year = date('$fRealease', $oneWeekLater);


  ?>


  <div class="chapm">
    <label for="">I Read <?php echo number_format((float)$watched, 2, '.', '') . "%"; ?></label>
    <input disabled name="chapRead" type="number" value="<?php echo $data['episodeWatch'] ?>">
    <label for="">Total Chapters</label>
    <input disabled name="chap" type="number" value="<?php echo $data['chapTotal'] ?>"><br>
    <a href="./seriech-server.php?id=<?php echo $data['id']; ?>"><button class="btnn btn-submit" type="submit"><i class="fas fa-edit"></i> Edit</button></a>


    <a class="btnn" href="serie-list.php"><button class="show-serie"><i class="fas fa-eye"></i> Show All Serie</button></a>
    <div class="chapters">
      <?php
      for ($i = 1; $i <= $data['episodeTotal']; $i++) {
        for ($j = $fRealease; $j < date('Ymd'); $oneWeekLater) {
      ?>

          <?php
          echo "<h3>Episode " . $i . " " . $j;
          ?>
          <!-- <img class="imgep" src="episode/<?php echo $data["SerieName"] . "/" . $i . ".jpg"; ?>" alt=""> -->
      <?php
          if ($data['episodeWatch'] >= $i) {
            echo "<button class='readit'><i class='fas fa-eye-slash'></i> It has been watch</button>";
          } else {
            echo "<button class='read'><i class='fas fa-eye'></i> You didn't watch it</button>";
          };


          "</h3>";
        }
      }
      ?>

    </div>
  </div>


</body>

</html>