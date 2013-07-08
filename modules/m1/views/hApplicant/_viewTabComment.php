<?php if ($data->commentC != 0) { ?>
    <div style="border-color:#cbcbcb;border-style:solid; border-width:1px; padding:2px 4px; margin:5px 0" id="c<?php echo $data->id ?>" >
        <ul>
            <strong>Comment:</strong>
            <?php
            foreach ($data->comment as $comment) {
                echo CHtml::opentag('li', array());
                echo CHtml::tag("strong", array(), $comment->user->username) . ". " . waktu::nicetime($comment->created_date) . " : " . $comment->comment;
                echo CHtml::closetag('li');
            }
            ?>

        </ul>
    </div>
<?php } ?>
