<?php
/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-12
 * Time: 12:00 AM
 */


$conn = new PDO('mysql:host=localhost;port=3307;dbname=squad.com.db','root', '');

$content = "Hey I have been waiting for the new TV 6K that has been released on may 48th. Do you guys have it? Best regards, me";
$date = date("d/m/Y H:i:s");
$creator = 16;
$subjectID = 1;
$recipientID = 9935;
$isReplied = 0;

echo $date;

$sql = "INSERT into message (content,date_sent,creator_id,subject_id,recipient_id,isReplied) VALUES ( '$content', '$date','$creator','$subjectID','$recipientID','$isReplied')";

//$conn->exec($sql);
$conn = null;


?>