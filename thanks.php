<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="refresh" content="5; URL=./report.php">
        <meta charset="utf-8"/>
        <link rel='stylesheet' href='include/main.css'>
        <? require 'include/survey_lib.php';?>
        <title>Max Perez</title>
    </head>
    <body>
        <? require 'include/header.php';?>
        <div id="contents">
            <?
            $mysubmit = new survey();
            // funcion to add form response to the database
            if ($mysubmit->insert_survey_answers()) {
                echo "<h2>Thank you for answering the survey</h2>";
            } else {
                Echo "Wow, something didn't work right and your answer was not saved.";
            }
            ?>

            <p>You will be redirected to the report page in a couple of seconds. Click <a href="./report.php"><strong>here</strong></a> if you are tired of waiting.

        </div>
        <? require 'include/footer.php';?>
    </body>
</html>
    