<?php
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php");
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else
    {
        // ctype_digit returns true if is is a positive digit
        $check_int = ctype_digit($_POST["shares"]);
        
        
        if ($check_int == false)
        {
            apologize("shares must be a postive integer");
        }
        
        // query database for getting cash
        $cash = CS50::query("SELECT cash from users WHERE id = ?",$_SESSION["id"]);
        $stock = lookup($_POST["symbol"]);
        
        // checks if symbol entered is valid
        if ($stock != false)
        {
            $price = $stock["price"];
        }
        else
        {
            apologize("invalid symbol");
        }
        
        $value =$_POST["shares"] * $price;
        
        // checks whether cash is enough to buy
        if ( $value > $cash[0]["cash"])
        {
            apologize("cash is not enough");
        }
        else
        {
            // query database to insert stock information
            CS50::query("INSERT INTO Portfolio (user_id,symbol,shares)
                VALUES (?,?,?) ON DUPLICATE KEY UPDATE shares = shares + ?",
                $_SESSION["id"],$_POST["symbol"],$_POST["shares"],$_POST["shares"]);
                
            CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",
                $value,$_SESSION["id"]);
                
            date_default_timezone_set('Asia/Kolkata');
    	    $time = date('H:i:s',time());
    	    
    	    $date = date("Y-m-d");
    	    
    	    $Info = lookup($_POST["symbol"]);
    	    
            // query database to store record of transaction
            CS50::query("INSERT INTO history (id, symbol, shares, stock, price, date,time)
                VALUES (?, ?, ?, ?, ?, ?, ?) ",$_SESSION["id"],$_POST["symbol"],$_POST["shares"],
                "bought",$Info["price"],$date,$time );                
            redirect("index.php");
        }
    }
?>
    