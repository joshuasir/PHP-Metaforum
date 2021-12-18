<?php
    if(isset($_POST['submit'])){
        require 'databaseHandler.php';
        session_start();
        $user = getUser($_SESSION['name']);
    }
    
?>

<section>
    <form action="post">
        <div>
            <label for="name">Display Name</label>
            <input type="text" placeholder=<?= $user['Username'] ?>>
        </div>
        <div>
            <label for="About">About</label>
            <textarea name="" id="" cols="30" rows="10"><?= $user['About'] ?></textarea>
        </div>
        <div>
            <label for="emailvis">Email visibility</label>
            <input type="checkbox" value=<?= $user['EmailVis'] ?>>
        </div>
        <div>
            <img src=<?= $user['ProfileImage'] ?> alt="">
            <label for="profpic">Avatar</label>
            <input type="file">
        </div>
        
        <button> SAVE </button>
    </form>
    <form action="post">
        <p>Changing the fields below require acces to your email</p>
        <div>
            <label for="pass">Change Password</label>
            <input type="password" name="pass">
            <input type="password" name="confpass">
        </div>
        <div>
            <label for="email">E-mail Address</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="delete">Delete Account</label>
            <input type="text" name="delete">
        </div>
        <div>
            <label for="valpass">Password Validation</label>
            <input type="password" name="valpass">
        </div>
        <button>SUBMIT CHANGES</button>
    </form>
</section>