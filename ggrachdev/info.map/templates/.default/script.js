function ggrachDevMap(id_map, apiKey, arPoints) {
    var that = this;
    this.id_map = id_map;
    this.node_map = null;
    this.api_key = apiKey;
    this.arPoints = arPoints;

    if (typeof ymaps === "undefined")
    {
        BX.loadScript('https://api-maps.yandex.ru/2.1/?apikey=' + that.api_key + '&lang=ru_RU', this.initMap.bind(this));
    } else
    {
        this.initMap();
    }
}

ggrachDevMap.prototype.initMap = function () {

    if (typeof ymaps === "undefined" || !('Map' in ymaps))
    {
        setTimeout(this.initMap.bind(this), 100);
        return;
    }

    if (this.arPoints.length)
    {
        var $map = document.getElementById(this.id_map);
        if ($map)
        {
            this.node_map = $map;

            var options = {
                zoom: 9,
                center: this.arPoints[0].COORDINATES
            };

            var myMap = new ymaps.Map(this.id_map, options, {
                searchControlProvider: 'yandex#search'
            });

            var myGeoObjects = [];

            this.arPoints.forEach(function (element) {
                var myPlacemarkWithContent = new ymaps.GeoObject({
                    geometry: {type: "Point", coordinates: element.COORDINATES},
                    properties: {
                        clusterCaption: element.NAME,
                        hintContent: element.NAME,
                        balloonContent: element.NAME + '<br>' + element.PREVIEW_TEXT + '<br>' + '<a target="_blank" href="' + element.DETAIL_PAGE_URL + '">Перейти</a>'
                    }
                });
                myGeoObjects.push(myPlacemarkWithContent);
                myMap.geoObjects.add(myPlacemarkWithContent);
            });

            if (this.arPoints.length > 1)
            {
                myMap.setBounds(myMap.geoObjects.getBounds(), {checkZoomRange: true, zoomMargin: 9});
            }


            var clusterer = new ymaps.Clusterer({clusterDisableClickZoom: true});
            clusterer.add(myGeoObjects);
            myMap.geoObjects.add(clusterer);

        }
    }
};