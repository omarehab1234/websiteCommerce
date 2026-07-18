let form = document.getElementById("loginForm");

form.addEventListener("submit", function (e) {

    let email = document.getElementById("email").value.trim();
    let pass = document.getElementById("pass").value.trim();
    if (
    email === "" ||
    pass === "" 
    ) {
        alert("Please fill in all fields.");
        e.preventDefault();
        return;
    }
    
    
});