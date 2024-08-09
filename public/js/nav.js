document.addEventListener('DOMContentLoaded', function() {
    const menu = document.getElementById('navLLMenu');
    const overlay = document.getElementById('navLLOverlay');
    const toggle = document.getElementById('navLLToggle');

    // 關閉彈出視窗
    function toggleMenu() {
        menu.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    toggle.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleMenu();
    });

    overlay.addEventListener('click', toggleMenu);

    document.addEventListener('click', function(event) {
        if (menu.classList.contains('active') && 
            !menu.contains(event.target) && 
            !toggle.contains(event.target)) {
            toggleMenu();
        }
    });

    menu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});