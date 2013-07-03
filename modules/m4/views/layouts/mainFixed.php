<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?>
</title>
<meta name="description" content="Description" />
<meta name="keywords" content="Keywords" />


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />

<!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

<?php
//Yii::app()->sprite->registerSpriteCss();
?>


</head>
<style>
body {
	padding-top: 50px;
	/* 60px to make the container go all the way to the bottom of the topbar */
}

@media ( max-width : 980px) {
	body {
		padding-top: 0px;
	}
}
</style>

<body>
	<div class="container">



		<?php $this->beginContent('/layouts/_bootNavBar'); $this->endContent(); ?>

		<?php echo $content; ?>

		<?php $this->beginContent('/layouts/_footer'); $this->endContent(); ?>


	</div>
</body>
</html>


