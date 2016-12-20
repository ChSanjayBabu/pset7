<table>
    <?php foreach ($values as $info): ?>
        <tr >
            <td style= "padding :10px"><?= $info["symbol"] ?></td>
            <td style= "padding :10px"><?= $info["value"] ?></td>
        </tr>
    <?php endforeach ?>
</table>
<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus 
            class="form-control" name="symbol" 
            placeholder="Name of stock to be sold" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                sell
            </button>
        </div>
    </fieldset>
</form>