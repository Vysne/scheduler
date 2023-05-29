import {toStringHDMS} from "ol/coordinate";
import {toLonLat} from "ol/proj";

var editors = ['#course-descr'];

function loadCourseEditor() {
    var quill;

    let courseEditorInput = document.querySelector('input[id="course-descr"]');

    editors.forEach(function (editor) {
       quill = new Quill(editor, {
           modules: {
               toolbar: false,
           },
           readOnly: true,
           theme: 'snow'
       });

       quill.pasteHTML(courseEditorInput.value);
    });
}

function loadInstructorEditors() {
    var quill

    let instructorEditors = document.querySelectorAll('#instructor-descr');

    instructorEditors.forEach(function (instructorEditor) {
        quill = new Quill(instructorEditor, {
            modules: {
                toolbar: false,
            },
            readOnly: true,
            theme: 'snow'
        });

        let instructorEditorInput = instructorEditor.nextElementSibling;
        quill.pasteHTML(instructorEditorInput.value);
    });
}

function loadSyllabusEditors() {
    var quill

    let syllabusEditors = document.querySelectorAll('#syllabus-descr');

    syllabusEditors.forEach(function (syllabusEditor) {
        quill = new Quill(syllabusEditor, {
            modules: {
                toolbar: false,
            },
            readOnly: true,
            theme: 'snow'
        });

        let syllabusEditorInput = syllabusEditor.nextElementSibling;
        quill.pasteHTML(syllabusEditorInput.value);
    });
}

function hideSyllabus() {
    let syllabus = document.querySelector('.syllabus-content-disabled');

    if (syllabus !== null) {
        if (checkEnrollment() !== 'accepted') {
            syllabus.classList.remove('syllabus-content-disabled');
            syllabus.classList.add('syllabus-content');
        } else {
            let syllabuses = document.querySelectorAll('.syllabus-content-disabled');

            syllabuses.forEach(function (syllabus) {
                syllabus.classList.remove('syllabus-content-disabled');
                syllabus.classList.add('syllabus-content');
            });
        }
    } else {
        let syllabuses = document.querySelectorAll('.syllabus-content-disabled');

        syllabuses.forEach(function (syllabus) {
            syllabus.classList.remove('syllabus-content-disabled');
            syllabus.classList.add('syllabus-content');
        });
    }
}

function checkEnrollment() {
    let input = document.getElementById('enroll-check');

    return input.value;
}

let status = document.querySelector('.enrollment-button span');
let ratDisplay = document.querySelector('.course-content-rating p');
let stars = document.querySelectorAll('.fa-star');
let totalStar = 0;

stars.forEach(function (star, index) {
    if (status.innerHTML === 'Joined') {
        star.dataset.rating = index + 1;
        star.addEventListener('mouseover', onMouseOver);
        star.addEventListener('click', onClick);
        star.addEventListener('mouseleave', onMouseLeave);
    }
});

function onMouseOver(e) {
    let ratingVal = e.target.dataset.rating;

    if (!ratingVal) {
        return;
    } else {
        fill(ratingVal);
    }
}

function onMouseLeave(e) {
    fill(totalStar);
}

function onClick(e) {
    let ratingVal = e.target.dataset.rating;
    let input = document.getElementById('user-rating');
    let form = document.getElementById('rating-form');
    totalStar = ratingVal;
    fill(totalStar);
    ratDisplay.innerHTML = ratingVal + '/5 stars';
    input.value = ratDisplay.innerHTML.charAt(0);
    form.submit();
}

function fill(ratingVal) {
    for (let i = 0; i < 5; i++) {
        if (i < ratingVal) {
            stars[i].classList.add('star-checked');
        } else {
            stars[i].classList.remove('star-checked');
        }
    }
}

function ratingLoad() {
    let ratingValue = document.getElementById('user-rating');
    let ratingText = document.querySelector('.course-content-rating p');

    if (ratingValue.value !== 0) {
        let starsNodeList = document.querySelectorAll('.fa-star');
        let starsArray = Array.from(starsNodeList);
        let selectedStars = starsArray.slice(0, ratingValue.value);

        selectedStars.forEach(function (star) {
            star.classList.add('star-checked');
        });
    }

    ratingText.innerHTML = ratingValue.value + '/5 stars';
}

function loadMapMarker() {
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
    let longitude = parseFloat(document.getElementById('lon').value);
    let latitude = parseFloat(document.getElementById('lat').value);

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

    const marker = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [
                new ol.Feature({
                    geometry: new ol.geom.Point(
                        ol.proj.fromLonLat([longitude, latitude]),
                    ),
                    // id: Math.floor((Math.random() * 100) + 1)
                })
            ]
        }),
        style: new ol.style.Style({
            image: new ol.style.Icon({
                src: 'https://docs.maptiler.com/openlayers/default-marker/marker-icon.png',
                anchor: [0.5, 1],
            })
        })
    });
    marker.set('name', 'marker');
    map.addLayer(marker);

    map.on('click', function (event) {
        const feature = map.forEachFeatureAtPixel(event.pixel, function (feature) {
            return feature;
        });
        if (feature) {
            enabledPopup(event);
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

window.onload = [loadCourseEditor(), loadInstructorEditors(), loadSyllabusEditors(), hideSyllabus(), ratingLoad(), loadMapMarker()];
