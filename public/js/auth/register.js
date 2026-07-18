let form = document.getElementById("formReg");

form.addEventListener("submit", function (e) {

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let pass = document.getElementById("pass").value.trim();
    let passC = document.getElementById("passC").value.trim();
    if (
    name === "" ||
    email === "" ||
    pass === "" ||
    passC === ""
    ) {
        alert("Please fill in all fields.");
        e.preventDefault();
        return;
    }
    if(pass !== passC){
        alert("The password doesn't match");
        e.preventDefault();
        return ;
    }
    
});