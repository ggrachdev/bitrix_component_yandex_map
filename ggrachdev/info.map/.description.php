<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    "NAME" => "Яндекс-карта с точками",
    "DESCRIPTION" => "Компонент выводит Яндекс-карту, либо в модальном окне, либо блоком",
    "PATH" => [
        "ID" => "GGRACHDEV_SOLUTIONS",
        "NAME" => "Решения GGRACHDEV",
        "CHILD" => [
            "ID" => "GGRACHDEV_SOLUTIONS__INFO",
            "NAME" => "Информация"
        ]
    ]
];
