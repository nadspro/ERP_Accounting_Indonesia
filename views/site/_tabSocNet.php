<hr/>

<div class="row">
    <div class="span3">

        <h4><i class="icon-fa-twitter-sign"></i> Twitter</h4>

        <?php
        $this->widget('ext.tweet-master.TweetMaster', array(
            'username' => Yii::app()->params['twittername'],
            //'cssFile'=>Yii::app()->theme->baseUrl.'/css/tweet-master.css', // customize your twitter css file
            'options' => array(
                'avatar_size' => 32,
                'template' => '{avatar}{join} {text}' // optional field
            )
        ));
        ?>

    </div>
    <div class="span3">
        <h4><i class="icon-fa-facebook-sign"></i> Facebook</h4>
    </div>
    <div class="span3">
        <h4><i class="icon-fa-linkedin-sign"></i> LinkedIn</h4>
    </div>
    <div class="span3">
        <h4><i class="icon-fa-rss"></i> RSS</h4>
    </div>
</div>
