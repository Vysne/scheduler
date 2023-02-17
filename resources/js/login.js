function checkMark()
{
    let checkBoxElem = document.querySelector('.login-checkbox');
    checkBoxElem.addEventListener('click', function () {
        let checkBoxClasses = checkBoxElem.classList.value;
        if (checkBoxClasses !== 'login-checkbox') {
            checkBoxElem.classList.remove('no-before');
        } else {
            checkBoxElem.classList.add('no-before');
        }
    });
}

window.onload = [checkMark()];
