
<?php

    if(isset($infos))
    {
        echo '<div id="chats">';

        foreach($infos as $_v)
        {
            if($_v->username == Yii::app()->user->name)
            {
                echo '<ul class="list-group">';
                echo '<li class="list-group-item active">'.mb_substr(md5($_v->username), 0, 8).'(我)   在放屁:'.'</li>';
                echo '<li class="list-group-item list-group-item-success">'.$_v->chat.'</li>';
                echo '<li class="list-group-item">'.$_v->time.'</li>';
                echo '</ul>';
            }
            else
            {
                echo '<ul class="list-group">';
                echo '<li class="list-group-item list-group-item-info">'.mb_substr(md5($_v->username), 0, 8).'   在放屁:'.'</li>';
                echo '<li class="list-group-item list-group-item-success">'.$_v->chat.'</li>';
                echo '<li class="list-group-item">'.$_v->time.'</li>';
                echo '</ul>';
            }

        }

        echo '</div>';
    }
?>
