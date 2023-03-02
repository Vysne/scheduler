<div class="filter-container">
    <ul class="filter-box">
        <li>
            <div class="dropdown" id="course-type">
                <input type="text" readonly placeholder="Select type" onclick="dropdownActivate(this)">
                <div class="option">
                    <div onmouseover="showSelected(this)">Select type</div>
                    <div onmouseover="showSelected(this)">Type 1</div>
                    <div onmouseover="showSelected(this)">Type 2</div>
                    <div onmouseover="showSelected(this)">Type 3</div>
                    <div onmouseover="showSelected(this)">Type 4</div>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown" id="course-rating">
                <input type="text" readonly placeholder="Select date" onclick="dropdownActivate(this)">
                <div class="option">
                    <div onmouseover="showSelected(this)">Select date</div>
                    <div onmouseover="showSelected(this)">Date 1</div>
                    <div onmouseover="showSelected(this)">Date 2</div>
                    <div onmouseover="showSelected(this)">Date 3</div>
                    <div onmouseover="showSelected(this)">Date 4</div>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <input type="text" readonly placeholder="Select rating" onclick="dropdownActivate(this)">
                <div class="option">
                    <div onmouseover="showSelected(this)">Select rating</div>
                    <div onmouseover="showSelected(this)">Rating 1</div>
                    <div onmouseover="showSelected(this)">Rating 2</div>
                    <div onmouseover="showSelected(this)">Rating 3</div>
                    <div onmouseover="showSelected(this)">Rating 4</div>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <input type="text" readonly placeholder="Select enlistments" onclick="dropdownActivate(this)">
                <div class="option">
                    <div onmouseover="showSelected(this)">Select enlistments</div>
                    <div onmouseover="showSelected(this)">Enlistments 1</div>
                    <div onmouseover="showSelected(this)">Enlistments 2</div>
                    <div onmouseover="showSelected(this)">Enlistments 3</div>
                    <div onmouseover="showSelected(this)">Enlistments 4</div>
                </div>
            </div>
        </li>
    </ul>
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
        inputElem.value = option.innerText;
    }
</script>
