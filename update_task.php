<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<style>
    .modal-box{
        width: 100%;
        height: 100vh;
    }

    .b-btn{
        position: absolute;
        top: 1rem;
        right: 1rem;
    }
</style>

<body>
    



<?php

require_once('./helper/base.php');
session_start();

$id = $_GET['id'];
$table_name = $_GET['name'];
$sql = "SELECT * FROM $table_name WHERE Id = $id";
$query = mysqli_query($connection, $sql);
$data = mysqli_fetch_assoc($query);
$error = '';

if(isset($_POST['save_btn'])){
    $_id = $_POST['id'];
    $_name = $_POST['value'];

    if($_name == "" || $_name == null){
        $error = "You need to fill it out first!";
    }else{
        $updated_sql = "UPDATE $table_name SET Task='$_name' WHERE Id=$_id";
        if(mysqli_query($connection, $updated_sql)){
            header("location:./CRUD.php");
        }else{
            echo "Update error".mysqli_error();
        }
    }
}


?>

<div class="modal-box bg-secondary d-flex align-items-center justify-content-center position-relative">

    <a class="b-btn" href='./CRUD.php'>
        <button class='btn btn-danger text-light ' name='back'>Back</button>
    </a>

    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow border border-primary p-4">
                    <form action="" method='POST'>
                        <input type="hidden" class='form-control' value='<?php echo $data['Id'] ?>' name='id'>
                        <span class='text-primary fw-bold mb-3'>Task</span>
                        <div class="mt-3 d-flex align-items-center justify-content-start">
                            <input type="text" class='form-control me-3' value='<?php echo $data['Task'] ?>' name='value'>
                            <button class='btn btn-success text-light' name='save_btn'>Save</button>
                        </div>
                        <small class='text-danger text-sm'><?php echo $error ?></small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>