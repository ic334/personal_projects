<?php
include('includes/init.php');
$title = 'Uh oh! This page does not exist.';
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include('includes/header.php'); ?>

  <main>
    <p>The page <strong><?php echo htmlspecialchars($request_uri) ?></strong> does not exist. Please navigate back to the home page by clicking on "Avant Garde Reptile Collection" above.</p>
  </main>

  <?php include('includes/footer.php'); ?>

</body>



</html>
