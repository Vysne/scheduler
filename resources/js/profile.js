var editor = '#about-me';

var toolbarOptions = [
    [{ 'font': [] }, { 'size': ['small', false, 'large', 'huge'] }],

    ['bold', 'italic', 'underline', 'strike'],
    [{ 'color': [] }, { 'background': [] }],

    [{ 'script': 'sub'}, { 'script': 'super' }],

    [{ 'header': 1 }, { 'header': 2 }, 'blockquote', 'code-block'],

    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],

    [{ 'direction': 'rtl' }, { 'align': [] }],

    [ 'link', 'image', 'video'],

    ['clean']
];

function loadEditor() {
    var quill;

    let profileEditorInput = document.getElementById('about-me-descr');

    quill = new Quill(editor, {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    quill.pasteHTML(profileEditorInput.value);

    quill.on('text-change', function () {
       getEditorHTML(editor);
    });
}

function getEditorHTML(editor) {
    // console.log(editors);
    var editorHTML = [];
    var html = document.querySelector(editor + ' .ql-editor').innerHTML;
    let input = document.querySelector(`input[id="${editor.substring(1)}-descr"]`);
    input.value = html;

    editorHTML.push(html);
}

function getUserLocation() {
    let locationInput = document.getElementById('user-location');
    let locationDiv = locationInput.previousElementSibling;

    const checkError = (error) => {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                locationInput.value = 'Please allow access to location';
                break;
            case error.POSITION_UNAVAILABLE:
                locationInput.value = 'Location unavailable';
                break;
            case error.TIMEOUT:
                locationInput.value = 'The request to get user location timed out';
        }
    }

    const showLocation = async(position) => {
        let response = await fetch(
            `https://nominatim.openstreetmap.org/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}&format=json`
        );
        let data = await response.json();
        console.log(data);
        locationInput.value = `${data.address.city}, ${data.address.country}`;
        locationDiv.innerHTML = locationInput.value;
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation, checkError);
    } else {
        locationInput.value = 'The browser does not support geolocation';
    }
}

function userStatus() {
    let input = document.getElementById('user-status');
    let span = input.previousElementSibling;

    span.innerText = input.value;
}

function uploadImg(elem) {
    let uploaded_image = "";

    elem.addEventListener('change', function () {
        let reader = new FileReader();

        reader.addEventListener('load', function () {
            let imgDiv = elem.parentElement.previousElementSibling;
            uploaded_image = reader.result;
            imgDiv.style.backgroundImage = `url(${uploaded_image})`;
        });
        reader.readAsDataURL(this.files[0]);
    });
}

function editAction() {
    let button = document.getElementById('edit-button');

    button.addEventListener('click', function () {
        let fields = document.querySelectorAll('.col-sm-9');
        let inputs = document.querySelectorAll('.card-body input');
        let upload = document.querySelector('.upload-container');
        let display = document.getElementById('display-image');
        let image = document.querySelector('.card-body img');
        let imageInput = document.getElementById('file-input');
        let updateButton = document.getElementById('update-button');
        let cancelButton = document.getElementById('cancel-button');


        button.classList.add('disabled-button');
        updateButton.removeAttribute('hidden');
        cancelButton.removeAttribute('hidden');
        upload.removeAttribute('hidden');
        display.removeAttribute('hidden');
        image.setAttribute('hidden', '');



        fields.forEach(function (field) {
           let span = field.firstElementChild;

           if (span && span.dataset.status !== 'static') {
               span.classList.add('disabled');
           }
        });

        inputs.forEach(function (input) {
            input.removeAttribute('hidden');
        });

        let gutter = document.querySelector('.gutters-sm');
        gutter.classList.add('editable');

        uploadImg(imageInput);
        cancelAction(cancelButton, button, updateButton, fields, inputs, upload, display, image, gutter);
    });
}

function cancelAction(cancelButton, editButton, updateButton, fields, inputs, upload, display, image, gutter) {
    console.log(display);
    cancelButton.addEventListener('click', function () {
       inputs.forEach(function (input) {
          input.setAttribute('hidden', '');
       });

       fields.forEach(function (field) {
          let span = field.firstElementChild;
          if (span) {
              span.classList.remove('disabled');
          }
       });

       cancelButton.setAttribute('hidden', '');
       updateButton.setAttribute('hidden', '');
       upload.setAttribute('hidden', '');
       display.removeAttribute('style');
       display.setAttribute('hidden', '');
       image.removeAttribute('hidden');
       editButton.classList.remove('disabled-button');
       gutter.classList.remove('editable');
    });
}

window.onload = [loadEditor(), getUserLocation(), editAction(), userStatus()];
