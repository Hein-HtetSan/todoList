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

    $name = $_GET['table_name'];

    if(isset($_POST['delete'])){
        $del_sql = "DROP TABLE $name";
        $del_query = mysqli_query($connection, $del_sql);

        if(!$del_query){
            echo "error at deleting!" . mysqli_error();
        }else{
            header('location:./todolist.php');
        }
    }

?>


    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center p-2 shadow">
            <div class="col-4 col-md-4 d-flex align-items-center justify-content-start">
                <button class='btn btn-sm btn-secondary text-light back-btn'>Back</button>
            </div>
            <div class="col-8 col-md-8 d-flex align-items-center justify-content-md-end justify-content-end mb-1">
                <form action="" method="POST">
                    <button name='delete' class='text-light btn btn-danger me-3'>Delete</button>
                </form>
                <button name='edit' class='text-light btn btn-primary edit-btn'>Edit</button>
            </div>
        </div>
    </div>

    <div class="edit-box container-fluid mt-5 d-none">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6 bg-light ">
                <!-- in the form  -->
                <form action="" method="POST" class='shadow px-3 py-4 border-rounded'>
                    <div class="title">
                        <label for="">Card Title</label>
                        <div class=""></div>
                        <div class="d-flex align-items-center justify-content-start">
                            <p class="text-muted my-3 me-3"><?php echo $name ?></p> 
                            <button class='btn btn-info text-light btn-sm btn-md-lg '>Edit Title</button>
                            <input class='form-control text-muted d-none'  type="text" value='<?php echo $name ?>' >
                        </div>
                    </div>
                </form>
                <!-- end of form  -->
            </div>
        </div>
    </div>

<script>
    let editBtn = document.querySelector('.edit-btn');
    let editBox = document.querySelector('.edit-box');
    let backBtn = document.querySelector('.back-btn');
    // let editTitleName = document.querySelector('#edit-title-name');
    // let TitleNameInputBox = docuemnt.getElementById('edit-title-input');


    // editTitleName.addEventListener('click', () => {
    //     TitleNameInputBox.classList.remove('d-none');
    // })



    backBtn.addEventListener('click', () => {
        window.location = './todolist.php';
    })

    editBtn.addEventListener('click', () => {
        editBox.classList.toggle('d-none');
    })
</script>



</body>
</html>