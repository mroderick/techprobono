<?php
include 'connect.php';

if (isset($_POST['email']) && !(empty($_POST['email']))){
	$twitter = mysql_real_escape_string($_POST['twitter']);
	$github = mysql_real_escape_string($_POST['github']);
	$email = mysql_real_escape_string(strip_tags($_POST['email']));

    $alreadyRegistered = mysql_query("SELECT id FROM `DEVELOPER` WHERE `email` = '$email'");
    if (mysql_num_rows($alreadyRegistered) > 0){
        $json =   '{"error": "already_registered"}';
    } else {
        $query_insertDev = "INSERT INTO `DEVELOPER` (`email`,`twitter`, `github`) VALUES ('$email', '$twitter', '$github')";
        $insertDev = mysql_query($query_insertDev);
        $insertId = mysql_insert_id($con) || "error";
        mysql_close($con);
        $json =  '{"id": "' . $insertId . '"}';
    }
} else {
    $json =   '{"error": "noemail"}';
}

header("Content-Type: application/json; charset=utf-8");
echo utf8_encode($json);

?>
