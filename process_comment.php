<?php 
//Variables to connect to database
$servername = "localhost";
$username = "root";
$password = "";
//SEND COMMENT
try {
    //Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //Variabler hentes
        $get_reciever = $_POST['reciever'];
        $get_sender = 'groot@guardians.com';
        $get_content = $_POST['content'];
    //Filtrerer og sanitizer variablerne
        $reciever = filter_var($get_reciever, FILTER_SANITIZE_EMAIL);
        $sender = filter_var($get_sender, FILTER_SANITIZE_EMAIL);
        $content = filter_var($get_content, FILTER_SANITIZE_STRING);
    //Prepare
    $post_comment = $conn->prepare("INSERT INTO comment(content, reciever_id, sender_id) VALUES (:content, :reciever, :sender)");
    //Bind parameters
    $post_comment->bindParam(':content', $content);
    $post_comment->bindParam(':reciever',$reciever);
    $post_comment->bindParam(':sender',$sender);
    //Execute
    $post_comment->execute();    
    
        //Send back to the page
        header('Location:index.php');
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
?>
