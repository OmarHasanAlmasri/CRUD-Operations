<?php
$serverName="localhost";
$userName="root";
$password="";
$dataBase="myshop";
$connection=new mysqli($serverName,$userName,$password,$dataBase);

$id="";
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successMessage="";

if( $_SERVER['REQUEST_METHOD']=='GET' ){
    //GET METHOD: Show The Data of The client
    if( !isset($_GET["id"]) ){
        header("location:/myshop/index.php");
        exit;
    }
    $id=$_GET["id"];

    //read the row of the  selected  client form database table

    $sql="SELECT * FROM clients WHERE id=$id";
    $result=$connection->query($sql);
    $row = $result->fetch_assoc();
   if( !$row ){
    header("location:/myshop/index.php");
    exit;
   }

    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $address=$row["address"];

}
else{
       //POST METHOD: Udate Data of The Client
    $id=$_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    do{
        if( empty($name)||empty($email)||empty($phone)||empty($address) ){
            $errorMessage="All fields are requierd";
            break;
        }

        $sql="UPDATE clients " .
        "SET name = '$name', email = '$email',phone ='$phone',address ='$address' " .
        "WHERE id=$id";

        $result=$connection->query($sql);
        
        if( !$result ){
            $errorMessage="Invalid query ". $connection->error;
            break;
        }

        $successMessage=" Client update correctly ";
        header("location: /myshop/index.php");
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
        if( !empty($errorMessage )){
            echo"
            <div class='alert alert-warning alert-dismissable fade show ' role='alert'>
                           <strong>$errorMessage</strong>
                           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                   </div>
                   ";
        }
        ?>
        <form  method="post">
            <input type="hidden" name="id" value="<?php echo $id ;?>">
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
                if( !empty($successMessage) ){
                    echo"
                    <div class='row-mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissable fade show ' role='alert'>
                           <strong>$successMessage</strong>
                           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                   </div>
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