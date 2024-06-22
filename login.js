document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');

    if (successParam === '1') {
        alert('Registration successful! Please login with your new credentials.');
    }
});
