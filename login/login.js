const validateLogin = function () {
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    
    const emailValidated = validateEmail(email);
    if (!emailValidated)
        return;        

    const passwordValidated = validatePassword(password);
    if (!passwordValidated)
        return;

    $.ajax({
        method: "POST",
        url: "doLogin.php",
        data: { email: email, password: password },
        success: function(response) {
            if (response === "true")
                window.location.href = '../index/index.php';             
            else 
            alertConfirm("Usuário não cadastrado na base de dados");
        }
    });

}

 const validateEmail = function (email) {    
    if (email == null || email == ""){
        document.querySelector("#emailValidated").textContent = "E-mail é obrigatório"
        return false;
    }
    else {
        document.querySelector("#emailValidated").textContent = "";

        let re = /\S+@\S+\.\S+/;
        let validated = re.test(email);

        if (!validated){
            document.querySelector("#emailValidated").textContent = "E-mail precisa ser válido"
            return validated;
        }
        
        return validated
    }
}

const validatePassword = function (password) {    
    if (password === null || password === ""){
        document.querySelector("#passwordValidated").textContent = "Senha é obrigatória";
        return false;
    }

    document.querySelector("#passwordValidated").textContent = "";
    return true;
}

const alertConfirm = function(text) {
    Swal.fire({
        title: text,
        confirmButtonColor: '#3ac5f0'
    })
}