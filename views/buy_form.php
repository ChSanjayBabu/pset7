<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="symbol"
            placeholder="Enter symbol" type="text"/>
        </div>
        <div class="form-group">
            <input autocomplete="off" class="form-control" 
            name="shares"
            placeholder="number of shares" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Buy
            </button>
        </div>
    </fieldset>
</form>