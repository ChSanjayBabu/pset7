<?php
    // configuration
    require("../includes/config.php"); 
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php");
    }
    else
    {
        $check_int = ctype_digit($_POST["shares"]);
        if ($check_int == false)
        {
            apologize("shares must be a postive integer");
        }
        $cash =CS50::query("SELECT cash from users WHERE id = ?",$_SESSION["id"]);
        $stock = lookup($_POST["symbol"]);
        if ($stock != false)
        {
            $price = $stock["price"];
        }
        else
        {
            apologize("invalid symbol");
        }
        $value =$_POST["shares"] * $price;
        if ( $value > $cash[0]["cash"])
        {
            apologize("cash is not enough");
        }
        else
        {
            CS50::query("INSERT INTO Portfolio (user_id,symbol,shares)
                VALUES (?,?,?) ON DUPLICATE KEY UPDATE shares = shares + ?",
                $_SESSION["id"],$_POST["symbol"],$_POST["shares"],$_POST["shares"]);
            CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?",
                $value,$_SESSION["id"]);
                
            date_default_timezone_set('Asia/Kolkata');
    	    $time = date('H:i:s',time());
    	    
    	    $date = date("d-m-Y");
    	    
    	    $Info = lookup($_POST["symbol"]);
    
            CS50::query("INSERT INTO history (id, symbol, shares, stock, price, date, time)
                "bought",$Info["price"],$date,$time );                
            redirect("index.php");
        }
    }
?>
    