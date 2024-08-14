document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.links a');
    const forms = document.querySelectorAll('.outdiv');

    links.forEach(link => {
        link.addEventListener('click', function (event) {
            if (this.id === 'forgotPasswordLink') {
                // 不阻止默認行為，允許導航到新頁面
                return;
            }

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