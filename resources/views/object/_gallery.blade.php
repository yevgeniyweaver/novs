<?php if (count($jk_slides) > 0){ ?>
<div id="gallery" style="display: none">

    <?php foreach ($jk_slides as $key=>$photo) :

    $jk_slides[] = 'b' . $object['id'] . '_' . $photo;
    $photo = $photo . '.jpg';
    //krsort($photo);
    //if(file_exists('upload/objects/'.$photo)){


        ?>

    <a data-fancybox="photo" href="http://novostroika.od.ua/upload/objects/<?= $photo ?>">
        <img src="http://novostroika.od.ua/upload/objects/<?= $photo ?>"
             style="width: initial;"
             alt="<?= $object['orient']; ?> Изображение <?=$key+1?>"
             itemprop = "contentUrl">
    </a>

    <?php endforeach; ?>
</div>
<?php } ?>