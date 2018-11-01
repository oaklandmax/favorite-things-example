<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->
        <link rel='stylesheet' href='include/main.css'>
        <? require 'include/survey_lib.php';?>
        <title>Max Perez</title>
    </head>
    <body>
        
        <? require 'include/header.php';
        	$my_survey = new survey();
        ?>
        <div id="contents">
            
            <form method="post" id="favorite_things" action="./thanks.php">
                <fieldset>
                    <legend>Your Favorite Things</legend>
                    
                    <div class="input">
                        <label for="pony">What's your favorite pony type?</label>
                        <select name="pony">
                        <? foreach ($my_survey->ponies as $key => $value): ?>
                            <option value="<? echo $key; if ($value == $user_data) echo 'Selected'; ?>"><? echo $value; ?></option>
                        <? endforeach; ?>
                        </select>
                    </div>

                    <div class="input">
                        <label for="princess">Who's your favorite princess?</label>
                        <select name="princess">
                        <? foreach ($my_survey->princesses as $key => $value): ?>
                            <option value="<? echo $key; if ($value == $user_data) echo 'Selected'; ?>"><? echo $value; ?></option>
                        <? endforeach; ?>
                        </select>
                    </div>

                    <div class="input">
                        <label for="pet">Who's your favorite pet?</label>
                        <select name="pet">
                        <? foreach ($my_survey->pet as $key => $value): ?>
                            <option value="<? echo $key; if ($value == $user_data) echo 'Selected'; ?>"><? echo $value; ?></option>
                        <? endforeach; ?>
                        </select>
                    </div>

                    <div class="input">
                        <label for="wanted_character">Which character do you want to see more of?</label>
                        <input type="text" name="wanted_character" maxlength="45" placeholder="Ex: A Talking Mouse">
                    </div>

                    <div class="input">
                        <label for="fanfic">What's your favorite MLP fanfic?</label>
                        <input type="text" name="fanfic" maxlength="45" placeholder="Could be anything!">
                    </div>

                    <div class="input">
                        <input type="reset" value="Reset"> <input type="submit" value="Submit">
                    </div>

                </filedset>
            </form>

        </div>
        <? require 'include/footer.php';?>
    </body>
</html>
