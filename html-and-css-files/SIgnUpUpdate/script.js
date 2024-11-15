// Function to toggle between Student, Teacher, and Admin forms
function showForm(formId) {
    document.querySelectorAll('.form-content').forEach(form => form.classList.remove('active'));
    document.getElementById(formId).classList.add('active');
}

// Password validation function
function validatePassword(passwordId, confirmPasswordId) {
    const password = document.getElementById(passwordId).value;
    const confirmPassword = document.getElementById(confirmPasswordId).value;
    const message = passwordId === 'studentPassword' ? document.getElementById("studentMessage") : document.getElementById("teacherMessage");

    if (password !== confirmPassword) {
        message.style.display = "block";
        return false;
    } else {
        message.style.display = "none";
        return true;
    }
}
