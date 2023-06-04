<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>


<?php

    require_once('./helper/base.php');
    $error = " ";

    if(isset($_POST['saveCard'])){
        $card_name = $_POST['card-title'];
        $card_color = $_POST['card-color'];
        $card_name = str_replace(" ", "_", $card_name);
        if($card_name == "" || $card_name == null || empty($card_name)){
            $error = "<small style='color: red;'>*Please fill this out first!</small>";
        }else{
            $sql = "CREATE TABLE $card_name (Id INT NOT NULL AUTO_INCREMENT, Task VARCHAR(50) NOT NULL, created_at TIMESTAMP NOT NULL, date_time VARCHAR(50) NOT NULL, Color VARCHAR(50) NOT NULL, PRIMARY KEY(Id))";
            $query = mysqli_query($connection, $sql);
            if(!$query){
                echo "created database error ". mysqli_error();
            }else{
                $put_color_sql = "INSERT INTO $card_name (Color) VALUES ('$card_color')";
                $update_card_query = mysqli_query($connection, $put_color_sql);
                if(!$update_card_query){
                    echo "updating color error " . mysqli_error();
                }else{
                    header('location:./todolist.php');
                }
            }
            
        }
    }

?>



        <div class="modal bg-primary shadow">
            <div class="card p-3">
                <form action="" method="POST" class="position-relative">
                    <div class="mb-3">
                        <label for="" class="mb-2">Card Title</label><br>
                        <input type="text" name="card-title" class="form-control" id="card-title-getch" >
                        <?php echo $error; ?>
                    </div>
                    <div class="mb-3 d-flex align-items-center justify-content-start color-box">
                        <label for="" class="mb-2 me-3">Color</label><br><input type="color"  name="card-color" id="aa" class="form-control w-25">
                    </div>
                    <div class="">
                        <button name="saveCard" class="saveCardbtn btn w-100 btn-primary">Save</button>
                    </div>
                    
                </form>
            </div>
        </div>
</body>
</html>