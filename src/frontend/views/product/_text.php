<?php

/**
 * Created by PhpStorm.
 * User: dench
 * Date: 02.04.17
 * Time: 22:09
 *
 * @var $text string
 * @var $name string
 */
?>
<h1 class="title"><?= $name;  ?></h1>
<div class="row">
    <div class="description_wrapper col-xs-9 col-xs-push-3">
        <p class="description"><?= $text; ?> </p>
    </div>
    <div class="col-xs-3 col-xs-pull-9 price_wrapper">
        <span class="price"></span>
    </div>
</div>