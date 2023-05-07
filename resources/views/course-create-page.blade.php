<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Map -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.2.2/ol.css">

    <!-- Quil textarea -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/login.scss',
    'resources/sass/content.scss', 'resources/js/content.js',
    'resources/sass/page-title.scss',
    'resources/sass/course.scss',
    'resources/js/course.js',
    'resources/sass/map.scss', 'resources/js/map.js',
    'resources/sass/form.scss', 'resources/js/form.js',
    'resources/sass/dropdown.scss', 'resources/js/dropdown.js',
    'resources/sass/time.scss',
    ])

</head>
<body>
@auth
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <x-course-create-form-layout></x-course-create-form-layout>
    </div>
</div>
@endauth

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
{{--TODO MOVE FUNCTION TO DROPDOWN.JS--}}
<script>
    function show(elemValue) {
        let optionsDiv = elemValue.parentElement;
        let input = optionsDiv.previousElementSibling;
        input.value = elemValue.innerHTML;
    }

    function dropdownActive(elem) {
        elem.classList.toggle('active');
    }
    function uploadImg(elem) {
        let uploaded_image = "";

        elem.addEventListener('change', function () {
            let reader = new FileReader();

            reader.addEventListener('load', function () {
                let imgDiv = elem.parentElement.previousElementSibling;
                uploaded_image = reader.result;
                console.log(uploaded_image);
                imgDiv.style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
    }

    function accordion(elem) {
        let contentDiv = elem.parentElement;

        if (contentDiv.className !== 'syllabus-content-disabled') {
            elem.classList.toggle('active');
            let panel = elem.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        }
    }

    // function test(elem) {
    //     console.log(elem);
    //     let accordionElem = document.getElementsByClassName('accordion');
    //     let i;
    //
    //     for (i = 0; i < accordionElem.length; i++) {
    //         let contentDiv = accordionElem[i].parentElement;
    //         accordionElem[i].addEventListener('click', function() {
    //             if (contentDiv.className !== 'syllabus-content-disabled') {
    //                 this.classList.toggle('active');
    //                 let panel = this.nextElementSibling;
    //                 if (panel.style.maxHeight) {
    //                     panel.style.maxHeight = null;
    //                 } else {
    //                     panel.style.maxHeight = panel.scrollHeight + "px";
    //                 }
    //             }
    //         });
    //     }
    // }
</script>
</body>
