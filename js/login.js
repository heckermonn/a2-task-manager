document.addEventListener('DOMContentLoaded', function() {
    // Get reference to the login form
    const loginForm = document.getElementById('loginForm');

    // Add event listener for form submission
    loginForm.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Validate user ID input
        const userIdInput = document.getElementById('userid');
        const passwordInput = document.getElementById('password');

        // Trim whitespace from inputs
        const userId = userIdInput.value.trim();
        const password = passwordInput.value.trim();

        // Validate user ID
        if (userId.length === 0) {
            alert('Please enter a User ID');
            userIdInput.focus();
            return;
        }

        // Validate password
        if (password.length === 0) {
            alert('Please enter a password');
            passwordInput.focus();
            return;
        }

        // Basic client-side validation checks
        // TODO: add more complex validation as needed
        if (userId.length < 3) {
            alert('User ID must be at least 3 characters long');
            userIdInput.focus();
            return;
        }

        if (password.length < 6) {
            alert('Password must be at least 6 characters long');
            passwordInput.focus();
            return;
        }

        // If all validations pass, submit the form
        // The form will be sent to login.php for server-side authentication
        loginForm.submit();
    });
});