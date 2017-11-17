<?php 
//Variables to connect to database
$servername = "localhost";
$username = "root";
$password = "";

//EDIT PROFILE
try {
    //Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //Variabler hentes
        $get_name = $_POST['name'];
        $get_age = $_POST['age'];
        $get_description = $_POST['description'];
        $get_mail = 'groot@guardians.com';
    //Sanitize og filter
    $name = filter_var($get_name, FILTER_SANITIZE_STRING);
    $age = filter_var($get_age, FILTER_SANITIZE_NUMBER_INT);
    $description = filter_var($get_description, FILTER_SANITIZE_STRING);
    $mail = filter_var($get_mail, FILTER_SANITIZE_EMAIL);
    
    //Prepare
    $update_profile = $conn->prepare("UPDATE profile SET name= :name, age = :age, description = :description WHERE email = :mail");
    //Bind parameters
    $update_profile->bindParam(':name', $name);
    $update_profile->bindParam(':age',$age);
    $update_profile->bindParam(':description', $description);
    $update_profile->bindParam(':mail', $mail);
    //Execute
    $update_profile->execute();    

        //Send back to the page
        header('Location:profile.php');
        }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            };
