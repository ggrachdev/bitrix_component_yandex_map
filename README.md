Компонент по свойству из инфоблока выводит точки на карте, кастомизируйте js, tempalate под себя

```php
<?
$APPLICATION->IncludeComponent(
    "ggrachdev:info.map",
    "",
    Array(
        "IBLOCK_ID" => "38",
        "PROPERTY_CODE_COORDINATES" => "COORDINATES",
        "MAX_COUNT_ELEMENTS" => 300,
        'API_KEY' => 'qweqwe'
    )
);
?>
```
