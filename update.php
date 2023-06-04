<?php

// changing the card title

require_once('./helper/base.php');
session_start();

$old_card_name = $_SESSION['old_card_name'];
$new_card_name = $_SESSION['new_card_name'];
$card_name = str_replace(" ", "_", $new_card_name);

$change_table_sql = "RENAME TABLE $old_card_name TO $card_name";
$change_table_name_query = mysqli_query($connection, $change_table_sql);

if(!$change_table_name_query){
    echo "error " . mysqli_error();
}else{
    header('location:./todolist.php');
}



// end of changing the card title;


?>