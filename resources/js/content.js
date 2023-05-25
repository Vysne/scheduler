function ratingLoad() {
    let ratingValues = document.querySelectorAll('.course-rating input');
    ratingValues.forEach(function (ratingValue) {
        if (ratingValue.value !== 0) {
            let starContainer = ratingValue.parentElement;
            let starsNodeList = starContainer.querySelectorAll('.fa-star');
            let starsArray = Array.from(starsNodeList);
            let selectedStars = starsArray.slice(0, ratingValue.value);

            selectedStars.forEach(function (star) {
                star.classList.add('star-checked');
            });
        }
    });
}

window.onload = ratingLoad();
