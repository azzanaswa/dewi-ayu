<?php 
// Default gender value
$gen = ($_GET['gender'] == "" || empty($_GET['gender'])) ? "m" : $_GET['gender'] ;
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>FORM VALIDASI :: Input</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1 id="title">FORM VALIDASI :: Input</h1>
  <form class="common" action="form_output.php" method="post">
    <?php if ($_GET['error']): ?><strong class="error">DATA ERROR! Form yang anda masukan tidak benar!</strong><?php endif ?>
    <div>
      <label>Nama Lengkap</label>
      <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>">
      <?php if ($_GET['error'] && empty($_GET['nama'])): ?><strong class="error">*) Harus diisi!</strong><?php endif ?>
    </div>
    <div>
      <label>Jenis Kelamin</label>
      <span><input type="radio" name="gender" value="m"<?php echo ($gen == "m") ? " checked" : "" ; ?>>Laki-laki</span>
      <span><input type="radio" name="gender" value="f"<?php echo ($gen == "f") ? " checked" : "" ; ?>>Perempuan</span>
      <span><input type="radio" name="gender" value="o"<?php echo ($gen == "o") ? " checked" : "" ; ?>>Lainnya</span>
    </div>
    <div>
      <label>Umur (Tahun)</label>
       <select name="umur">
       <?php 
       for ($i=10; $i < 60; $i++) { 
         $current = ($_GET['umur'] == $i) ? " selected" : "" ;
         echo "<option value=\"$i\"" . $current . ">". $i ."</option>\n";
       }
        ?>
       </select>
    </div>
    <div>
      <label>Alamat E-mail</label>
      <input type="email" name="email" value="<?php echo $_GET['email'] ?>">
      <?php if ($_GET['error'] && empty($_GET['email'])): ?><strong class="error">*) Harus diisi!</strong><?php endif ?>
    </div>
    <div>
      <label>Masukan masukan (optimal)</label>
      <textarea name="pesan"><?php echo $_GET['pesan'] ?></textarea>
    </div>
    <div>
      <label>Persetujuan</label>
      <span>
        <input type="checkbox" name="setuju" value="checked" <?php echo $_GET['setuju'] ?>>
        Dengan demikian saya pertanggung jawab atas data yang saya input.
      </span>
      <?php if ($_GET['error'] && empty($_GET['setuju'])): ?><strong class="error">*) Harus dicentang!</strong><?php endif ?>
      <div class="btn-row">
        <input type="submit" value="submit">
        <input type="reset">
      </div>
    </div>
  </form>
</body>
</html>