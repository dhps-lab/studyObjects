function test(num){
    $.ajax({
        url: 'Controllers/LRController.php',
        type: 'GET',
        data: { num },
        success: function(response) {
            console.log(response);
        }
    })
    
}


document.addEventListener('DOMContentLoaded', function () {
    var dataFormLogIn = document.querySelector("#formLogIn");

    dataFormLogIn.onsubmit = function (e) {
        e.preventDefault();
        var strUser = document.querySelector("#user").value;
        var strPass = document.querySelector("#password").value;
        console.log("User: " + strUser + " Pass: " + strPass);
        if (strUser == "" || strPass == "") {
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        logInSubmit(dataFormLogIn, '#LogInModal', formLogIn);
    }
});
function logInSubmit(dataFormLogin, modalName, formModal) {
    if (!dataFormLogin.user || !dataFormLogin.password) {
        let msg = "Hubo un error con el usuario y la contraseña.";
        console.log(msg);
        return msg;
    }
    // Validate with regexp user and password
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back + '/LogIn/validatePassword';
    let formData = new FormData(dataFormLogin);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                swal("Inicio de Sesión exitoso!", objData.msg, "success");
                $(modalName).modal("hide");
            } else {
                swal("Error", objData.msg, "error");
            }
            formModal.reset();
        }
    }
}

function loginModal() {
    $('#LogInModal').modal('show');
}