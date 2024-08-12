document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.links a');
    const forms = document.querySelectorAll('.outdiv');

    // 
    links.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const formIdToShow = this.getAttribute('data-show-form');

            forms.forEach(form => {
                if (form.id === formIdToShow) {
                    form.classList.remove('d-none');
                } else {
                    form.classList.add('d-none');
                }
            });
        });
    });
});