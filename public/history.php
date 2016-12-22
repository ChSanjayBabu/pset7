<?php

    // configuration
    require("../includes/config.php");
    
    // query database for getting history of transactions
    $history = CS50::query("SELECT symbol, shares, stock, price, date, time
        FROM history WHERE id = ?",$_SESSION["id"]);
    render("history_form.php",$history);
?>
    