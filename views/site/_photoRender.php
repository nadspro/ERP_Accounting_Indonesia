<?php
foreach ($contents as $content) {
    if ($content != ".tmb" && $content != "." && $content != ".." && is_dir($dir . "/" . $content) === true) {
        if (is_file($dir . "/" . $content . ".xml"))
            $xml = simplexml_load_file($dir . "/" . $content . ".xml");
        ?>

        <?php if ($counter == 1) { ?>
            <div class="row">
                <ul class="thumbnails">
                <?php } ?>

                <div class="span3">
                    <li class="span3">
                        <div class="thumbnail">
                            <?php
                            $photo = Yii::app()->request->baseUrl . "/shareimages/photo/" . $content . ".jpg";
                            echo CHtml::link(CHtml::image($photo, 'image'), Yii::app()->createUrl("site/photoAlbum", array("id" => $content)));
                            ?>
                            <h3><? echo (isset($xml)) ? $xml->children()->title : "" ?></h3>
                            <p><? echo (isset($xml)) ? peterFunc::shorten_string(strip_tags($xml->children()->description), 30) : "" ?></p>
                        </div>
                    </li>
                </div>

                <?php
                $counter++;
                if ($counter == 4) {
                    ?>
                </ul>
            </div>
            <?php
        }

        if ($counter == 4)
            $counter = 1;
    }
};
?>

<?php if ($counter != 1) { ?>
    </ul>
    </div>
    <?php
}


//	Yii::app()->cache->set('photo'.Yii::app()->user->id,$contents,86400,$dependency);
//} else
//	$contents=Yii::app()->cache->get('photo'.Yii::app()->user->id);
?>
