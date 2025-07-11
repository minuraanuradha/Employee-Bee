<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Bee - <?php echo isset($title) ? htmlspecialchars($title) : 'Home'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>/css/app.css" rel="stylesheet">
</head>
<body class="text-white p-6">
    <?php echo $content; ?>
</body>
</html>