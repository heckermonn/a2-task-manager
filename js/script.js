//Hamurger animation Activation
document.addEventListener("DOMContentLoaded", function() {
    var navState = document.getElementById("nav-icon");
    navState.addEventListener("click", function() {
        this.classList.toggle("open");
    });
});

    var i = 0;
    var txtTitle = 'welcome to task manager.'; /* The text */
    var speed = 75; /* The speed/duration of the effect in milliseconds */

    function typeWriter() {
    if (i < txtTitle.length) {
        document.getElementById("title").innerHTML += txtTitle.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    }
    }  
 
 // Toggle Mobile Menu
 function toggleMobileMenu() {
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.toggle('responsive');
}

// Toggle Notifications Dropdown
function toggleNotifications() {
    const dropdown = document.getElementById('notificationsDropdown');
    const badge = document.getElementById('notificationBadge');
    
    // Toggle dropdown visibility
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    
    // Hide badge when dropdown is opened
    if (dropdown.style.display === 'block') {
        badge.style.display = 'none';
    }
}

// Function Placeholders for Button Actions
function addTask() {
    alert('Add Task functionality will be implemented');
}

function searchAndFilter() {
    alert('Search and Filter functionality will be implemented');
}

// Close dropdown if clicked outside
window.onclick = function(event) {
    const dropdown = document.getElementById('notificationsDropdown');
    const notificationContainer = document.querySelector('.notification-container');

    // Close notifications if clicked outside
    if (!notificationContainer.contains(event.target)) {
        dropdown.style.display = 'none';
    }

    // Close mobile menu logic remains the same
    if (!event.target.matches('#nav-icon') && !event.target.closest('#mobileMenu')) {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.remove('active');
    }
}

// Simulate incoming notifications (for demonstration)
function simulateNotifications() {
    const badge = document.getElementById('notificationBadge');
    badge.style.display = 'flex';
}

// Call this to show notification badge
simulateNotifications();