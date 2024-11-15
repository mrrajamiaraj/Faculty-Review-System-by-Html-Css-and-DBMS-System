function setupRatingBox(ratingBox, tooltipId) {
    const tooltip = document.getElementById(tooltipId);

    ratingBox.addEventListener('mouseover', function(event) {
        if (event.target.dataset.tooltip) {
            tooltip.innerText = event.target.dataset.tooltip;
            tooltip.style.display = 'block';
        }
    });

    ratingBox.addEventListener('mouseout', function() {
        tooltip.style.display = 'none';
    });

    ratingBox.addEventListener('click', function(event) {
        if (event.target.dataset.value) {
            // Clear previous selections and colors
            ratingBox.querySelectorAll('div').forEach(div => {
                div.classList.remove('selected', 'red', 'blue', 'yellow', 'lightgreen', 'green');
            });

            // Highlight selected rating and apply specific color
            event.target.classList.add('selected');

            switch (event.target.dataset.value) {
                case '1':
                    event.target.classList.add('red');
                    break;
                case '2':
                    event.target.classList.add('blue');
                    break;
                case '3':
                    event.target.classList.add('yellow');
                    break;
                case '4':
                    event.target.classList.add('lightgreen');
                    break;
                case '5':
                    event.target.classList.add('green');
                    break;
            }
        }
    });
}

// Initialize each rating box with its tooltip
setupRatingBox(document.getElementById('professorRating'), 'professorTooltip');
setupRatingBox(document.getElementById('gradingBox'), 'gradingTooltip');
setupRatingBox(document.getElementById('learningBox'), 'learningTooltip');
