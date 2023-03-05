<?php
session_start();
require "connection.php";
require "header.php";

if(isset($_POST['mail_id'])&&isset($_POST['password'])){
    $email=$_POST['mail_id'];
    $password=$_POST['password'];

        $sql= 'SELECT * FROM reg_details WHERE email=:email LIMIT 1';
        $stmt = $connection->prepare($sql);
        $stmt -> execute(['email' => $email]);
        $exists = $stmt->fetch(PDO :: FETCH_OBJ);
        if(!$exists){
            echo  "<script> Swal.fire('Invalid Email Id') </script>";
        }
        else{
            $check_pass=$exists->password;
            $password=md5($password);
            if($check_pass!=$password){
                echo  "<script> Swal.fire('Invalid Password') </script>";
            }
            else{
                $_SESSION['email']=$email;
                header("Location:dashboard.php?id=$exists->email");
            }
        }

}

        $mail=$_POST['email'];
        $sql='select email from reg_details where email=:mail';
        $statement=$connection->prepare($sql);
        $statement->execute([':mail'=>$mail]);
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        if($statement->rowCount()>0){
            echo json_encode($result);
        }
        else{
            echo 0;
        }

?>


<div class="container-fluid  h-100">
            <div class="row m-0 justify-content-center align-items-center hgt ">
                <div class="col-sm-10 mt-5  row m-0 my-auto ">
                <div class="col-sm-6 ">
                    <div class=" text-center mt-4">
                <img src="log.jpg" alt=""  />
                </div></div>
                <div
                    class="col-sm-6 row m-0  justify-content-center align-items-center"
                >
                    <div class="col-sm-10 col-12 text-center">
                    <div class="text-center">
                            <img src="images/log.png" alt="" class="w-25" />
                        </div>
                        <form action="" method="POST" class="form-control mt-5">
                            <div>
                                <input
                                    type="text"
                                    class="form-control mt-4"
                                    placeholder="email id"
                                    name="mail_id"
                                />
                            </div>
                            <div>
                                <input
                                    type="password"
                                    class="form-control mt-4"
                                    placeholder="password"
                                    name="password"
                                />
                            </div>
                        <div>
                        <input
                                type="submit"
                                value="login"
                                class="btn btn-secondary d-block mt-3 w-100"
                            />
                        </div>
                        <div class="text-start">
                            <a href="register.php" class="btn btn-primary d-block mt-3 w-100">New Registration</a>
                        
                        </div>
                        <a href="#f_pass"  data-bs-toggle="modal" data-bs-target="#exampleModal">forget password</a>
                        </form>
                        
                    </div>

                </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <form action="" method="POST">
                               <div class="d-flex">
                                    <div class="w-75"><input type="text" placeholder="email" id="check_mail" class="form-control  p-2"></div>
                                    <p id="status" class="ms-2">s</p>
                               </div> 
                               <div>
                                <h6 class="text-secondary mt-3">Your Security question</h6><p></p>
                               </div>
                               <div >
                                    <input type="text" placeholder="Enter your Answer" id="mail" class="form-control p-2">
                               </div> 
                               </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>












<?php
require "footer.php";
?>
<script>
    $(document).ready(() => {
    $("#check_mail").keyup(()=>{
        let email=$("#check_email").val();
        // console.log(email);
        $.ajax({
            url:'index.php',
            method:'POST',
            data:{email:email},
          
            success:function (data){
                console.log(data);
                if(data!=0){
                    $('#status').html("success");
                }  
                else{
                    $('#status').html("failed");
                }
            }
        })
    })

})
</script>