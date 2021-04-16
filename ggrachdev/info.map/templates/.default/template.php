<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult['POINTS'])): ?>

    <section id="ggrach_propty_map" class="ggrach-property-map" style="height: 400px;">

    </section>

    <script>
        var ggrachDevMapInstance = new ggrachDevMap('ggrach_propty_map', <?= \CUtil::PhpToJSObject($arResult['API_KEY']) ?>, <?= \CUtil::PhpToJSObject($arResult['POINTS']) ?>);
    </script>

<? endif; ?>
