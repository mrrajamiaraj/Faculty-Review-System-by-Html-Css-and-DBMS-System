
function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const message = document.getElementById("message");

    if (password !== confirmPassword) {
        message.style.display = "block";
        return false; // Prevent form submission
    } else {
        message.style.display = "none";
        return true; // Allow form submission
    }
}