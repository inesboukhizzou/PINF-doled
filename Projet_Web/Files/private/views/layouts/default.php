<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Doled' ?></title>
</head>

<body>
    <?= $content ?>

    <footer>
        <?php if (defined('DEBUG_TIME')): ?>
            <div>
                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
            </div>
        <?php endif ?>
    </footer>
</body>

</html>