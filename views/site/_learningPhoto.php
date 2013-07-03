<div class="page-header">
	<h3>
		<i class="icon-fa-picture"></i>
		Random Learning Photo Activity
	</h3>
</div>

<?php
$dir = Yii::app()->basePath."/../shareimages/hr/learning";
$contents= scandir($dir,1);
$counter=1;
?>


<?php 
	foreach ($contents as $content) { 
		if ($content != "." && $content != ".." && is_dir($dir."/".$content ) === true) {
?>

			<?php if ($counter ==1 ) { ?>
				<div class="row">
				<ul class="thumbnails">
			<?php } ?>

			<div class="span2">
			  <li class="span2">
				<div class="thumbnail">
					<?php 
						$dir2 = Yii::app()->basePath."/../shareimages/hr/learning/".$content;
						$contents2= scandir($dir2,1);

						$photo=Yii::app()->request->baseUrl . "/shareimages/hr/learning/".$content."/".$contents2[0];
						//echo CHtml::link(CHtml::image($photo, 'image'),Yii::app()->createUrl("site/photoAlbum",array("id"=>$contents2[0]))); 
						echo CHtml::image($photo); 
					?>
				</div>
			  </li>
			</div>

			<?php 
			$counter++;
			if ($counter ==5) { ?>
				</ul>
				</div>
			<?php } 
	
			if ($counter == 5)
				$counter=1;

		}
	}; 
	?>

		<?php
		if ($counter !=1 ) { ?>
			</ul>
			</div>
		<?php } ?>

