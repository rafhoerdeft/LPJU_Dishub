<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
  <title>LPJU Image Upload</title>
</head>
<body>
<h1>Ionic Image Upload</h1>
  <?php
  $scan = scandir('assets/path_foto');
  foreach($scan as $file)
  {
    if (!is_dir($file))
    {
        echo '<h3>'.$file.'</h3>';
      echo "<img src='".base_url().'assets/path_foto/'.$file."' style='width: 400px;'/><br />";
    }
  }
  ?>
</body>
</html>