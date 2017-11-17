<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'nav.php'; ?>
    <main>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
            $profiles = $conn->query('SELECT * FROM profile')->fetchAll();
            $superpowers = $conn->query('SELECT * FROM superpower')->fetchAll();
            $comments = $conn->query('SELECT * FROM comment JOIN profile ON comment.sender_id = profile.email')->fetchAll();
            $gifts = $conn->query("SELECT * FROM profile_send_gift JOIN gift ON profile_send_gift.gift_id = gift.id JOIN profile ON profile.email = profile_send_gift.sender_id")->fetchAll();
            $gift_numbers = $conn->query("SELECT reciever_id, COUNT(*) AS number_of_gifts FROM profile_send_gift GROUP BY reciever_id")->fetchAll();

            foreach ($profiles as $profile) {
                if($profile['email']!== 'groot@guardians.com'){ //first if-statement
                ?>
                    <h2>Name: <?php echo $profile['name'];?></h2>
                    <p>Age: <?php echo $profile['age'];?> years old</p>
                    <p>Description: <?php echo $profile['description'];?></p>
                    <p>Likes: <?php echo $profile['likes'];?></p>
                    <img src="<?php echo $profile['img'];?>" alt="Profile picture" class="profile-img">
<!-----------------------------LIKE----------------------> 
                    <form action="process_like.php" method="post">
                        <input type="text" name="id" value="<?php echo $profile['email'];?>"hidden>
                        <button type="submit" class="btn" >Like<i class="material-icons icon">favorite</i></button>
                    </form>
                <ul>
<!---------------------SUPERPOWERS-------------------------->
            <h4>Superpowers</h4>
                 <?php
            //second loop starts - superpower
                foreach ($superpowers as $superpower){
                    if($profile['email'] === $superpower['profile_id']){
                ?>
                        <li><?php echo $superpower['type'];?></li>
                <?php
                }//If-statement ends
            }//second loop ends
            ?>
            </ul>
<!--------------------COMMENTS---------------------------->
            <?php
            //third loop starts - comment
            foreach ($comments as $comment){
                if($profile['email'] === $comment['reciever_id']){
            ?>
                    <h4>Comments</h4>
                    <p>Comment: <?php echo $comment['content'];?></p>
                    <p>From: <?php echo $comment['name'];?></p>
            <?php
            }//If-statement ends
            }//third loop ends
//----------------------NUMBER OF GIFTS-------------------------------
            //Fourth loop starts - Gift
            foreach ($gift_numbers as $gift_number){ 
                if($profile['email'] === $gift_number['reciever_id']){
            ?>
            <h4>Number of gifts recieved: <?php echo $gift_number['number_of_gifts'];?></h4>
        <?php
        } //If-statement ends
    } //Fourth loop ends
        ?>
<!----------------------------------GIFTS-------------------------->
        <ul>
        <?php
        //fifth loop starts - Gift
        foreach ($gifts as $gift){
            if($profile['email'] === $gift['reciever_id']){
        ?>
                <li>You recieved <?php echo $gift['type'];?> from <?php echo $gift['name'];?></li>
        <?php
        }//if statement ends
    }//Fifth loop ends
        ?> 
        </ul> 
<!---------------------------COMMENT-------------------------------->
            <h3>Write a public comment to <?php echo $profile['name'];?></h3>
            <form action="process_comment.php" method="post">
                <input type="text" name="reciever" value="<?php echo $profile['email'];?>" hidden>
                <label for="content"></label>
                <textarea name="content" cols="30" rows="10" maxlength="300" required></textarea>
                <button type="submit" class="btn">Post comment<i class="material-icons icon">forum</i></button>
            </form>
<!-----------------------------------MESSAGE-------------------------->
            <h3>Send a private message to <?php echo $profile['name'];?></h3>
            <form action="process_message.php" method="post">
                <input type="text" name="reciever" value="<?php echo $profile['email'];?>" hidden>
                <label for="title">Title</label>
                <input type="text" name="title" maxlength="50" required>
                <label for="content">Message</label>
                <textarea name="content" cols="30" rows="10" maxlength="300" required></textarea>
                <button type="submit" class="btn">Send message<i class="material-icons icon">email</i></button>
            </form>
        <hr>
        
        <?php
        
        }//First if-statement 
        }//First loop ends
        } //ends try
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            } //ends catch
?>
    </main>
    </body>
</html>