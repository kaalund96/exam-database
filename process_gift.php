<?php
//Variables to connect to database
$servername = "localhost";
$username = "root";
$password = "";
//SEND MESSAGE
try {
    //Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //Variabler hentes
        $get_reciever = $_POST['gift_reciever'];
        $get_sender = 'groot@guardians.com';
        $get_gift = $_POST['gift'];
    //Filter og sanitize
        $reciever = filter_var($get_reciever, FILTER_SANITIZE_EMAIL);
        $sender = filter_var($get_sender, FILTER_SANITIZE_EMAIL);
        $gift = filter_var($get_gift, FILTER_SANITIZE_NUMBER_INT); //Gift er gift_id, altså et tal og ikke en string

    //prepare
    $send_gift = $conn->prepare("INSERT INTO profile_send_gift(gift_id, reciever_id, sender_id) VALUES (:gift, :reciever, :sender)");
    
    //bind parameter
    $send_gift->bindParam(':gift', $gift);
    $send_gift->bindParam(':reciever',$reciever);
    $send_gift->bindParam(':sender',$sender);

    //Execute
    $send_gift->execute();    
    
        //Send back to the page
        header('Location:index.php');
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
//SELECT * FROM profile_send_gift JOIN gift ON profile_send_gift.gift_id = gift.id JOIN profile ON profile.email = profile_send_gift.sender_id GROUP BY profile_send_gift.gift_id
?>