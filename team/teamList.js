const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");
const clooseModalEditButton = document.querySelector("#close-modal-edit");
const modalEdit = document.querySelector("#modal-edit");
let teamSelectedToEdit = null;

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

const validateTeam = function() {
    const name = document.querySelector("#team-name-to-create").value;
    const obs = document.querySelector("#obs-to-create").value;
    let nameValidated = validateName(name);

    if (!nameValidated)
        return;
    
    $.ajax({
        method: "POST",
        url: "../team/createTeam.php",
        data: { name: name, obs: obs },
        success: function(response) {
            if (response === "true"){
                toggleModal(modal);
                alertConfirm("Equipe cadastrada com sucesso!");
            }
            else {
                toggleModal(modal);
                alertConfirm("Houve um problema para cadastrar uma nova equipe");
            }
        }
    });
}

const validateName = function (name) {
    if (name == null || name == undefined || name == ""){
        document.querySelector("#nameValidated").textContent = "Nome da equipe é obrigatório";
        return false;
    }

    return true;
}

const openModalEdit = function (id) {
    toggleModalEdit(modalEdit);
    teamSelectedToEdit = id;
}

const validateTeamToUpdate = function () {
    const name = document.querySelector("#team-name-to-update").value;
    const obs = document.querySelector("#team-obs-to-update").value;
    let nameValidated = validateName(name);

    if (!nameValidated)
        return;

    let id = teamSelectedToEdit;

    $.ajax({
        method: "POST",
        url: "../team/updateTeam.php",
        data: { teamId : id, name: name, obs: obs },
        success: function() {            
            toggleModalEdit(modalEdit);            
            alertConfirm("Equipe atualizada com sucesso!");             
        }
    });
}

const deleteTeam = function(id) {    
    $.ajax({
        method: "POST",
        url: "../team/deleteTeam.php",
        data: { teamId : id },
        success: function() {            
            alertConfirm("Equipe deletada com sucesso!");            
        }
    });
}

const listUsers = function() {    
    window.location.href = '../users/userList.php';
}
