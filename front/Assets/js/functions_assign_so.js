var assignStudyObjectTable;

document.addEventListener('DOMContentLoaded', function(){
    assignStudyObjectTable = $('#assignSOTable').DataTable({
        "aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_back+"/EditAssignStudyObject/getAssignStudyObject",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"study_object"},
            {"data":"teacher_firstname"},
            {"data":"teacher_lastname"},
            {"data":"subject"},
            {"data":"acciones"}
        ],
        dom: 'lBfrtip',
        buttons: [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-warning"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10
    });

    var dataFormAddAssignSO = document.querySelector("#formAddAssingStudyObject");
    var dataFormEditAssignSO = document.querySelector("#formEditAssingStudyObject");

    dataFormAddAssignSO.onsubmit = function(e){
        e.preventDefault();
        var intStudyObject = document.querySelector("#listStudyObject").value;
        var intTeacher = document.querySelector("#listTeacher").value;
        var intSubject = document.querySelector("#listSubject").value;
        if(intStudyObject == "" || intTeacher == "" || intSubject == ""){
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        postPutExecution('EditAssignStudyObject/postAssignStudyObject', dataFormAddAssignSO, '#addAssignStudyObjectModal', formAddAssingStudyObject);
    }

    dataFormEditAssignSO.onsubmit = function(e){
        e.preventDefault();
        var intCode = document.querySelector("#txtIDEdit").value;
        var intStudyObject = document.querySelector("#listEditStudyObject").value;
        var intTeacher = document.querySelector("#listEditTeacher").value;
        var intSubject = document.querySelector("#listEditSubject").value;
        if(intCode == "" || intStudyObject == "" || intTeacher == "" || intSubject == ""){
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        postPutExecution('EditAssignStudyObject/putAssignStudyObject/' + intCode, dataFormEditAssignSO, '#editAssignStudyObjectModal', formEditAssingStudyObject);
    }
});

function addAssingStudyObjectModal(){
    getSelect("StudyObject/getStudyObjectSelect", "#listStudyObject", 0);
    getSelect("Teacher/getTeacher", "#listTeacher", 0); 
    getSelect("Subject/getSubject", "#listSubject", 0);
    $('#addAssignStudyObjectModal').modal('show');
}

function editAssignStudyObjectModal(button){
    let idAssignStudyObject = button.getAttribute('alr');
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back+'EditAssignStudyObject/getAssignStudyObjectById/' + idAssignStudyObject;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#txtIDEdit").value = objData.msg.Id;
                getSelect("StudyObject/getStudyObjectSelect", "#listEditStudyObject", objData.msg.codigo_objetos_de_estudio);
                getSelect("Teacher/getTeacher", "#listEditTeacher", objData.msg.codigo_profesor);
                getSelect("Subject/getSubject", "#listEditSubject", objData.msg.codigo_espacio);
            } else {
                swal("Error", objData.msg, "error");
            }
        } 
    }

    $('#editAssignStudyObjectModal').modal('show');
}

function postPutExecution(url, dataFormASO, modalName, formModal){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back+url;
    let formData = new FormData(dataFormASO);
    request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    $(modalName).modal("hide");
                    formModal.reset();
                    swal("Asignación objetos de estudio", objData.msg, "success");
                    assignStudyObjectTable.ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
}

function deleteExecution(url){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back+url;
    request.open('POST', ajaxUrl, true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    swal("¡Eliminado!", objData.msg, "success");
                    assignStudyObjectTable.ajax.reload();
                } else {
                    swal("Cancelado", objData.msg, "error");
                }
            }
        }
}

function deleteAssignStudyObject(deleteButton){
    let code = deleteButton.getAttribute('alr');
    swal({
        title: "Eliminar asignación de objeto de estudio",
        text: "¿Realmente quiere eliminar la asignación?",
        icon: "warning",
        buttons: {
            cancel: "¡No, cancelar!",
            confirm: "¡Si, eliminar!",
          },
        closeOnconfirm: false
    }).then(result => {
        if(result){
            deleteExecution('EditAssignStudyObject/deleteAssignStudyObject/'+ code);
        } else {
            swal("Cancelado", "El objeto de estudio esta ha salvo", "error");
        }
        
    });
}

function getSelect(url, selector, code){
    let ajaxUrl = base_back+url;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector(selector).innerHTML = request.responseText;
            if(code != 0){
                document.querySelector(selector).value = code;
            }
            searchSelect(selector);
        }
    }
}

function searchSelect(selector){
    let selectBoxElement = document.querySelector(selector);
    dselect(selectBoxElement, {
        search: true
    });
}