<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php include 'nav.php'; ?>
    <main>
    <h1>Edit your profile</h1>
    <h2>Update current information</h2>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=exam-database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
            $profiles = $conn->query("SELECT * FROM profile")->fetchAll();
            $superpowers = $conn->query("SELECT * FROM superpower WHERE superpower.profile_id = 'groot@guardians.com'")->fetchAll();

            //Post profile data
            foreach ($profiles as $profile) {
                if($profile['email']=== 'groot@guardians.com'){
        ?>
        <form action="process_edit_profile.php" method="post">
            <label for="name">Name:</label>
            <input name="name" type="text" maxlength="30" value="<?php echo $profile['name'];?>">
            <label for="age">Age:</label>
            <input name="age" type="number" max="999" value="<?php echo $profile['age'];?>">
            <label for="decription">Description:</label>
            <textarea name="description" id="" cols="30" rows="10" maxlength="300"><?php echo $profile['description'];?></textarea>
            <button type="submit" class="btn">Save</button>
        </form>
        <h2>Add new superpower</h2>
        <form action="process_add_superpower.php" method="post">
            <label for="new-superpower">Superpower:</label>
            <input name="new-superpower" type="text" maxlength="50" required>
            <button type="submit" class="btn">+ Add superpower</button>        
        </form>
        <h2>Delete disappeared superpower</h2>
        <form action="process_del_superpower.php" method="post">
            <label for="old-superpower">Choose superpower to delete</label>
            <select name="old-superpower">
                    <?php 
                    foreach ($superpowers as $superpower){
                    ?>
                    <option><?php echo $superpower['type'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <button type="submit" class="btn">X Delete superpower</button>
        </form>
        <a href="profile.php" class="link"><i class="material-icons">arrow_back</i>Back to My Profile</a>
        <?php
                }
            }}
            catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            } //ends catch
                ?>
    </main>
    </body>
</html>