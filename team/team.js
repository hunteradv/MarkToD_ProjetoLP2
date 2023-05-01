const openModalButton = document.querySelector("#open-modal");
const closeModalButton = document.querySelector("#close-modal");
const modal = document.querySelector("#modal");
const fade = document.querySelector("#fade");
const clooseModalEditButton = document.querySelector("#close-modal-edit");
const modalEdit = document.querySelector("#modal-edit");
let taskSelectedToEdit = null;

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

const validateTask = function() {
    const title = document.querySelector("#taskname").value;
    const obs = document.querySelector("#task-obs-to-create").value;
    const dueDate = document.querySelector("#task-dateval-to-create").value;
    const category = document.querySelector("#task-category-to-create").value;
    const status = document.querySelector("#task-status-to-create").value;
    const teamId = document.querySelector("#task-team-id").value;

    let nameValidated = validateName(title);

    if (!nameValidated)
        return;

   
    $.ajax({
        method: "POST",
        url: "../task/createTask.php",
        data: { title: title, obs: obs, dueDate: dueDate, category: category, status: status, teamId: teamId},
        success: function(response) {
            if (response === "true"){
                toggleModal(modal);
                alertConfirm("Tarefa cadastrada com sucesso!");
            }
            else {
                toggleModal(modal);
                alertConfirm("Erro ao cadastrar tarefa");
            }
        }
    });

}

const openModalEdit = function (id) {
    toggleModalEdit(modalEdit);
    taskSelectedToEdit = id;

    
}

const validateName = function (name) {
    if (name == null || name == undefined || name == ""){
        document.querySelector("#nameValidated").textContent = "Titulo da tarefa obrigatorio";
        return false;
    }

    return true;
}



const validateTaskToUpdate = function () {
    const title = document.querySelector("#task-name-to-update").value;
    const obs = document.querySelector("#task-obs-to-update").value;

    let nameValidated = validateName(title);

    if (!nameValidated)
        return;

    let id = taskSelectedToEdit;
    $.ajax({
        method: "GET",
        url: "../task/checkTaskStatus.php",
        data: { taskId : id },
        success: function(status) {
            if (status === "2") {
                alertError("Não é possível atualizar uma tarefa concluída.");
                return;
            } else {
    $.ajax({    
        method: "POST",
        url: "../task/updateTask.php",
        data: { taskId : id, title: title, obs: obs},
        success: function() {           
            toggleModalEdit(modalEdit);            
            alertConfirm("Tarefa atualizada com sucesso!");                
        }
    });
    }
}
});
}

const deleteTask = function(taskId) {
    $.ajax({
        method: "GET",
        url: "../task/checkTaskStatus.php",
        data: { taskId : taskId },
        success: function(status) {
            if (status == 2) {
                alert("Não é possível excluir uma tarefa finalizada.");
                return;
            } else {
                $.ajax({
                    method: "POST",
                    url: "../task/deleteTask.php",
                    data: { taskId : taskId },
                    success: function() {
                        alertConfirm("Tarefa deletada!");
                    }
                });
            }
        }
    });
}

const validateTaskToFinish = function () {
    let id = taskSelectedToEdit;

    $.ajax({
        method: "POST",
        url: "../task/finishTask.php",
        data: { taskId : id},
        success: function() {           
            toggleModalEdit(modalEdit);            
            alertConfirm("Tarefa Finalizada!");                
        }
    });
}

const createTaskCategorie = function() {    
    window.location.href = '../task/taskCategoryList.php';
}



