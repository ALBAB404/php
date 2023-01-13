<?php 

$db = mysqli_connect('localhost','root','','fashiionx');

if ($db) {
    // echo 'datebase is connected';
}else {
    die('datebase is error'.mysqli_error($db));
    
}

?>