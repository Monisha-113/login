<?php
require "connection.php";
require "header.php";
if(isset($_POST['f_name'])&&isset($_POST['l_name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['con_password'])&&isset($_POST['sec_qsn'])){ //check values

    $f_name=$_POST['f_name'];
    $l_name=$_POST['l_name'];
    $email=$_POST['email'];
    $password1=$_POST['password'];
    $password2=$_POST['con_password'];
    $sec_qsn=$_POST['sec_qsn'];
    $sec_ans=$_POST['sec_ans'];
    $image= $_FILES['image']['name'];
    $temp=$_FILES['image']['tmp_name'];
    $target="uploads/".basename($image);

    // echo $f_name,$l_name,$email,$password1,$password2,$sec_qsn,$sec_ans,$image;

    $sql= 'SELECT * FROM  reg_details WHERE email=:email LIMIT 1';
    $stmt = $connection->prepare($sql);
    $stmt -> execute(['email' => $email]);
    $exists = $stmt->fetch(PDO :: FETCH_ASSOC);
    if($exists){
        echo  "<script> Swal.fire('Mail id already exist') </script>";
    }
    else{
        if($password1!=$password2){
            echo  "<script> Swal.fire('password mismatch') </script>";
        }
        else{
            $password1=md5($password2);
            $sql='INSERT INTO reg_details(f_name, l_name, email, password, sec_qsn, sec_ans, image) VALUES (:f_name,:l_name,:email,:password,:sec_qsn,:sec_ans,:image)';
            $statement=$connection->prepare($sql);
            if($statement->execute(['f_name'=>$f_name,'l_name'=>$l_name,'email'=>$email,'password'=>$password1,'sec_qsn'=>$sec_qsn,'sec_ans'=>$sec_ans,'image'=>$image])){
                $move_pic=move_uploaded_file($temp,$target);
                echo "<script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Registration successful',
                    showConfirmButton: false,
                    timer: 1500
                  })
                </script>";
            }
            else{
                echo "<script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Registration successful',
                    showConfirmButton: false,
                    timer: 1500
                  })
                </script>";
            }
        }
    }



}

?>
<div class="container-fluid">
            <div class="row">
                <div class="col-sm my-auto text-center">
                    <img src="images/register.png" alt="" />
                </div>
                <div class="col-sm">
                    <form action="" method="POST" enctype="multipart/form-data" class="form-control mt-3">
                        <div class="text-center">
                            <h1>New Registration</h1>
                            
                        </div>
                       
                            <input
                                type="text"
                                class="form-control mt-3"
                                name="f_name"
                                placeholder="First Name"
                                required
                            />
                       
                        
                            <input
                                type="text"
                                class="form-control mt-3"
                                name="l_name"
                                placeholder="Last Name"
                                required
                            />
                       
                            <input
                                type="email"
                                class="form-control mt-3"
                                name="email"
                                placeholder="email"
                                required
                            />
                       
                            <input
                                type="file"
                                class="form-control mt-3"
                                name="image"
                            />
                       
                            <input
                                type="text"
                                class="form-control mt-3"
                                name="password"
                                placeholder="Password"
                                required
                            />
                       
                            <input
                                type="password"
                                class="form-control mt-3"
                                name="con_password"
                                placeholder="Conform Password"
                                required
                            />
                       
                            <select
                                class="form-select mt-3"
                                aria-label="Default select example"
                                name="sec_qsn"
                            >
                                <option selected >
                                    Choose one security question
                                </option>
                                <option value="What is your favorite book?">What is your favorite book?</option>
                                <option value="Which food you didn't like?">Which food you didn't like?</option>
                                <option value="what is your favorite 5 digit pin number?">what is your favorite 5 digit pin number?</option>
                                <option value="what is your friend's name who you doesn't like?">what is your friend's name who you doesn't like?</option>
                            </select>
                        
                                <input
                                    type="text"
                                    class="form-control mt-3"
                                    name="sec_ans"
                                    placeholder="Enter your answer"
                                    required
                                />
                           
                            <input type="submit" value="submit" class="btn btn-secondary w-100 mt-3">
                       
                            <a href="index.php" class="btn btn-primary w-100 p-2 mt-3"
                                >Already have an account?</a
                            >
                       
                    </form>
                </div>
            </div>
        </div>


<?php
    require "footer.php"
?>