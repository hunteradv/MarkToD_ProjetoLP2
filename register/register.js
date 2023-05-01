validateRegister = function() {
    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;    
    
    if (name === null || name === ""){
        document.querySelector("#nameValidated").textContent = "Nome é obrigatório";
        return false;
    }
    else {
        document.querySelector("#nameValidated").textContent = "";
    }

    const emailValidated = validateEmail(email);
    if (!emailValidated)
        return;    

    const passwordValidated = validatePassword(password);
    if (!passwordValidated)
        return;

    const passwordConfirmValidated = validatePassowordConfirm();
    if (!passwordConfirmValidated)
        return;

    
    $.ajax({
        method: "POST",
        url: "doRegister.php",
        data: { name: name, email: email, password: password },
        success: function(response) {            
            if (response === "Duplicated e-mail"){
                alertConfirm("Já existe um usuário com este e-mail");
            }

            if (response === "Duplicated password"){
                alertConfirm("Já existe um usuário com esta senha");
            }

            if (response === "true"){
                Swal.fire({
                    title: 'Usuário cadastrado com sucesso!',
                    confirmButtonColor: '#3ac5f0'
                }).then(() => {
                    location.href = "../login/login.php";
                });
            }
            
            if (response === "false"){
                alertConfirm("Houve um erro para cadastrar o usuário!");
            }
        }
    });
}

validatePassword = function(password) {
    const confirmPassword = document.querySelector("#passwordConfirm").value;


    if (password === null || password === ""){
        document.querySelector("#passwordValidated").textContent = "Senha é obrigatória";
        return false;
    }
    else {
        if (confirmPassword === "" || confirmPassword === undefined){
            document.querySelector("#passwordValidated").textContent = "";
            return true;
        }

        if(password !== confirmPassword){
            alertConfirm("As senhas são diferentes!");         
        }
        else {
            return true;
        }            
    }    
}

validateEmail = function(email) {    
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

validatePassowordConfirm = function() {
    const confirmPassword = document.querySelector("#passwordConfirm").value;

    if (confirmPassword === null || confirmPassword === ""){
        document.querySelector("#passwordConfirmValidated").textContent = "Confirmação de senha é obrigatória";
        return false;
    }
    
    document.querySelector("#passwordConfirmValidated").textContent = "";
    return true;
     
}

alertConfirm = function(text) {
    Swal.fire({
        title: text,
        confirmButtonColor: '#3ac5f0'
    })
}