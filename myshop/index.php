<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>MyShop</title>
</head>
<body>
    <div class="continer my-5">
        <h2>List of Client</h2>
        <a href="/myshop/create.php" class="btn btn-primary "  role="button" >Create New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
                $serverName = "localhost";
                $userName = "root";
                $password = "";
                $dataBase = "myshop";

                //create connection
                $connection=new mysqli($serverName,$userName,$password,$dataBase);

                //check connection
                if($connection->connect_error){
                    die("connection failed " . $connection->connect_error);

                }
                //read all rows from database table
                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);
                 
                //check if not query is error
                if( !$result ){
                    die("Invalid Query" . $connection->error);
                }

                //read data of each row
                while( $row = $result->fetch_assoc() ){
                    echo"
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a href='/myshop/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='/myshop/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>
                    ";
                }
        
        
            ?>
            <tbody>
            
                <tr>
                    <td>10</td>
                    <td>Omar Almasri</td>
                    <td>almasrio375@gmail.com</td>
                    <td>0788799439</td>
                    <td>Zarqa, jordan</td>
                    <td>12-8-2024 08:15:44</td>
                    <td>
                        <a href="/myshop/edit.php" class="btn btn-primary btn-sm">Edit</a>
                        <a href="/myshop/delete.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>