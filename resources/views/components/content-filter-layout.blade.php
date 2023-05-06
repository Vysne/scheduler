<div class="filter-container">
    @guest
        <form action="{{ route('/') }}" method="GET" id="filtersForm">
    @endguest
    @auth
        <form action="{{ route('courses') }}" method="GET" id="filtersForm">
    @endauth
        <ul class="filter-box">
            <li>
                <div class="dropdown" id="course-type">
                    <input type="text" readonly placeholder="Select type" value="" name="filters[courses-type]" onclick="dropdownActivate(this)">
                    <div class="option">
                        <div onclick="showSelected(this)" data-set="default">Select type</div>
                        <div onclick="showSelected(this)">Economy and Finances</div>
                        <div onclick="showSelected(this)">Health</div>
                        <div onclick="showSelected(this)">Arts and Humanities</div>
                        <div onclick="showSelected(this)">Computer Science</div>
                        <div onclick="showSelected(this)">Physics and Engineering</div>
                        <div onclick="showSelected(this)">Math and Logic</div>
                        <div onclick="showSelected(this)">Business</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown" id="course-date">
                    <input type="text" readonly placeholder="Select date" value="" name="filters[courses-date]" onclick="dropdownActivate(this)">
                    <div class="option">
                        <div onmouseover="showSelected(this)" data-set="default">Select date</div>
                        <div onmouseover="showSelected(this)">Date 1</div>
                        <div onmouseover="showSelected(this)">Date 2</div>
                        <div onmouseover="showSelected(this)">Date 3</div>
                        <div onmouseover="showSelected(this)">Date 4</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown" id="course-rating">
                    <input type="text" readonly placeholder="Select rating" value="" name="filters[courses-rating]" onclick="dropdownActivate(this)">
                    <div class="option">
                        <div onmouseover="showSelected(this)" data-set="default">Select rating</div>
                        <div onmouseover="showSelected(this)">Rating 1</div>
                        <div onmouseover="showSelected(this)">Rating 2</div>
                        <div onmouseover="showSelected(this)">Rating 3</div>
                        <div onmouseover="showSelected(this)">Rating 4</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown" id="course-enlistment">
                    <input type="text" readonly placeholder="Select enlistments" value="" name="filters[courses-enlistment]" onclick="dropdownActivate(this)">
                    <div class="option">
                        <div onmouseover="showSelected(this)" data-set="default">Select enlistments</div>
                        <div onmouseover="showSelected(this)">Enlistments 1</div>
                        <div onmouseover="showSelected(this)">Enlistments 2</div>
                        <div onmouseover="showSelected(this)">Enlistments 3</div>
                        <div onmouseover="showSelected(this)">Enlistments 4</div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="filter-submit">
            <div class="filter-buttons-wrap">
                <button type="submit" name="">
                    <span>Filter</span>
                </button>
                <button type="reset">
                    <span>Clear</span>
                </button>
            </div>
        </div>
    </form>
</div>
{{--TODO MOVE JS TO filter.js somehow--}}
<script>
    function dropdownActivate(selectedDropdown)
    {
        let dropdown = selectedDropdown.parentElement;
        dropdown.onclick = function () {
            dropdown.classList.toggle('active');
        }
    }
    function showSelected(option)
    {
        let inputElem = option.parentElement.previousElementSibling;
        console.log(option.dataset['set']);
        if (!option.dataset['set']) {
            inputElem.value = option.innerText;
        } else {
            inputElem.value = '';
            inputElem.setAttribute('placeholder', option.innerText);
        }
    }
</script>
