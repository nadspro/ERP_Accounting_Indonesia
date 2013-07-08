<div style="min-height:400px">
    <?php
    $dir = Yii::app()->basePath . "/../shareimages/photo";
    $contents = scandir($dir, 1);

    $counter = 1;

    foreach ($contents as $content) {
        if ($content != "." && $content != ".." && is_dir($dir . "/" . $content) !== true) {
            $filename = explode(".", $content);
            if ($filename[1] === "jpg" || $filename[1] === "JPG" || $filename[1] === "jpeg" || $filename[1] === "JPEG") {
                if (is_file($dir . "/" . $filename[0] . ".xml"))
                    $xml = simplexml_load_file($dir . "/" . $filename[0] . ".xml");

                $photo[$filename[0]] = array(
                    'id' => $filename[0],
                    'caption' => (isset($xml)) ? $xml->children()->title : '',
                    'image' => Yii::app()->baseUrl . "/shareimages/photo/" . $content,
                    'url' => Yii::app()->createUrl('/site/photoAlbum', array('id' => $filename[0])),
                        //'url' => Yii::app()->createUrl('/site/photo',array()),
                );
                $counter++;
            }
        }

        if ($counter === 6)
            break;
    }
    ?>

    <?php
    $this->widget('bootstrap.widgets.TbCarousel', array(
        'items' => $photo,
    ));
    ?>
</div>

