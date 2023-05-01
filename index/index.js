const logout = function() {
    window.location.href = "../login/login.php";
}

const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const clooseModalEditButton = document.querySelector("#close-modal-edit");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");
const modalEdit = document.querySelector("#modal-edit");
let environmentSelectedToEdit = null;

const toggleModal = () => {
    [modal, fade].forEach((el) => el.classList.toggle("hide"));    
}

const toggleModalEdit = () => {
    [modalEdit, fade].forEach((el) => el.classList.toggle("hide"));    
}

[openModalButton, closeModalButton, fade].forEach((el) => {
    el.addEventListener("click", () => toggleModal(modal));
});

clooseModalEditButton.addEventListener("click", () => toggleModalEdit(modalEdit));

const validateEnvironment = function() {
    const name = document.querySelector("#env-name-to-create").value;
    let nameValidated = validateName(name);

    if (!nameValidated)
        return

    $.ajax({
        method: "POST",
        url: "../environment/createEnvironment.php",
        data: { name: name },
        success: function(response) {
            if (response === "true"){
                toggleModal(modal);
                alertConfirm("Ambiente cadastrado com sucesso!");
            }
            else {
                toggleModal(modal);
                alertConfirm("Houve um problema para cadastrar um novo ambiente");
            }
        }
    });
}

const deleteEnvironment = function(id) {    
    $.ajax({
        method: "POST",
        url: "../environment/deleteEnvironment.php",
        data: { environmentId : id },
        success: function() {            
            alertConfirm("Ambiente deletado com sucesso!");            
        }
    });
}

const openModalEdit = function (id) {
    toggleModalEdit(modalEdit);
    environmentSelectedToEdit = id;
}

const validateEnvironmentToUpdate = function () {
    const name = document.querySelector("#env-name-to-update").value;
    let nameValidated = validateName(name);

    if (!nameValidated)
        return;

    let id = environmentSelectedToEdit;

    $.ajax({
        method: "POST",
        url: "../environment/updateEnvironment.php",
        data: { environmentId : id, name: name },
        success: function() {            
            toggleModalEdit(modalEdit);            
            alertConfirm("Ambiente atualizado com sucesso!");             
        }
    });
}

const validateName = function (name) {
    if (name == null || name == undefined || name == ""){
        document.querySelector("#nameValidated").textContent = "Nome do ambiente é obrigatório";
        return false;
    }

    return true;
}