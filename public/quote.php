<?php
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if(empty($_POST["symbol"]))
    {
            render("quote_form.php");
    }
    
    
    $stock = lookup($_POST["symbol"]);
    
    // checks if user enters valid symbol
    if($stock == false)
    {
        apologize("invalid symbol");
    }
    $_SESSION["stock"] = $stock["price"];
    
    // renders to display info of stock
    render("quote.php");
?>
