<?php

    // configuration
    require("../includes/config.php"); 
    
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
        CS50::query("DELETE FROM Portfolio WHERE user_id = ?
            AND symbol = ?",$_SESSION["id"],$_POST["symbol"]);
        $user_info = $_SESSION["positions"];
        foreach ($user_info as $info)
        {
            if($info["symbol"] == $_POST["symbol"])
            {
                    $value = $info["value"];
                    $shares = $info["sahres"];
                    $price = $info["price"];
            }
        }
        $cash = CS50::query("SELECT cash FROM users where id = ?",$_SESSION["id"]);
        $Cash =$cash[0]["cash"] + $value;

        CS50::query("UPDATE users SET cash = ? WHERE id = ?",$Cash,$_SESSION["id"]);

        
        date_default_timezone_set('Asia/Kolkata');
	    $time = date('H:i:s',time());
	    
	    $date = date("d-m-Y");

        CS50::query("INSERT INTO history (id, symbol, shares, stock, price, date, time)
            VALUES (?, ?, ?, ?, ?, ?, ?) ",$_SESSION["id"],$_POST["symbol"],$shares,
            "sold",$price,$date,$time );
            
        redirect("index.php");
    }
?>