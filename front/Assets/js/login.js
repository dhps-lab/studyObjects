
document.addEventListener('DOMContentLoaded', function () {
    var dataFormLogIn = document.querySelector("#formLogIn");

    dataFormLogIn.onsubmit = function (e) {
        e.preventDefault();
        var strUser = document.querySelector("#user").value;
        var strPass = document.querySelector("#password").value;
        if (strUser == "" || strPass == "") {
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        logInSubmit(dataFormLogIn, '#LogInModal', formLogIn);
    }
    if (!localStorage.getItem('token')){
        $('#navbarDropdownMenuLinkLi').hide();
        document.getElementById('loginButton').innerHTML = 'Iniciar Sesión';
    }else{
        document.getElementById('loginButton').innerHTML = 'Cerrar Sesión';
    }
});
/*var modifingModules = document.getElementById('navbarDropdownMenuLinkLi');
modifingModules.addEventListener('DOMContentLoaded', function(){
    console.log('Token: ',localStorage.getItem('token'));
    if (!localStorage.getItem('token')){
        modifingModules.style.display   = 'none';
    }
})*/
function logInSubmit(dataFormLogin, modalName, formModal) {
    if (!dataFormLogin.user || !dataFormLogin.password) {
        let msg = "Hubo un error con el usuario y la contraseña.";
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
                swal("Inicio de Sesión exitoso!", objData.msg, "success")
                .then(function(e) {
                    window.location.reload();
                });
                localStorage.setItem('token', objData.token);
                $(modalName).modal("hide");
            } else {
                swal("Error", objData.msg, "error");
            }
            formModal.reset();
        }
    }
}

function loginModal() {
    let loginButton = document.getElementById('loginButton').textContent;
    if(loginButton.includes("Cerrar")){
        logOut();
    }else
    $('#LogInModal').modal('show');
}

function logOut(){
    swal("Atención", "Deseas cerrar sesión?", "warning")
    .then(function(e){
        if(e){
            localStorage.removeItem('token');
            window.location.reload();
        }
    });
}