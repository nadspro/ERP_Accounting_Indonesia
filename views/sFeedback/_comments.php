<?php foreach ($comments as $comment): ?>
    <div class="row">
        <h6 class="pull-right">
            <?php echo $comment->nicetime($comment->sender_date); ?>
        </h6>
        <div class="span1 offset1">
            <b><?php echo sUser::model()->findName($comment->sender_id); ?> </b>
        </div>
        <div class="span5">
            <?php echo nl2br(CHtml::encode($comment->long_desc)); ?>
            <br/>
        </div>
    </div>
<?php endforeach; ?>
