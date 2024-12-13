<?php 
if(isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    header("location: users.php");
    die;
}else{
    
}
?>
<?php require("inc/head.php"); ?>


<?php require("inc/nav2.php"); ?>


<?php require("inc/header.php"); ?>

<?php require("inc/footer2.php"); ?>

