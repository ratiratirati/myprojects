<?php

// სესიის ჩართვა
session_start();

// მონაცემთა ბაზასთან დაკავშირება
$con  = mysqli_connect('localhost','root','','register');

// ბაზაზე ატვირთვისას ქართული ასოების წაკითხვა
$con ->set_charset('utf8');

// შეცდომების მასივი
$errors = array();

// თუ მონაცემთა ბაზასთან დაკავშირება ვერ ხერხდება გამოიტანოს შეცდომა
if(!$con){
    echo 'Database not Connected Error !!!';
}

?>