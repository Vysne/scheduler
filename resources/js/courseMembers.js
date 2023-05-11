function loadEditor() {
    var quill;

    let aboutMeInputs = document.querySelectorAll('.about-me-container input');
    aboutMeInputs.forEach(function (aboutMeInput) {
        let container = aboutMeInput.previousElementSibling;

        quill = new Quill(container, {
            modules: {
                toolbar: false
            },
            readOnly: true,
            theme: 'snow'
        });

        quill.pasteHTML(aboutMeInput.value);
    });
}

function courseMembersTable() {
    let button = document.getElementById('members-button');

    button.addEventListener('click', function (evt) {
        let enlistmentsTable = document.getElementById('enlistments-table');
        let enlistmentButton = document.getElementById('enlistment-button');
        let courseMembersTable = document.getElementById('members-table');

        enlistmentsTable.setAttribute('hidden', '');
        courseMembersTable.removeAttribute('hidden');
        button.classList.add('active');
        enlistmentButton.classList.remove('active');
    });
}

function enlistmentsTable() {
    let button = document.getElementById('enlistment-button');

    button.addEventListener('click', function (evt) {
        let enlistmentsTable = document.getElementById('enlistments-table');
        let courseMembersTable = document.getElementById('members-table');
        let courseMembersButton = document.getElementById('members-button');

        enlistmentsTable.removeAttribute('hidden');
        courseMembersTable.setAttribute('hidden', '');
        button.classList.add('active');
        courseMembersButton.classList.remove('active');
    });
}

window.onload = [loadEditor(), courseMembersTable(), enlistmentsTable()];
