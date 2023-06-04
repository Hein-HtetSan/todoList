<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE | READ | UPDATE | DELETE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    
<?php

    require_once('./helper/base.php');

    session_start();

    $isChanged = false;


    $card_muted = ' ';
    $card_title_input = 'd-none';
    $edit_card_title = 'd-inline';
    $save_card_title = 'd-none';
    $error = 'd-none';
    $task_name_d = 'd-inline';

    if(isset($_POST['save_card_name'])){
        $isChanged = true;
        $_SESSION['new_card_name'] = $_POST['new_card_title'];
        $_SESSION['old_card_name'] = $_POST['old_name'];
        header('location:./update.php');
    }

    if($isChanged){
        $card_name = $_POST['new_card_title_name'];
    }else{
        $card_name = $_SESSION['card_title'];
    }

    if(isset($_POST['delete'])){
        $del_sql = "DROP TABLE $card_name";
        $del_query = mysqli_query($connection, $del_sql);

        if(!$del_query){
            echo "error at deleting!" . mysqli_error();
        }else{
            header('location:./todolist.php');
        }
    }
    
    if(isset($_POST['edit_card_name'])){
        $card_muted = 'd-none';
        $card_title_input = 'd-inline';
        $edit_card_title = 'd-none';
        $save_card_title = 'd-inline';
        $error = 'd-block';
    }

    if(isset($_POST['cancel_card_name'])){
        $card_muted = 'd-inline';
        $card_title_input = 'd-none';
        $edit_card_title = 'd-inline';
        $save_card_title = 'd-none';
        $error = 'd-none';
    }

    if(isset($_POST['put_task_name'])){
        $task = $_POST['update_task'];
        $put_sql = "INSERT INTO $card_name (Task) VALUES('$task')";
        $put_query = mysqli_query($connection, $put_sql);
        if(!$put_query){
            echo "Error on putting data ".mysqli_error();
        }
    }

    if(isset($_POST['go_back'])){
        header('location:./todolist.php');
    }

    if(isset($_POST['edit_task_name'])){
        $task_name_d = 'd-none';
    }

    

?>


    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center p-2 shadow">
            <div class="col-4 col-md-4 d-flex align-items-center justify-content-start">
                <button class='btn btn-sm btn-secondary text-light' onclick='goBack()' >Back</button>
            </div>
            <div class="col-8 col-md-8 d-flex align-items-center justify-content-md-end justify-content-end mb-1">
                <form action="" method="POST">
                    <button name='delete' class='text-light btn btn-danger me-3'>Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="edit-box container-fluid mt-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-4 bg-light ">
                <!-- in the form  -->
                <form action="" method="POST" class='shadow px-3 py-4'>
                    <div class="title mb-3">
                        <label for="" class='text-primary fw-bold mb-1'>Card Title</label>
                        <div class="d-flex align-items-center justify-content-start">
                            <p class="text-muted my-2 me-3 <?php echo $card_muted ?>" id='card-title-name'><?php echo $card_name ?> </p> 
                            <input type="hidden" name='old_name' class='form-control' value='<?php echo $card_name ?>'>
                            <input class='form-control <?php echo $card_title_input ?> me-3'  type="text" value='<?php echo $card_name ?>' name='new_card_title' >
                            <button class='btn btn-info text-light btn-sm btn-md-lg <?php echo $edit_card_title?>' name='edit_card_name'>Edit Title</button>
                            <button class='btn btn-info text-light btn-sm btn-md-lg me-2 <?php echo $save_card_title?>' name='save_card_name'>Save</button>
                            <button class='btn btn-secondary text-light btn-sm btn-md-lg <?php echo $save_card_title?>' name='cancel_card_name'>Cancel</button>
                        </div>
                        <small class='<?php echo $error ?> text-danger text-sm px-2'>Note: changes will make you go to home page!</small>
                    </div>

                    <div class="tasks mb-3">
                        <label for="" class='text-primary fw-bold mb-1'>Tasks</label>


                        <?php

                        $start = 1;
                        $task_sql = "SELECT * FROM $card_name WHERE Task != ' ' ";
                        $task_query = mysqli_query($connection, $task_sql);

                        if($task_query){
                            while($row = mysqli_fetch_assoc($task_query)){
                                echo"
                                    <div class='d-flex align-items-center justify-content-between bg-white px-2 mb-1'>
                                        <div class='d-flex align-items-center justify-content-start'>
                                            <span class='text-muted me-2'>{$start}.</span>
                                            <p class='text-muted me-3 pt-3'>{$row['Task']}</p>
                                        </div>
                                        <div class='d-flex align-items-center justify-content-end'>
                                            <input type='hidden' name='get_task_name' value='{$row['Id']}'>
                                            <button class='btn btn-sm btn-info me-2 text-light' name='edit_task_name'>Edit</button>
                                            <a href='./delete.php?id={$row['Id']}&name={$card_name}' class='btn btn-sm btn-danger text-light'>Remove</a>
                                        </div>
                                    </div>
                                ";
                                $start++;
                            }
                        }else{
                            echo "task displaying Error ". mysqli_error();
                        }
                        ?>


                        <div class="d-flex align-items-center justify-content-start">
                            <input type="text" class="form-control me-3 " name='update_task'>
                            <button class='btn btn-sm btn-info text-light' name='put_task_name'>Add</button>
                        </div>
                    </div>

                        <hr class='bg-primary'>
                    <div class="save-button d-flex align-items-center justify-content-end">
                        <button name='go_back' class='btn btn-primary text-light'>Save</button>
                    </div>

                </form>
                <!-- end of form  -->
            </div>
        </div>
    </div>

<script>
    let backBtn = document.querySelector('.back-btn');
    let cardTitleName = document.getElementById('card-title-name');
    let TitleNameInputBox = docuemnt.getElementById('edit-title-input');


    editTitleName.addEventListener('click', function() {
        TitleNameInputBox.classList.remove('d-none');
    })


    function  goBack() {
        window.location = './todolist.php';
    }

    // editBtn.addEventListener('click', () => {
    //     editBox.classList.toggle('d-none');
    // })
</script>



</body>
</html>