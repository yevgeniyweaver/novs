<?php

$shablon;

if ($crumbs && count($crumbs)) :?>

<div class="m_breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">

    <?php
    $first = true;
    $last = true;
    $i = 0;
    foreach ($crumbs as $v):

    echo(!$first ? ' / ' : '  ');
    config('app.url');
    ?>


    <span itemprop="itemListElement" itemscope  itemtype="http://schema.org/ListItem">

            <?php if (!empty($v["url"]) && count($crumbs) != $i + 1) : ?>


        <?php if(!$first){?>


        <a href="<?php echo $v["url"] ?>" itemscope itemtype="http://schema.org/Thing" itemprop="item">
            <span itemprop="name"><?php echo $v["title"] ?></span>
        </a>

        <?php }else{?>

        <a href="<?=$v["url"]?>" itemscope itemtype="http://schema.org/Thing" itemprop="item">
            <span itemprop="name"><?php echo $v["title"] ?></span>
        </a>

        <?php } ?>

        <?php else : ?>


        <span  itemscope itemtype="http://schema.org/Thing" itemprop="item">
                        <span itemprop="name"><?php echo $v["title"] ?></span>
        </span>

        <?php endif; ?>

        <?php  $first=false; $i++ ?>

        <meta itemprop="position" content="<?=$i?>" />
            </span>

    <?php endforeach; ?>
</div>

<?php endif; ?>
