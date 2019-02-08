<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php
include ('server.php');
include ('proces.php');

if(empty($_SESSION['username'])){
    header('location:index.php');
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location:index.php');

}
?>
<div class="header">
    <div class="dropdown float-right mr-5 mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['username'];?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a href="admin.php?logout='1'">გამოსვლა</a></li>
        </div>
    </div>
</div>
<div class="siaxle">
    <form method="post" action="admin.php">
    <textarea name="siaxle"></textarea>
    <br>
    <button name="add">გამოქვეყნება</button>
    <br>
    <div class="msg">
        <?php echo $msg;?>
    </div>
    <div class="error">
        <?php include ('error.php')?>
    </div>
    </form>
</div>
<script>

    setTimeout(function() {
        $('.msg').fadeOut('slow');
    }, 1500);
</script>
</body>
</html>