<?php
    // configuration
    require("../includes/config.php"); 
    
 
    if(empty($_POST["symbol"]))
    {
            render("quote_form.php");
    }
    $stock = lookup($_POST["symbol"]);
    if($stock == false)
    {
        apologize("invalid symbol");
    }
    $_SESSION["stock"] = $stock["price"];
    render("quote.php");
?>
