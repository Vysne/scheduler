function achievementUnlocked() {
    let postFormValue = document.getElementById('post-form-value');

    if (postFormValue) {
        var hasClass = document.querySelector('.ach').classList.contains('achieved');

        if (hasClass) {
            return;
        }

        document.querySelector('.ach').classList.add("achieved");

        setTimeout(function(){
            document.querySelector('.ach').classList.remove("achieved");
        },8000);
    }
}

window.onload = achievementUnlocked();

