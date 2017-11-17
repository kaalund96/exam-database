<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'nav.php'; ?>
    <main>
    <h1>My profile</h1>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
            $profiles = $conn->query("SELECT * FROM profile WHERE profile.email = 'groot@guardians.com'")->fetchAll();
            $superpowers = $conn->query("SELECT * FROM superpower WHERE superpower.profile_id = 'groot@guardians.com'")->fetchAll();
            $gifts = $conn->query("SELECT * FROM profile_send_gift JOIN gift ON profile_send_gift.gift_id = gift.id JOIN profile ON profile.email = profile_send_gift.sender_id WHERE reciever_id = 'groot@guardians.com' GROUP BY profile_send_gift.gift_id")->fetchAll();
            $messages = $conn->query("SELECT * FROM message JOIN profile ON profile.email = message.sender_id WHERE message.reciever_id = 'groot@guardians.com'")->fetchAll();
            $gift_numbers = $conn->query("SELECT reciever_id, COUNT(*) AS number_of_gifts FROM profile_send_gift WHERE reciever_id = 'groot@guardians.com' GROUP BY reciever_id")->fetchAll();
            foreach ($profiles as $profile) {
                ?>
                    <h2>Name: <?php echo $profile['name'];?></h2>
                    <p>Age: <?php echo $profile['age'];?> years old</p>
                    <p>Description: <?php echo $profile['description'];?></p>
                    <p>Likes: <?php echo $profile['likes'];?></p>
                    <img src="<?php echo $profile['img'];?>" alt="Profile picture" class="profile-img">
                <ul>
<!---------------------SUPERPOWERS------------------------>
                <h3>Superpowers:</h3>
                 <?php
            //second loop starts - Superpower
                foreach ($superpowers as $superpower){
                ?>
                        <li><?php echo $superpower['type'];?></li>
                <?php
                ?> </ul>
                <?php
        }//Second loop ends
//-----------------NUMBER OF GIFTS-------------------------
        //third loop starts - Number of gifts
        foreach ($gift_numbers as $gift_number){
            ?>
            <h3>Number of gifts recieved: <?php echo $gift_number['number_of_gifts'];?></h3>
        <?php
        } //third loop ends
        ?>
<!--------------GIFTS-------------------------->
        <ul>
        <?php
        //fourth loop starts - Gift
        foreach ($gifts as $gift){
        ?>
                <li>You recieved <?php echo $gift['type'];?> from <?php echo $gift['name'];?></li>
        <?php
        }//Fourth loop ends
        ?> 
        </ul>
<!-------------------MESSAGE------------------>
        <h3>Private messages recieved:</h3>
        <?php
        //fifth loop
        foreach ($messages as $message){
            ?>
            <h4>From: <?php echo $message['name'];?></h4>
            <h5>Title: <?php echo $message['title'];?></h5>
            <p>Message: <?php echo $message['content'];?></p>
        <?php 
        };//ends fifth loop           
        }//First loop ends
        } //ends try
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            } //ends catch
?>
    <a href="edit_profile.php" class="link">Edit profile <i class="material-icons">mode_edit</i></a>
        </main>
    </body>
</html>