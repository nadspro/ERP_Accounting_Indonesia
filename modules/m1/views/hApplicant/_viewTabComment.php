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

<p>
    <?php
    $model = new hApplicantComment;

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'comment-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
    ));

    echo CHtml::openTag('div', array('class' => 'row'));
    echo CHtml::tag('div', array('class' => 'span5'), $form->textArea($model, 'comment', array('class' => 'span5')));

    echo CHtml::tag('div', array('class' => 'span2'), CHtml::AjaxSubmitButton('Comment', array('/m1/hApplicant/comment', 'id' => $data->id), array(
                'success' => '
						function() {
							$.fn.yiiGridView.update("c' . $data->id . '", {
								data: $(this).serialize()
							})
							return false;	
						}'
                    )
    ));
    echo CHtml::closeTag('div');
    $this->endWidget();
    ?>
</p>
