<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>

<div class="hero-unit center">
    <h1>Error! <?php echo $code . " "; ?><small><font face="Tahoma" color="red"><?php echo CHtml::encode($message); ?></font></small></h1>
    <br />
    <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from</p>
    <p><b>Or you could just press this neat little button:</b></p>
    <?php echo CHtml::link('<i class="icon-home icon-white"></i> Take Me Home', Yii::app()->createUrl('menu'), array("class" => "btn btn-large btn-info")); ?></p>
<br />
<p><b>Or Fill this <?php echo CHtml::link('Feedback Form', Yii::app()->createUrl('sFeedback/create')) ?></b>. Please, explain the error detail and Admin will 
    reply your feedback as soon as possible. Thank You... </p>
</div>
<br />