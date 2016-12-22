<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $user_info = $_SESSION["positions"];
        foreach ($user_info as $info)
        {
            $User_info[] = ["symbol" => $info["symbol"],
                            "value" => $info["value"]];
        }
        if(empty($user_info))
        {
            apologize("No shares are available");
        }
        render("sell_form.php",$User_info);
    }
    else
    {
        // query database to delete stock row
        CS50::query("DELETE FROM Portfolio WHERE user_id = ?
            AND symbol = ?",$_SESSION["id"],$_POST["symbol"]);
        $user_info = $_SESSION["positions"];
        foreach ($user_info as $info)
        {
            if($info["symbol"] == $_POST["symbol"])
            {
                    $value = $info["value"];
                    $shares = $info["shares"];
                    $price = $info["price"];
            }
        }
        
        // query database for getting cash
        $cash = CS50::query("SELECT cash FROM users where id = ?",$_SESSION["id"]);
        $Cash =$cash[0]["cash"] + $value;
        
        // query database to update cash
        CS50::query("UPDATE users SET cash = ? WHERE id = ?",$Cash,$_SESSION["id"]);

        // string current date and time
        date_default_timezone_set('Asia/Kolkata');
	    $time = date('H:i:s',time());
	    
	    $date = date("Y-m-d");
	    
        // query database to store record of transaction
        CS50::query("INSERT INTO history (id, symbol, shares, stock, price, date, time)
            VALUES (?, ?, ?, ?, ?, ?, ?) ",$_SESSION["id"],$_POST["symbol"],$shares,
            "sold",$price,$date,$time );
            
        redirect("index.php");
    }
?>