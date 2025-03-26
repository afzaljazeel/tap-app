function togglePassword() {
    const passwordField = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    const isVisible = passwordField.type === "text";

    // Toggle password field type
    passwordField.type = isVisible ? "password" : "text";

    // Toggle image
    icon.src = isVisible 
        ? "/img/eye.svg" 
        : "/img/eye_open.png";

    // Toggle class for different size/position
    icon.classList.toggle("eye-closed", isVisible);
    icon.classList.toggle("eye-open", !isVisible);
}
