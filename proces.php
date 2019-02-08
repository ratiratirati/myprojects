<?php

$msg = '';

// რეგისტრაციის ღილაკზე დაჭერისას
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $password_2 = $_POST['password_2'];

//თუ ველები ცარიელია გამოიტანოს შეცდომა
    if(empty($username)){
        array_push($errors,'მომხმარებლის ველი ცარიელია');
    }

    if(empty($email)){
        array_push($errors,'მეილის ველი ცარიელია');
    }

    if(empty($password)){
        array_push($errors,'პაროლის ველი ცარიელია');
    }

    if($password != $password_2){
        array_push($errors,'პაროლები არ ემთვევა');
    }

    if(!empty($password and strlen($password) < 8)){
        array_push($errors,'პაროლი უნდა შედგებოსეს 8 ციფრისგან');
    }

// თუ შეცდომების რაოდენობა 0 ის ტოლია წარმატებით მოხდეს რეგისტრაცია
    if(count($errors) == 0 ){
        //პაროლის დაშიფრვა md5
        $password = md5($password);
        $sql="INSERT INTO users (email,username,password) VALUES ('$email','$username','$password')";
        if(mysqli_query($con,$sql)){
            $msg = "რეგისტრაცია წარმატებულია";
        }
    }
}


// ავტორიზაციის ღილაკზე დაჭერისას
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

//თუ ველები ცარიელია გამოიტანოს შეცდომა
    if(empty($username)){
        array_push($errors,'მომხმარებლის ველი ცარიელია');
    }

    if(empty($password)){
        array_push($errors,'პაროლის ველი ცარიელია');
    }

// თუ შეცდომების რაოდენობა 0 ის ტოლია წარმატებით მოხდეს ავტორიზაცია
    if(count($errors) == 0 ){
        //პაროლის დაშიფრვა md5
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)){
            $_SESSION['username'] = $username;
            if($username == 'admin'){
                header('location:admin.php');
            }else{
                header('location:home.php');
            }
        }else{
            array_push($errors,'მომხმარებლის სახელი ან პაროლი არასწორია');
        }
    }
}

date_default_timezone_set('Asia/tbilisi');
$t=date('h:i:s');
$d=date('Y-m-d');

if(isset($_POST['add'])){
    $siaxle = mysqli_real_escape_string($con,$_POST['siaxle']);

    if(empty($siaxle)){
        array_push($errors,'');
    }

    if(count($errors) == 0 ){
        $sql = "INSERT INTO siaxleebi (siaxle,saati,ricxvi) VALUES ('$siaxle','$t','$d')";
        if(mysqli_query($con,$sql)){
            $msg = "სიახლე წარმატებით დაემატა<br><img src='img/corect.gif' style='width: 70px; margin-top: 10px;'>";
        }
    }
}


if(isset($_POST['delete'])){
    $sql = "DELETE FROM siaxleebi WHERE id='".$_POST['deleteid']."'";
    if(mysqli_query($con,$sql)){
        echo '<div class="alert alert-danger" role="alert">
 წარმატებით წაიშალა !!!
</div>';
    }
}

?>