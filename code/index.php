<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <?php require_once 'LetterCounter.php'; ?>
    </head>
    <body>
        <?php
            echo "<b>Letter Counter</b><br>";
            $lc = new LetterCounter();
            echo $example = "WWIIS Services Ltd";
            echo "<br>";
            echo $lc->countLettersInString($example);
        ?>
    </body>
</html>