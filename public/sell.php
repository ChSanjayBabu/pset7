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
                    $value =$info["value"];
                    
            }
        }
        $cash = CS50::query("SELECT cash FROM users where id = ?",$_SESSION["id"]);
        $Cash =$cash[0]["cash"] + $value;

        CS50::query("UPDATE users SET cash = ? WHERE id = ?",$Cash,$_SESSION["id"]);
        redirect("index.php");
    }
?>