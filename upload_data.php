<?php
$op=$_POST['op'];
mkdir("barcodes/".$op."",0700);
$upload_dir = "barcodes/".$_POST['op']."/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir .$_POST['op'] ."LT".$_POST['name'] . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>