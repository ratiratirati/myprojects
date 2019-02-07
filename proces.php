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


?>