<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

<?php
        
    require_once("./helper/base.php");
    
    if(isset($_POST['create_btn'])){
        header('location:./createCard.php');
    }

?>


<div class="container position-relative ">

    <div class="row py-2 px-3 shadow bg-primary">
        <div class="col-3 d-none d-md-block d-flex align-items-center justify-content-start">
            <div class="user-login mt-1">
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <div class="col-9 col-md-6 fs-2 fw-bold text-start text-md-center text-light">To Do List</div>
        <div class="col-3 col-md-3 d-flex align-items-center justify-content-end">
            <div class="gear-box">
                <i class="fa-sharp fa-solid fa-gear text-light cursor-pointer"></i>
            </div>
        </div>
    </div>

    <div class="row py-2 px-3 overflow-hidden overflow-auto mt-3 w-100 bg-light">

    <!-- php codes  -->

    <?php
    
    $sql = "SHOW TABLES FROM todo";
    $query = mysqli_query($connection, $sql);


    $table_arr = [];
    $second_table_arr = [];
    $i = 0;
    if($query)
    {
        
        while($row = mysqli_fetch_row($query)){
            $table_arr[$i] = $row;
            $table_name_str = implode("<br>", $table_arr[$i]);
            $second_table_arr[$i] = $table_name_str;
            $i++;
        }
    }else{
        echo "error while fetching .." . mysqli_error();
    }


    for($i = 0; $i < count($second_table_arr); $i++){
        $color_sql = "SELECT * FROM $second_table_arr[$i]";
        $color_query = mysqli_query($connection, $color_sql);

        $card_color = mysqli_fetch_assoc($color_query)['Color'];         

        echo "
            <div class='col-6 col-md-4 col-lg-2 mb-3'>
                <div class='card new-card position-relative' style='background-color: {$card_color}; '>
                    <div class='card-header' style='color: #fff'>
                        {$second_table_arr[$i]}
                    </div>
                    <div class='card-body d-flex align-items-center justify-content-center'>
                        <button name='create_btn' class='create-btn' style='background-color:{$card_color} !important;'><i class='fa-regular fa-plus fs-5' style='color: {$card_color}; background-color: {$card_color};'></i></button>
                    </div>
                    <div class='card-footer d-flex align-items-center justify-content-end'>
                        <a href='./CRUD.php?table_name={$second_table_arr[$i]}'>
                            <button class='btn btn-light btn-sm' name='delete_btn'>
                                <i class='fa-solid fa-pen' style='color: {$card_color}'></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        ";
    }

    

    
    
    ?>

        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <form action="" method="POST">
                    <div class="card new-card">
                        <div class="card-header">
                            New Card?
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <button name="create_btn" class="create-btn bg-white"><i class="fa-regular fa-plus fs-1 text-info"></i></button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

</div>


        


</body>
</html>


