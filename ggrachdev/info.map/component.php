<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;

$arResult['POINTS'] = [];
$arResult['IBLOCK_ID'] = null;
$arResult['PROPERTY_CODE_COORDINATES'] = null;
$arResult['MAX_COUNT_ELEMENTS'] = null;
$arResult['API_KEY'] = null;

if (
    Loader::includeModule('iblock') &&
    !empty($arParams['IBLOCK_ID']) &&
    !empty($arParams['PROPERTY_CODE_COORDINATES']) &&
    !empty($arParams['MAX_COUNT_ELEMENTS']) &&
    \is_numeric(trim($arParams['MAX_COUNT_ELEMENTS'])) &&
    \is_numeric(trim($arParams['IBLOCK_ID']))
) {

    // Prepare params
    $arParams['IBLOCK_ID'] = trim($arParams['IBLOCK_ID']);
    $arParams['PROPERTY_CODE_COORDINATES'] = trim($arParams['PROPERTY_CODE_COORDINATES']);
    $arParams['MAX_COUNT_ELEMENTS'] = trim($arParams['MAX_COUNT_ELEMENTS']);

    // Component logic
    $entityIblock = Iblock::wakeUp($arParams['IBLOCK_ID'])->getEntityDataClass();

    $elements = $entityIblock::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_TEXT',
                'CODE',
                'IBLOCK_SECTION_ID',
                'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
                $arParams['PROPERTY_CODE_COORDINATES'] . '_' => $arParams['PROPERTY_CODE_COORDINATES'],
            ],
            'filter' => [
                '=ACTIVE' => 'Y'
            ],
            'limit' => $arParams['MAX_COUNT_ELEMENTS']
        ])->fetchAll();

    if (!empty($elements)) {
        foreach ($elements as $arItem) {
            if (!empty($arItem[$arParams['PROPERTY_CODE_COORDINATES'] . '_VALUE'])) {
                $arItem['DETAIL_PAGE_URL'] = '/' . ltrim(CIBlock::ReplaceDetailUrl($arItem['DETAIL_PAGE_URL'], $arItem, false, 'E'), '/');
                $coordinates = $arItem[$arParams['PROPERTY_CODE_COORDINATES'] . '_VALUE'];

                $arResult['POINTS'][] = [
                    'NAME' => $arItem['NAME'],
                    'DETAIL_PAGE_URL' => $arItem['DETAIL_PAGE_URL'],
                    'PREVIEW_TEXT' => $arItem['PREVIEW_TEXT'],
                    'COORDINATES' => explode(',', $coordinates)
                ];
            }
        }
    }
    
    // Set arResult
    $arResult['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
    $arResult['PROPERTY_CODE_COORDINATES'] = $arParams['PROPERTY_CODE_COORDINATES'];
    $arResult['MAX_COUNT_ELEMENTS'] = $arParams['MAX_COUNT_ELEMENTS'];
    $arResult['API_KEY'] = $arParams['API_KEY'] ? $arParams['API_KEY'] : '';
}

$this->IncludeComponentTemplate();
