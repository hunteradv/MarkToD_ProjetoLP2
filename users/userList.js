const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");
const closeModalEditButton = document.querySelector("#close-modal-edit");
const modalEdit = document.querySelector("#modal-edit");
let userSelectedToEdit = null;

const toggleModal = () => {
    [modal, fade].forEach((el) => el.classList.toggle("hide"));    
}

const toggleModalEdit = () => {
    [modalEdit, fade].forEach((el) => el.classList.toggle("hide"));    
}

[openModalButton, closeModalButton, fade].forEach((el) => {
    el.addEventListener("click", () => toggleModal(modal));
});

closeModalEditButton.addEventListener("click", () => toggleModalEdit(modalEdit));

const openModalEdit = function (id) {
    toggleModalEdit(modalEdit);
    userSelectedToEdit = id;
}

const selectUser = function(id) {
    let userId = id;

    $.ajax({
        method: "POST",
        url: "../users/linkUserToEnvironment.php",
        data: { userId: userId },
        success: function(response) {
            if (response === "true"){
                toggleModal(modal);
                alertConfirm("Usuário vinculado com sucesso!");
            }
            else {
                toggleModal(modal);
                alertConfirm("Houve um problema para cadastrar um novo usuário");
            }
        }
    });
}

const deleteUser = function(id) {
    let userId = id;

    $.ajax({
        method: "POST",
        url: "../users/deleteUser.php",
        data: { userId : userId },
        success: function() {            
            alertConfirm("Usuário desvinculado com sucesso!");            
        }
    });
}

const validateUserToUpdate = function() {
    let userId = userSelectedToEdit;
    let role = document.querySelector('#user-role-to-update').value;

    $.ajax({
        method: "POST",
        url: "../users/updateUser.php",
        data: { userId : userId, role: role },
        success: function(response) {            
            toggleModalEdit(modalEdit);
            alertConfirm("Usuário atualizado com sucesso!");
        }
    });
}
