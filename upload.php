<?php
    header("Access-Control-Allow-Origin: *");

    /* The superglobal variable $_FILES gives us the ability to access
    all files that were uploaded using an HTML form. The background key
    makes reference to the value of the name attribute in
    <input name="background" /> */
    $file = $_FILES["background"];
    // $isFileUploaded = move_uploaded_file($file["tmp_name"], __DIR__ . "/storage/" . $file["name"]);

	// Content type
	header('Content-type: image/jpeg');

	// Load
	$source = imagecreatefromjpeg($file["tmp_name"]);
	// $source = $file;

	// Rotate
	$rotate = imagerotate($source, 45, 0);

	// Output
	imagejpeg($rotate, __DIR__ . "/storage/" . $file["name"]);

	// Free the memory
	imagedestroy($source);
	imagedestroy($rotate);

    if($isFileUploaded === false) {
        http_response_code(500);
        echo "Problème serveur";
    }
    else {
        http_response_code(201);
        readfile('success.html');
    }

    // Redirection on index.html after 2 seconds
    header("Refresh:2; url=index.html", true, 303);
