<?php

    // configuration
    require("../includes/config.php"); 
    
    // query database for info of shares
    $rows = CS50::query("SELECT symbol,shares FROM Portfolio
        WHERE user_id = ?",$_SESSION['id']);
        
    // query database for getting cash
    $user_data = CS50::query("SELECT cash FROM users
        WHERE id = ?",$_SESSION['id']);
        
    $_SESSION["balance"]=$user_data[0]["cash"];
    $positions = [];
    
    // storing info of his shares in position
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "value" => $stock["price"]*$row["shares"]
            ];
        }
    }
    $_SESSION["positions"]=$positions;

    // render portfolio
    render("portfolio.php",$positions);

?>
