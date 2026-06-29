import './bootstrap';
import './search';

/*
|--------------------------------------------------------------------------
| Exam Seat Management System
| Global UI Script
|--------------------------------------------------------------------------
| Handles:
| - Mobile sidebar
| - User dropdown
| - Auto dismiss alerts
| - Table search
| - Confirm delete
| - Loading buttons
| - Helper utilities
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {

    /* ============================================================
       MOBILE SIDEBAR
    ============================================================ */

    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        if (!sidebar) return;

        sidebar.classList.remove('-translate-x-full');

        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('hidden');
        }
    }

    function closeSidebar() {
        if (!sidebar) return;

        sidebar.classList.add('-translate-x-full');

        if (sidebarOverlay) {
            sidebarOverlay.classList.add('hidden');
        }
    }

    sidebarToggle?.addEventListener('click', openSidebar);

    sidebarClose?.addEventListener('click', closeSidebar);

    sidebarOverlay?.addEventListener('click', closeSidebar);

    window.addEventListener('resize', () => {

        if (window.innerWidth >= 1024) {

            sidebar?.classList.remove('-translate-x-full');

            sidebarOverlay?.classList.add('hidden');

        } else {

            sidebar?.classList.add('-translate-x-full');

        }

    });

    /* ============================================================
       USER DROPDOWN
    ============================================================ */

    const profileButton = document.getElementById('profileButton');
    const profileMenu = document.getElementById('profileMenu');

    profileButton?.addEventListener('click', (e) => {

        e.stopPropagation();

        profileMenu?.classList.toggle('hidden');

    });

    document.addEventListener('click', () => {

        profileMenu?.classList.add('hidden');

    });

    /* ============================================================
       AUTO DISMISS ALERTS
    ============================================================ */

    const alerts = document.querySelectorAll('.auto-dismiss');

    alerts.forEach(alert => {

        setTimeout(() => {

            alert.classList.add('opacity-0');

            setTimeout(() => {

                alert.remove();

            }, 300);

        }, 3500);

    });

    /* ============================================================
       LOADING BUTTONS
    ============================================================ */
    
    document.querySelectorAll('form').forEach(form => {

        form.addEventListener('submit', function () {

            const button = form.querySelector('.loading-btn');

            if (!button) return;

            button.disabled = true;

            button.innerHTML = `
                <span class="animate-spin mr-2">⏳</span>
                Processing...
            `;

        });

    });


    /* ============================================================
       DELETE CONFIRMATION
    ============================================================ */

    document.querySelectorAll('.confirm-delete').forEach(button => {

        button.addEventListener('click', function (e) {

            if (!confirm('Are you sure you want to delete this record?')) {

                e.preventDefault();

            }

        });

    });

    /* ============================================================
       TABLE SEARCH
    ============================================================ */

    const searchInput = document.getElementById('tableSearch');

    if (searchInput) {

        searchInput.addEventListener('keyup', function () {

            const keyword = this.value.toLowerCase();

            document.querySelectorAll('tbody tr').forEach(row => {

                row.style.display =
                    row.innerText.toLowerCase().includes(keyword)
                        ? ''
                        : 'none';

            });

        });

    }

    /* ============================================================
       CURRENT YEAR
    ============================================================ */

    const currentYear = document.getElementById('currentYear');

    if (currentYear) {

        currentYear.textContent = new Date().getFullYear();

    }

});

/* ================================================================
   GLOBAL HELPERS
================================================================ */

window.showToast = function (message) {

    alert(message);

};

window.formatDate = function (date) {

    return new Date(date).toLocaleDateString();

};