function initMap() {
    const key = 'IxMPj55LDxu47ASU0B8D';
    const source = new ol.source.TileJSON({
        url: `https://api.maptiler.com/maps/basic-v2/tiles.json?key=${key}`,
        tileSize: 512,
        crossOrigin: 'anonymous'
    });

    const attribution = new ol.control.Attribution({
        collapsible: false,
    });

    const map = new ol.Map({
        layers: [
            new ol.layer.Tile({
                source: source
            })
        ],
        controls: ol.control.defaults.defaults({attribution: false}).extend([attribution]),
        target: 'map',
        view: new ol.View({
            constrainResolution: true,
            // center: ol.proj.fromLonLat([23.90, 54.90]),
            center: ol.proj.fromLonLat([54.88, 24.0]),
            zoom: 16
        })
    });

    const marker = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [
                new ol.Feature({
                    geometry: new ol.geom.Point(
                        // ol.proj.fromLonLat([23.90, 54.90])
                        ol.proj.fromLonLat([54.88, 24.0])
                    )
                })
            ],
        }),
        style: new ol.style.Style({
            image: new ol.style.Icon({
                src: 'https://docs.maptiler.com/openlayers/default-marker/marker-icon.png',
                anchor: [0.5, 1],
            })
        })
    });

    map.addLayer(marker);
}

window.onload = initMap();
