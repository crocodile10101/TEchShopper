const spinnerWrapperEl = document.querySelector('.spinner-wrapper');


window.addEventListener('load', () => {
    spinnerWrapperEl.style.opacity = '0';

setTimeout(() => {
    spinnerWrapperEl.style.display = 'none';
}, 2000);
});

