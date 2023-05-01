const doLogout = function() {
    $.ajax({
        method: "POST",
        url: "../doLogout.php",
        success: function(response) {
            if (response === "true")
                window.location.href = "../login/login.php";
            else {
                alertConfirm("Houve um problema para realizar o logout");
            }            
        }
    })
}

alertConfirm = function(text) {
    Swal.fire({
        title: text,
        confirmButtonColor: '#3ac5f0'
    }).then(function() {
        window.location.reload();
    })
}