<?php
$hash = '$2y$10$iDLmCZSeR2H6GPI9GDJVUOPnOl1NPOSo6fqKzPfE9BA/XzKN5F4UK';
if(password_verify('P@$$w0rd', $hash)){
  echo 'match';
}else{
  echo 'mismatch';
}
 ?>
