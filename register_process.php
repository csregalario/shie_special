<?php
	include_once "connection.php";
	
$fname = $_POST ['fname'];
$lname = $_POST ['lname'];
$password = $_POST['password'];
$contact_num= $_POST ['contact_num'];
$email_add = $_POST ['email_add'];
$address = $_POST ['address'];


 
$conn = new mysqli ('localhost','root','','shie_special');
if ($conn->connect_error){
	die ('Connection Failed: '.$conn->connect_error);
}else{
	$stmt = $conn->prepare("INSERT INTO user(fname, lname, password, contact_num, email_add, address)
	values ('$fname', '$lname', '$password', '$contact_num', '$email_add', '$address')");
	//$stmt->bind_param( $first_name, $last_name, $password, $contact_num, $email_add,'$address);
	$stmt-> execute();
	echo "Success";
	$stmt->close();
	$conn->close();
	
}
 ?>
 <meta http-equiv="refresh" content="0; home2.php">v
