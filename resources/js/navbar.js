function expandProfileDropdown(profileAnchorTag)
{
    profileAnchorTag.classList.remove('dropdown-menu-disabled');
}

function shrinkProfileDropdown(profileAnchorTag)
{
    profileAnchorTag.classList.add('dropdown-menu-disabled');
}

function profileDropdownToggler()
{
    let profileAnchorTag = document.getElementById('userDropdown');
    profileAnchorTag.addEventListener('click', () => {
        checkForMultipleTogglers(profileAnchorTag);
        let dropdownMenu = document.getElementById('dropdown-menu');
        if (profileAnchorTag.getAttribute('target') === 'expanded') {
            profileAnchorTag.setAttribute('target', 'shrinked');
            shrinkProfileDropdown(dropdownMenu);
        } else {
            profileAnchorTag.setAttribute('target', 'expanded');
            expandProfileDropdown(dropdownMenu)
        }

    });
}

function expandAlertsDropdown(dropdownList)
{
    dropdownList.classList.remove('dropdown-menu-disabled');
}

function shrinkAlertsDropdown(dropdownList)
{
    dropdownList.classList.add('dropdown-menu-disabled');
}

function alertsDropdownToggler()
{
    let alertsAnchorTag = document.getElementById('alertsDropdown');
    alertsAnchorTag.addEventListener('click', () => {
        checkForMultipleTogglers(alertsAnchorTag);
        let dropdownList = document.getElementById('alerts-dropdown-list');
        if (alertsAnchorTag.getAttribute('target') === 'expanded') {
            alertsAnchorTag.setAttribute('target', 'shrinked');
            shrinkAlertsDropdown(dropdownList);
        } else {
            alertsAnchorTag.setAttribute('target', 'expanded');
            expandAlertsDropdown(dropdownList);
        }
    })
}

function expandMessagesDropdown(dropdownList)
{
    dropdownList.classList.remove('dropdown-menu-disabled');
}

function shrinkMessagesDropdown(dropdownList)
{
    dropdownList.classList.add('dropdown-menu-disabled');
}

function messagesDropdownToggler()
{
    let messagesAnchorTag = document.getElementById('messagesDropdown');
    messagesAnchorTag.addEventListener('click', () => {
        checkForMultipleTogglers(messagesAnchorTag);
        let dropdownList = document.getElementById('messages-dropdown-list');
        if (messagesAnchorTag.getAttribute('target') === 'expanded') {
            messagesAnchorTag.setAttribute('target', 'shrinked');
            shrinkMessagesDropdown(dropdownList);
        } else {
            messagesAnchorTag.setAttribute('target', 'expanded');
            expandMessagesDropdown(dropdownList);
        }
    })
}

function checkForMultipleTogglers(currentToggledElement)
{
    let navbarContainer = document.querySelector('nav');
    let navbarToggledContent = navbarContainer.querySelectorAll('a[target="expanded"]');
    if (navbarToggledContent.length !== 0) {
        let currentContent;
        navbarToggledContent.forEach((content) => {
            currentContent = content.id;
        });
        if (currentContent !== currentToggledElement.id) {
            navbarToggledContent.forEach( (content) => {
                content.setAttribute('target', 'shrinked');
                content.nextElementSibling.classList.add('dropdown-menu-disabled');
            });
        }
    }
}


window.onload = [profileDropdownToggler(), alertsDropdownToggler(), messagesDropdownToggler()];
