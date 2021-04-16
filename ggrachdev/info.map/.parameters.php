<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => 'ID Инфоблока',
            "TYPE" => "STRING"
        ],
        "PROPERTY_CODE_COORDINATES" => [
            "PARENT" => "BASE",
            "NAME" => 'Код свойства координат',
            "TYPE" => "STRING"
        ],
        "MAX_COUNT_ELEMENTS" => [
            "PARENT" => "BASE",
            "NAME" => 'Максимальное количество элементов',
            "TYPE" => "STRING",
            "DEFAULT" => 300
        ],
        "API_KEY" => [
            "PARENT" => "BASE",
            "NAME" => 'Ключ яндекс-карт',
            "TYPE" => "STRING",
            "DEFAULT" => 300
        ]
    ]
];
