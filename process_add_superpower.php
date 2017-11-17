<?php
//ADD SUPERPOWER
$servername = "localhost";
$username = "root";
$password = "";
    try {
        //Connect to database
        $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
        //Variabler hentes
        $get_new_superpower = $_POST['new-superpower'];
        $get_mail = 'groot@guardians.com';
        //filter and sanitze
        $new_superpower = filter_var($get_new_superpower, FILTER_SANITIZE_STRING);
        $mail = filter_var($get_mail, FILTER_SANITIZE_EMAIL);
        //prepare
        $insert_superpower = $conn->prepare("INSERT INTO superpower (profile_id, type) VALUES (:mail, :superpower)");
        //bind parameters
        $insert_superpower->bindParam(':superpower', $new_superpower);
        $insert_superpower->bindParam(':mail',$mail);
        //execute
        $insert_superpower->execute();
    
            //Send back to the page
            header('Location:profile.php');
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                };
?>