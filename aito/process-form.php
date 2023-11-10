<?php

$link = $_POST["link"];
$message = $_POST["message"];
$importance = filter_input(INPUT_POST, "importance", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

    if(! $terms ){
    die("accept the terms coward");
}

$host = "localhost";
$dbname = "message_db";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname:$host,
                          username: $username,
                          password: $password,
                          database: $dbname);

    if (mysqli_connect_errno()){
        die("connection error: " . mysqli_connect_error());
    } 

$sql = "INSERT INTO message (link, label, priority)
        VALUES (?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssi",
                        $link,
                        $message,
                        $importance);
mysqli_stmt_execute($stmt);
echo "record saved.";
header('Location: index.html');
exit;