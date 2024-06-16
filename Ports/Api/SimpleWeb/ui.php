
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Discounter Simple Web Port</title>
</head>
<body>
<form action="discounter.php">
    <label for="amount">Amount</label>
    <input type="text" name="amount" value="<?=htmlspecialchars($input)?>">
    <button type="submit">Calculate</button>
</form>
<?php if (!is_null($discount)) : ?>
Result: <?=$discount?>
<?php endif; ?>
</body>
</html>
