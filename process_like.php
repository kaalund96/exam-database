<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Liked successfully - Send a gift?</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'nav.php'; ?>
<?php 
//Variables to connect to database
$servername = "localhost";
$username = "root";
$password = "";

//LIKE
try {
    //Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    //Variabler hentes
        $get_id = $_POST['id'];
        $get_value = 1;
    //Filter og sanitize variabler
        $id = filter_var($get_id, FILTER_SANITIZE_EMAIL);
        $value = filter_var($get_value, FILTER_SANITIZE_NUMBER_INT);
    //Prepare
    $like = $conn->prepare("UPDATE profile SET likes = likes + :value WHERE email = :id");
    //Bind parameters
    $like->bindParam(':id',$id);
    $like->bindParam(':value', $value);
    //Execute
    $like->execute();    
    ?>
<!---------------------GIFT-------------------------->
        <h1>You have successfully liked - Would you like to send a gift as well?</h1>
        <form action="process_gift.php" method="post">
                <input name="gift_reciever" value="<?php echo $id?>" hidden></input>
            </select>
            <label for="gift">Choose gift</label>
            <select name="gift">
                <?php $gifts = $conn->query('SELECT * FROM gift')->fetchAll();
                foreach ($gifts as $gift){
                    ?>
                    <option value="<?php echo $gift['id'];?>"><?php echo $gift['type'];?></option>
               <?php 
            }//ends foreach-loop

               ?>
            </select>
            <button type="submit" class="btn">Send gift</button>
        </form>
        <a href="index.php" class="link"><i class="material-icons">arrow_back</i>No thanks - Back to Home</a>
        <?php
            }//ends try
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            };
?>
</body>
</html>