document.getElementById("password").addEventListener("keyup", validatePassword);

function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const message = document.getElementById("message");

    if (password === confirmPassword) {
        message.innerHTML = "Passwords match";
        message.style.color = "green";
    } else {
        message.innerHTML = "Passwords do not match";
        message.style.color = "red";
    }
}
