<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel='stylesheet' href='include/main.css'>
        <? require 'include/survey_lib.php';?>
        <title>Max Perez</title>
    </head>
    <body>
        <? require 'include/header.php';?>
        <div id="contents">

            <?
            $debug = false;
            
            $myresults = new survey();
            // these functions call the database for the stats on the user selections
            $pony_stats = $myresults->get_mode_and_count('pony');
            $princess_stats = $myresults->get_mode_and_count('princess');
            $pet_stats = $myresults->get_mode_and_count('pet');
            $wanted_character_stats = $myresults->get_mode_and_count('wanted_character');
            $fanfic_stats = $myresults->get_mode_and_count('fanfic');


            // format the survey results for this page. 
            if (is_array($pony_stats)){
                foreach ($pony_stats as $key=>$value) {
                    $formatted_pony_stats .= "<br>" . $myresults->ponies[$value['pony']] . ": " . $value['COUNT( * )'];
                } 
                if ($debug) {
                    echo '<pre>';
                    var_dump($pony_stats);
                    echo '</pre>';
                }
            }

            if (is_array($princess_stats)){
                foreach ($princess_stats as $key=>$value) {
                    $formatted_princess_stats .= "<br>" . $myresults->princesses[$value['princess']] . ": " . $value['COUNT( * )'];
                } 
            }

            if (is_array($pet_stats)){
                foreach ($pet_stats as $key=>$value) {
                    $formatted_pet_stats .= "<br>" . $myresults->pet[$value['pet']] . ": " . $value['COUNT( * )'];
                } 
            }
            
            if (is_array($wanted_character_stats)){
                foreach ($wanted_character_stats as $key=>$value) {
                    $formatted_wanted_character_stats .= "<br>" . $value['wanted_character'] . ": " . $value['COUNT( * )'];
                }
            }

            if (is_array($fanfic_stats)){
                foreach ($fanfic_stats as $key=>$value) {
                    $formatted_fanfic_stats .= "<br>" . $value['fanfic'] . ": " . $value['COUNT( * )'];
                }
            }

            if ($debug) var_dump($_REQUEST);

            // this is the template where the results are presented to the user
            ?>
            
            <!-- <h2>Thank you for answering the survey</h2> -->

            <h3>Survey Results</h3>

            <p><strong>Favorite Pony:</strong>
            <? echo $formatted_pony_stats; ?>
            </p>
            <p><strong>Favorite Princess:</strong>
            <? echo $formatted_princess_stats; ?>
            </p>
            <p><strong>Favorite Pet:</strong>
            <? echo $formatted_pet_stats; ?>
            </p>
            <p><strong>Most Wanted Character:</strong>
            <? echo $formatted_wanted_character_stats; ?>
            </p>
            <p><strong>Favorite MLP Fanfic:</strong>
            <? echo $formatted_fanfic_stats; ?>
            </p>

        </div>

        <? require 'include/footer.php';?>
    </body>
</html>
