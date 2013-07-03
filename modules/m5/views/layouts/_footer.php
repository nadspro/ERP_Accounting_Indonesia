
<div class="row">
			<div class="span12">
				<div style="text-align:center; color:#cbcbcb; font-size:12px;margin-top:20px;padding:10px 0;background-color:grey;">

					<?php echo Yii::app()->params['title']?> :: Ver <?php echo Yii::app()->params['appVersion']?>
					<br/>

					Copyright &copy;<?php echo date('Y'); ?> <?php echo Yii::app()->params['custom1']?> All Rights Reserved 
					<br /> 
					Designed & Developed by <?php echo Yii::app()->params['adminName']?> (<?php echo Yii::app()->params['adminEmail']?> :: <?php echo Yii::app()->params['adminHp']?>)
					<br />
					<?php echo CHtml::link('Term and Conditions of Use', Yii::app()->createUrl('site/link',array('view'=>'tac')))?> | <?php echo CHtml::link('Privacy Policy', Yii::app()->createUrl('site/link',array('view'=>'policy')))?> 
					<br /> 
<?php /*					<a href="http://www.yiiframework.com/">Yii Framework</a>
							<a href="http://jquery.com/"> JQuery</a>
							<a href="http://jqueryui.com/"> JQueryUI</a>
					| <a
						href="http://www.artisteer.com/">Artisteer</a> | <a
						href="http://www.yiiframework.com/extensions/">Yii Framework Extension</a> | <a
						href="http://findicons.com/">Find Icon</a> / <a href="http://famfamfam.com/">FamFamFam</a> | <a
						href="http://twitter.github.com/bootstrap/">Tbstrap Twitter</a> 
*/ ?>
				</div>
			</div>
</div>
