<?php
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("pass_form.php");
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $data = CS50::query("SELECT hash FROM users where id = ?",$_SESSION["id"]);
        // checks whether user entered a password
        
        // checks if the user enters valid info
        if (empty($_POST["password"]))
        {
            apologize("You must enter your password");
        }
        else if(password_verify($_POST["password"], $data[0]["hash"]) == false)
        {
            apologize("You must enter correct present password");
        }
        else if (empty($_POST["new_pass"]))
        {
            apologize("You must provide your  new password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must type password again for confirmation.");
        }
        else if (strcmp($_POST["new_pass"],$_POST["confirmation"]) != 0)
        {
            apologize("you must retype correct password.");
        }
        else
        {   
            // query database to set users password
            CS50::query("UPDATE users SET hash = ? WHERE id = ?",
                password_hash($_POST["new_pass"], PASSWORD_DEFAULT),$_SESSION["id"]);
                
            // renders to disp the change message
            render("pass_change.php");
        }
    }
?>