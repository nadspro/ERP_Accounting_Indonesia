<h2>UNSUPPORTED BROWSER</h2>
<p>
    Please use <a href="http://www.firefox.com">Firefox</a> | <a
        href="http://chrome.google.com">Chrome</a> | <a
        href="http://www.opera.com">Opera</a>
</p>

<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>

<div class="hero-unit center">
    <h1>UNSUPPORTED BROWSER! <?php echo $code . " "; ?><small><font face="Tahoma" color="red"><?php echo CHtml::encode($message); ?></font></small></h1>
    <br />
    <p>
        Please choose one of this following browsers <br/><br/>
        <a href="http://www.firefox.com">Firefox</a> | <a
            href="http://chrome.google.com">Chrome</a> | <a
            href="http://www.opera.com">Opera</a>
    </p>

</div>
