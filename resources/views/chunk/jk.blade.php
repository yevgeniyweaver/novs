<?php
/* @var $no_shadow boolean */
//vd1(K_Registry::get('rayon')['tree_name']);
use App\Helpers\ThisObject;
$h3experiment = array('centr','cheremushki');
$no_shadow=false;
//print_r( Thisobject::getLink($rec));

?>
<div class="b-complex-item object-id" data-id="<?= $rec->id ?>">


    <div class="b-complex-item-img" style="">

        <div class="b-complex-item-lazy">
            <img class="lazyload" src="<?=ThisObject::getFirstImgPath($rec)?>" alt="<?= $rec->orient ?> фото"/>
        </div>
        <? if (!$no_shadow): ?>
        <div id="red-click" class="red-heart img-circle" data-id="<?= $rec->id ?>" >
            <i class="fa fa-heart <?=\App\Helpers\ThisFavorites::isFavorite($rec->id)?'red-heart-active':''?>"></i>
        </div>
        <?php endif; ?>
        <div class="b-complex-logo-block">
            <a class="b-complex-logo-box"><img class="b-complex-logo lazyload"  data-src="/upload/<?= $rec->dev_logo?>"></a>
        </div>

        <div class="b-complex-info">
            <div class="b-complex-item-leyba">
                <?php
                if ($rec->complite == 1):?>
                <div class="b-complex-item-state">ДОМ СДАН</div>
                <?php endif; ?>
                <?php if ($rec->new == 1) : ?>
                <div class="b-complex-item-hot">НОВЫЙ</div>
                <?php endif; ?>
                <?php if ($rec->action == 1) : ?>
                <div class="b-complex-item-akcia">АКЦИЯ</div>
                <?php endif; ?>
                <?php if ($rec->with_repair == 1) : ?>
                <div class="b-complex-item-with-repair">Квартиры с ремонтом</div>
                <?php endif; ?>
            </div>

            <h3><a href="<?=ThisObject::getLink($rec)?>" target="_blank" class="b-complex-name"> <?= $rec->orient ?><br></a></h3>

            <div class="b-complex-location"> <?= $rec->region ?> р-н <br></div>

            <div class="b-complex-square">площадь: <?= $rec->minimal_square; ?></div>

            <div class="b-complex-prise"> от <?= $rec->price ?> <?=$rec->price_cur==2?'грн':'$'?> за м<sup>2</sup> <br></div>
        </div>
    </div>
</div>


