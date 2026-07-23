// Admin Panel Interactive Scripts
document.addEventListener('DOMContentLoaded', () => {
    // Delete Confirmation
    const deleteForms = document.querySelectorAll('.form-confirm-delete');
    deleteForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Bu kaydı silmek istediğinize emin misiniz? Bu işlem geri alınamaz.')) {
                e.preventDefault();
            }
        });
    });

    // Admin Mobile Sidebar Hamburger Drawer Toggle
    const navToggle = document.getElementById('adminMobileNavToggle');
    const sidebarClose = document.getElementById('adminSidebarClose');
    const sidebar = document.getElementById('adminSidebar');
    const backdrop = document.getElementById('adminSidebarBackdrop');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('show');
        if (backdrop) backdrop.classList.add('show');
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('show');
        if (backdrop) backdrop.classList.remove('show');
    }

    if (navToggle) navToggle.addEventListener('click', openSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (backdrop) backdrop.addEventListener('click', closeSidebar);
});
