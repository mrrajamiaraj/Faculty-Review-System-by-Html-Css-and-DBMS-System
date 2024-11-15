function learnMore() {
    document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
}

window.addEventListener('load', () => {
    const ratingBars = document.querySelectorAll('.rating-fill');

    ratingBars.forEach(bar => {
        const rating = parseFloat(bar.getAttribute('data-rating'));
        const widthPercentage = (rating / 5) * 100;
        bar.style.width = `${widthPercentage}%`;
    });
});
