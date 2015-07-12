<?php
$room = $_POST['room'];	
$room = htmlspecialchars($room);
$json = file_get_contents('http://blobcast.jackboxgames.com/room/' . $room . '?userId=lolkekrt');

$obj = json_decode($json);
print "<title>Quiplash Resolver.</title>";
print "Server hostname: " . $obj->{'server'}; 
print "<br> Server IP: " . gethostbyname($obj->{'server'});;
print "<br> Current audience count: " . $obj->{'numAudience'}; 
print "<br> <a href='./'>Go back<a/>."
?>
