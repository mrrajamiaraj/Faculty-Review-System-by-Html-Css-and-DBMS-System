function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const message = document.getElementById("message");

    if (password !== confirmPassword) {
        message.style.display = "block";
        return false; 
    } else {
        message.style.display = "none";
        return true; 
    }
}


function toggleToLogin() {
    document.getElementById("chk").checked = true;
}


function toggleToSignUp() {
    document.getElementById("chk").checked = false;
}
