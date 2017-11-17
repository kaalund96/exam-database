<?php
//DELETE SUPERPOWER
$servername = "localhost";
$username = "root";
$password = "";
try {
    //Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //Variabler hentes
    $get_old_superpower = $_POST['old-superpower'];
    $get_mail = 'groot@guardians.com';
    //filter and sanitize
    $old_superpower = filter_var($get_old_superpower, FILTER_SANITIZE_STRING);
    $mail = filter_var($get_mail, FILTER_SANITIZE_EMAIL);
    //Prepare
    $delete_superpower = $conn->prepare("DELETE FROM superpower WHERE superpower.type = :old_superpower AND superpower.profile_id= :mail");
   //bind parameters
    $delete_superpower->bindParam(':old_superpower', $old_superpower);
    $delete_superpower->bindParam(':mail', $mail);
    //execute
    $delete_superpower->execute();

        //Send back to the page
        header('Location:profile.php');
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            };
?>