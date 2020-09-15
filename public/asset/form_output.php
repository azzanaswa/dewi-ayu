<?php 
if (!empty($_POST['nama']) && !empty($_POST['email']) && $_POST['setuju'] == "checked") {
  // echo "BERISI";
} else {
  $error = "";
  foreach ($_POST as $key => $value) {
    $error .= "&" . $key . "=" . $value;
  }
  // echo $error;
  header("Location: form_input.php?error=yes" . $error);
  exit();
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>FORM VALIDASI :: Output</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1 id="title">FORM VALIDASI :: Output</h1>
  <ul class="data">
  <?php foreach ($_POST as $key => $value): ?>
    <li><strong><?php echo $key ?></strong> <?php echo $value ?></li>
  <?php endforeach ?>
    <li><a href="form_input.php"><--- Kembali</a></li>
  </ul>
</body>
</html>