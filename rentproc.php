<?php
session_start(); //세션 처리 시작
include_once('dbconn.php');

$id = $_SESSION['clientId'];
$selected = $_POST['selected'];
$borrow = $_POST['borrow'];
$return = $_POST['return'];


$sql = "insert into rent (scooterNo, rentDate, returnDate, clientID) values ('$selected', '$borrow', '$return', '$id')";

if($conn->query($sql)){
    echo "<script type='text/javascript'>alert('대여가 완료되었습니다.');</script>";
    echo "<script>location.href='index.php'</script>";
}else{
    echo "<script type='text/javascript'>alert('대여 도중에 오류가 발생하였습니다.$conn->error');</script>";
    echo "<script>location.href='rent.php'</script>";
}
?>