<?php

require_once('./helper/base.php');

$_id = $_GET['id'];
$_name = $_GET['name'];

$del_sql = "DELETE FROM $_name WHERE Id = $_id && Id > 1";
$del_query = mysqli_query($connection, $del_sql);

if(!$del_query){
    echo "error " . mysqli_error();
}else{
    header('location:./CRUD.php');
}

?>