/**
 * Sidebar: sliding pill active indicator + toggle thu gon
 */
document.addEventListener('DOMContentLoaded', function () {
    const sidebar     = document.getElementById('sidebar');
    const toggleBtn   = document.getElementById('sidebarToggle');
    const toggleIcon  = document.getElementById('toggleIcon');
    const mainContent = document.querySelector('.main-content');
    const navMenu     = document.getElementById('navMenu');
    const slider      = document.getElementById('nav-slider');

    // ===== SLIDING PILL =====
    function moveSlider(link) {
        if (!slider || !navMenu || !link) return;
        const navRect  = navMenu.getBoundingClientRect();
        const linkRect = link.getBoundingClientRect();
        slider.style.top    = (linkRect.top - navRect.top) + 'px';
        slider.style.height = linkRect.height + 'px';
        slider.style.opacity = '1';
    }

    // Vi tri ban dau (trang hien tai)
    const activeLink = navMenu ? navMenu.querySelector('.nav-link.active') : null;
    if (activeLink) {
        // Dat ngay khong co animation khi vua load
        slider.style.transition = 'none';
        moveSlider(activeLink);
        requestAnimationFrame(() => {
            slider.style.transition = '';
        });
    }

    // Di chuyen khi click
    if (navMenu) {
        navMenu.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('mousedown', function () {
                moveSlider(this);
                // Cap nhat class active gia lap ngay lap tuc
                navMenu.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }

    // ===== SIDEBAR TOGGLE =====
    if (!sidebar || !toggleBtn) return;

    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        if (mainContent) mainContent.classList.add('sidebar-collapsed');
        toggleIcon.className = 'bi bi-layout-sidebar-reverse';
    }

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        const collapsed = sidebar.classList.contains('collapsed');
        if (mainContent) mainContent.classList.toggle('sidebar-collapsed', collapsed);
        toggleIcon.className = collapsed
            ? 'bi bi-layout-sidebar-reverse'
            : 'bi bi-layout-sidebar';
        localStorage.setItem('sidebarCollapsed', collapsed);
        // Cap nhat vi tri slider sau khi sidebar thay doi kich thuoc
        setTimeout(() => {
            const active = navMenu ? navMenu.querySelector('.nav-link.active') : null;
            if (active) moveSlider(active);
        }, 260);
    });
});
