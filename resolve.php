<?php

//function for checking HTTP response code to see if API returns data
function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}



//Gets room code from POST and puts it into HTML special doohickies.
$room = $_POST['room'];	
$room = htmlspecialchars($room);


//Checks if entered code is valid.
if (strlen($room)<4) {
	echo "Invalid room code. A room code must be 4 characters.";
	die();

}
if (strlen($room)>4) {
	echo "Invalid room code. A room code must be 4 characters.";
	die();

}
if (!ctype_alpha($room)) {
	echo "Invalid room code. A room code only consists of alphabetical characters.";
	die();
}

// Checks if Jackbox API returns information, if so, grab it!
$json = "";
if(get_http_response_code('http://blobcast.jackboxgames.com/room/' . $room . '?userId=lolkekrt') != "200"){
    echo "An error occured. Is that the correct room code?";
    die();
}else{
	$json = file_get_contents('http://blobcast.jackboxgames.com/room/' . $room . '?userId=lolkekrt');
    // file_get_contents('http://somenotrealurl.com/notrealpage');
}

//Parses JSON API response.
$obj = json_decode($json);
$server = gethostbyname($obj->{'server'});;
print "<title>Quiplash Resolver.</title>";
print "Server hostname: " . $obj->{'server'}; 
print "<br> Server IP: " . $server;
print "<br> Current audience count: " . $obj->{'numAudience'}; 
print "<br> <a href='./'>Go back<a/>."
?>
