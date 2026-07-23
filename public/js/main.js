// Front-End Interactive Scripts for Miraç Su Tesisatı
document.addEventListener('DOMContentLoaded', () => {
    // Quick booking service pre-select
    const bookingButtons = document.querySelectorAll('.trigger-booking-modal');
    const serviceSelectInput = document.getElementById('modalServiceSelect');
    
    bookingButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const serviceTitle = btn.getAttribute('data-service-title');
            if (serviceTitle && serviceSelectInput) {
                serviceSelectInput.value = serviceTitle;
            }
        });
    });

    // Auto-dismiss alert messages after 5 seconds
    const alerts = document.querySelectorAll('.alert-auto-dismiss');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        }, 5000);
    });

    // Front-End Mobile Nav Drawer Toggle
    const frontNavToggle = document.getElementById('mobileNavToggle');
    const frontNavDrawer = document.getElementById('mobileNavDrawer');
    const frontNavBackdrop = document.getElementById('mobileNavBackdrop');

    if (frontNavToggle && frontNavDrawer && frontNavBackdrop) {
        frontNavToggle.addEventListener('click', (e) => {
            e.preventDefault();
            frontNavDrawer.classList.add('show');
            frontNavBackdrop.classList.add('show');
        });
        frontNavBackdrop.addEventListener('click', () => {
            frontNavDrawer.classList.remove('show');
            frontNavBackdrop.classList.remove('show');
        });
    }

    // Gallery Category Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');
            galleryItems.forEach(item => {
                const itemCat = item.getAttribute('data-category');
                if (filterValue === 'all' || itemCat === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Gallery Lightbox Modal Handler
    const lightboxButtons = document.querySelectorAll('.open-lightbox');
    const lightboxModalEl = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDesc = document.getElementById('lightboxDesc');

    if (lightboxModalEl && lightboxButtons.length > 0) {
        const bsLightboxModal = new bootstrap.Modal(lightboxModalEl);
        lightboxButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const imgUrl = btn.getAttribute('data-img');
                const title = btn.getAttribute('data-title');
                const desc = btn.getAttribute('data-desc');

                if (lightboxImg) lightboxImg.src = imgUrl;
                if (lightboxTitle) lightboxTitle.textContent = title;
                if (lightboxDesc) lightboxDesc.textContent = desc;

                bsLightboxModal.show();
            });
        });
    }

    // Services Category Filter
    const serviceFilterBtns = document.querySelectorAll('.service-filter-btn');
    const serviceItems = document.querySelectorAll('.service-item');

    serviceFilterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            serviceFilterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');
            serviceItems.forEach(item => {
                const itemCat = item.getAttribute('data-category');
                if (filterValue === 'all' || itemCat === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
