function localTime()
{
    const today = new Date();
    let hours = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();
    let currentDate = today.toJSON().slice(0, 10);
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);
    document.getElementById('current-date').innerText = currentDate;
    document.getElementById('clock').innerText = hours + ':' + minutes + ':' + seconds;
    document.getElementById('greeting').innerText = localTimeGreeting(hours);
    setTimeout(localTime, 1000);
}

function checkTime(value)
{
    if (value < 10) {
        value = "0" + 1;
    }

    return value;
}

function localTimeGreeting(value)
{
    let greetingText = '';
    if (value < 12) {
        greetingText = 'Good morning!';
    }
    if (value < 18) {
        greetingText = 'Good afternoon!';
    } else {
        greetingText = 'Good evening!';
    }

    return greetingText;
}

function sidebarInteraction()
{
    let sidebarButton = document.getElementById('sidebarToggle');
    sidebarButton.addEventListener('click', function () {

        if (sidebarButton.getAttribute('target') === 'expanded') {
            shrinkSidebar(sidebarButton);
        } else {
            expandSidebar(sidebarButton);
        }
    });
}

function shrinkSidebar(sidebarButton)
{
    sidebarButton.setAttribute('target', 'shrinked');
    sidebarButton.classList.add('shrink-sidebar-button');
    document.querySelector('.sidebar-wrap').style.width = '5%';
    let sidebarLogo = document.querySelector('.sidebar-logo');
    sidebarLogo.classList.add('shrink-sidebar-logo-anchor-tag');
    sidebarLogo.innerHTML = '<img src="http://127.0.0.1:8000/img/scheduler-logo-top.png" class="shrink-sidebar-logo">';
    document.querySelector('.sidebar-local-time').classList.add('disabled');
    let sidebarButtonTexts = document.querySelectorAll('.sidebar-item-title');
    sidebarButtonTexts.forEach(function (buttonText) {

        buttonText.classList.add('disabled');
    })
    let sidebarHeadings = document.querySelectorAll('.sidebar-heading');
    sidebarHeadings.forEach(function (sidebarHeading) {
        sidebarHeading.classList.add('shrink-sidebar-heading');
    });
    let buttonLogos = document.querySelectorAll('.sidebar-item');
    buttonLogos.forEach(function (buttonLogo) {
        buttonLogo.classList.add('shrink-sidebar');
    });
}

function expandSidebar(sidebarButton)
{
    sidebarButton.setAttribute('target', 'expanded');
    sidebarButton.classList.remove('shrink-sidebar-button');
    document.querySelector('.sidebar-wrap').style.width = null;
    let sidebarLogo = document.querySelector('.sidebar-logo');
    sidebarLogo.classList.remove('shrink-sidebar-logo-anchor-tag');
    sidebarLogo.innerHTML = '<img src="http://127.0.0.1:8000/img/scheduler-logo-top.png"> Just Course It ! <img src="http://127.0.0.1:8000/img/scheduler-logo-bottom.png">';
    let disabledElements = document.querySelectorAll('.disabled');
    disabledElements.forEach(function (disabledElement) {
        disabledElement.classList.remove('disabled');
    });
    let sidebarHeadings = document.querySelectorAll('.sidebar-heading');
    sidebarHeadings.forEach(function (sidebarHeading) {
        sidebarHeading.classList.remove('shrink-sidebar-heading');
    });
    let shrinkedButtonLogos = document.querySelectorAll('.sidebar-item');
    shrinkedButtonLogos.forEach(function (shrinkedButtonLogo) {
        shrinkedButtonLogo.classList.remove('shrink-sidebar');
    });
}

function currentPageMarkUp()
{
    let currentPage = document.querySelector('.page-title').firstElementChild.innerHTML;
    let sidebarBtn = document.querySelector(`.sidebar-item-link[title="${currentPage}"]`);

    sidebarBtn.classList.add('selected');
}

function scrollablePageSidebar()
{
    let sidebarElem = document.querySelector('.sidebar-container');
    if (document.body.scrollHeight > window.innerHeight) {
        sidebarElem.classList.remove('not-scrollable')
    } else {
        sidebarElem.classList.add('not-scrollable')
    }
}


window.onload = [localTime(), sidebarInteraction(), currentPageMarkUp(), scrollablePageSidebar()];
