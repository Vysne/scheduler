// import {Feature, Map, Overlay, View} from 'ol/index.js';
// import {OSM, Vector as VectorSource} from 'ol/source.js';
// import {Point} from 'ol/geom.js';
// import {Tile as TileLayer, Vector as VectorLayer} from 'ol/layer.js';
import Map from 'ol/Map.js';
import Overlay from 'ol/Overlay.js';
import TileLayer from 'ol/layer/Tile.js';
import View from 'ol/View.js';
import XYZ from 'ol/source/XYZ.js';
import {toLonLat} from 'ol/proj.js';
import {toStringHDMS} from 'ol/coordinate.js';

// import {toLonLat, useGeographic} from 'ol/proj.js';
// import {toStringHDMS} from "ol/coordinate";

// useGeographic();
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

    const content = document.getElementById('popup-content');
    const container = document.getElementById('popup');
    const closer = document.getElementById('popup-closer');

    var overlay = new ol.Overlay({
        element: container,
        autoPan: {
            animation: {
                duration: 250,
            },
        },
    });

    closer.onclick = function () {
        overlay.setPosition(undefined);
        closer.blur();
        return false;
    };

    const map = new ol.Map({
        layers: [
            new ol.layer.Tile({
                source: source,
            }),
        ],
        controls: ol.control.defaults.defaults({attribution: false}).extend([attribution]),
        overlays: [overlay],
        target: 'map',
        view: new ol.View({
            constrainResolution: true,
            center: ol.proj.fromLonLat([23.90, 54.90]),
            zoom: 10
        })
    });

    map.on('click', function (event) {
        const feature = map.forEachFeatureAtPixel(event.pixel, function (feature) {
            return feature;
        });
        if (feature) {
            enabledPopup(event);
        } else {
            var point = map.getCoordinateFromPixel(event.pixel);
            var lonLat = ol.proj.toLonLat(point);

            map.getLayers().forEach(function (layer) {
               if (layer.get('name') === 'marker') {
                   map.removeLayer(layer);
               }
            });

            const marker = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature({
                            geometry: new ol.geom.Point(
                                ol.proj.fromLonLat(lonLat),
                            ),
                            id: Math.floor((Math.random() * 100) + 1)
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
            let longitude = document.getElementById('lon');
            let latitude = document.getElementById('lat');
            longitude.value = lonLat[0];
            latitude.value = lonLat[1];

            marker.set('name', 'marker');
            map.addLayer(marker);
        }
    });

    function enabledPopup(evt) {
        const feature = map.forEachFeatureAtPixel(evt.pixel, function (feature) {
            return feature;
        });

        if (feature) {
            const markerCordinates = evt.coordinate;
            const hdms = toStringHDMS(toLonLat(markerCordinates));
            const coordinates = feature.getGeometry().getCoordinates();

            content.innerHTML = '<p>You clicked here:</p><a href="https://www.google.com/maps/place/' + hdms + '" target="_blank">' + hdms + '</a>';
            overlay.setPosition(coordinates);
        }
    }
}

window.onload = initMap();
