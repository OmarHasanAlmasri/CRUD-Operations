<?php

//create connection
$serverName="localhost";
$userName="root";
$password="";
$dataBase="myshop";
$connection=new mysqli($serverName,$userName,$password,$dataBase);

$name="";
$email="";
$phone="";
$address="";

$errorMassege="";
$successMassege="";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];

    do{
        if(empty($name)||empty($email)||empty($phone)||empty($address)){
            $errorMassege="all the fields are required";
            break; }

            //add new client to database

            $sql="INSERT INTO clients (name,email,phone,address) VALUES ('$name','$email','$phone','$address')";
            $result=$connection->query($sql);
            if( !$result ){
                $errorMassege="Invalied Query ". $connection->error ;
                break;
            }

             $successMassege="client added correctly";

             header("location:/myshop/index.php");
             exit;


    }while(false);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>MyShop</title>
</head>
<body>
    <div class="container">
        <h2>New Client</h2>
        <?php
        if(!empty($errorMassege)){
            echo"
            <div class='alert alert-warning alert-dismissable fade show ' role='alert'>
                           <strong>$errorMassege</strong>
                           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                   </div>
                   </div>";
        }
        ?>
        <form  method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ;?>">
                </div>
                
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ;?>">
                </div>
                
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone ;?>">
                </div>
                
            </div>
            <div class="row mb-3">
                <label for="address" class="col-sm-3 col-form-label">address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ;?>">
                </div>
            </div>

                <?php
                if(!empty($successMassege)){
                    echo"
                    <div class='row-mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissable fade show ' role='alert'>
                           <strong>$successMassege</strong>
                           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                   </div></div>
                    ";
                }
                ?>
    
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                          <button type="submit" class="btn btn-primary">Submit</button>      
                </div>
                <div class="col-sm-3 d-grid">
                         <a href="/myshop/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>

                </div>
                
            </div>
        </form>
    </div>
    
</body>
</html>