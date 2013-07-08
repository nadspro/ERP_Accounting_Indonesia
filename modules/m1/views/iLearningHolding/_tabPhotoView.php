<div class="page-header">
    <h3>Photo Class Album</h3>
</div>

<?php
$dir = Yii::app()->basePath . "/../shareimages/hr/learning/" . $id;
$contents = scandir($dir, 1);
$counter = 1;
?>

<div class="row">
    <div class="span10">

        <div class="row">
            <ul class="thumbnails">
                <?php
                foreach ($contents as $content) {
                    if ($content != "." && $content != ".." && is_file($dir . "/" . $content) === true) {
                        ?>
                        <div class="span2">
                            <li class="span2">
                                <div class="thumbnail">
                                    <?php
                                    $photo = Yii::app()->request->baseUrl . "/shareimages/hr/learning/" . $id . "/" . $content;
                                    echo "<a target='_blank' rel='lightbox' href='" . Yii::app()->baseUrl . "/shareimages/hr/learning/" . $id . "/" . $content . "'>" . CHtml::image($photo, 'image') . "</a>";
                                    ?>
                                </div>
                            </li>
                        </div>
                        <?php
                        $counter++;
                    }

                    if ($counter === 5)
                        break;
                };
                ?>
            </ul>
        </div>

    </div>
</div>
