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

    //Henter variabler
        $get_reciever = $_POST['reciever'];
        $get_sender = 'groot@guardians.com';
        $get_content = $_POST['content'];
        $get_title = $_POST['title'];
    //Filtrerer og sanitizer dem
        $reciever = filter_var($get_reciever, FILTER_SANITIZE_EMAIL);
        $sender = filter_var($get_sender, FILTER_SANITIZE_EMAIL);
        $content = filter_var($get_content, FILTER_SANITIZE_STRING);
        $title = filter_var($get_title, FILTER_SANITIZE_STRING);
    //Prepare 
    $message = $conn->prepare("INSERT INTO message(content, reciever_id, sender_id, title) VALUE(:content, :reciever,:sender, :title)");
    //Variabler bliver bind med parameterne
    $message->bindParam(':content', $content);
    $message->bindParam(':reciever',$reciever);
    $message->bindParam(':sender',$sender);
    $message->bindParam(':title',$title);

    //Bliver executed
    $message->execute();    
    
        //Send back to the page
        header('Location:index.php');
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
?>
