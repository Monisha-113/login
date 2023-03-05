<?php
    session_start();
    require "connection.php";
    require "header.php";

    $id=$_SESSION['email'];
    $sql='select * from reg_details where email=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $user=$statement->fetch(PDO::FETCH_OBJ);
    
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:index.php");
    }
    
    //     echo"<p class='alert alert-danger'>Enter all details</p>";
    // }


?>
<div class="container">
    <form action="" method="POST">
    <div class="text-end mt-4"><input type="submit" value="Logout" name="logout" class="btn btn-secondary btn-sm p-2" ></div>

    </form>
        <div class="row ">
            <div class="col-sm-4 row justify-content-center align-items-center text-end">
                <h1>HELLO <?=$user->f_name?></h1>
            </div>
            <div class="col-sm-8 text-center row justify-content-center align-items-center">
            <img src="uploads/<?= $user->image ?>" alt="" class="w-50 h-75">
            </div>

        </div>

</div>
     
</div>
<?php
    // session_destroy();
    require "footer.php";
?>
