<?php
    // configuration
    require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["symbol"]))
        {
            apologize("you must enter a symbol");
        }
        $stock = lookup($_POST["symbol"]);
        if($stock == 0)
        {
            apologize("invalid symbol");
        }
        render("quote.php",$stock);
    }
?>
