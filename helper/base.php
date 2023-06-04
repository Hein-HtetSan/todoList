<?php

  $connection = mysqli_connect('localhost', 'root', '', 'ToDo');
  
  if(!$connection){
    echo "Connection Failed! ".mysqli_error();
  }


?>