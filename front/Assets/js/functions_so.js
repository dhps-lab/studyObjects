var learningResultTable;

document.addEventListener('DOMContentLoaded', function(){
    learningResultTable = $('#learningResultTable').DataTable({
        "aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/EditStudyObject/getStudyObject",
            "dataSrc":""
        },
        "columns":[
            {"data":"codigo"},
            {"data":"descripcion"},
            {"data":"detalle"},
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

    var dataFormAddLR = document.querySelector("#formAddStudyObject");
    var dataFormEditLR = document.querySelector("#formEditStudyObject");

    dataFormAddLR.onsubmit = function(e){
        e.preventDefault();
        var strName = document.querySelector("#txtNameAdd").value;
        var strDescription = document.querySelector("#txtDescriptionAdd").value;
        if(strName == "" || strDescription == ""){
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        postPutExecution('EditStudyObject/postStudyObject', dataFormAddLR, '#addStudyObjectModal', formAddStudyObject);
    }

    dataFormEditLR.onsubmit = function(e){
        e.preventDefault();
        var intCode = document.querySelector("#txtCodeEdit").value;
        var strName = document.querySelector("#txtNameEdit").value;
        var strDescription = document.querySelector("#txtDescriptionEdit").value;
        if(intCode == "" || strName == "" || strDescription == ""){
            swal("Advertencia", "Todos los campos son oblicatorios", "error");
            return false;
        }
        postPutExecution('EditStudyObject/putStudyObject/' + intCode, dataFormEditLR, '#editStudyObjectModal', formEditStudyObject);
    }
});

function addStudyObjectModal(){
    $('#addStudyObjectModal').modal('show');
}

function editStudyObjectModal(button){
    let idStudyObject = button.getAttribute('lr');
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'EditStudyObject/getStudyObjectById/' + idStudyObject;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#txtCodeEdit").value = objData.msg.codigo;
                document.querySelector("#txtNameEdit").value = objData.msg.descripcion;
                document.querySelector("#txtDescriptionEdit").value = objData.msg.detalle;
            } else {
                swal("Error", objData.msg, "error");
            }
        } 
    }

    $('#editStudyObjectModal').modal('show');
}

function postPutExecution(url, dataFormLR, modalName, formModal){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+url;
    let formData = new FormData(dataFormLR);
    request.open('POST', ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    $(modalName).modal("hide");
                    formModal.reset();
                    swal("Objeto de estudio", objData.msg, "success");
                    learningResultTable.ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
}

function deleteExecution(url){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+url;
    request.open('POST', ajaxUrl, true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status){
                    swal("¡Eliminado!", objData.msg, "success");
                    learningResultTable.ajax.reload();
                } else {
                    swal("Cancelado", objData.msg, "error");
                }
            }
        }
}


function deleteStudyObject(deleteButton){
    let code = deleteButton.getAttribute('lr');
    swal({
        title: "Eliminar objeto de estudio",
        text: "¿Realmente quiere eliminar el objeto de estudio?",
        icon: "warning",
        buttons: {
            cancel: "¡No, cancelar!",
            confirm: "¡Si, eliminar!",
          },
        closeOnconfirm: false
    }).then(result => {
        if(result){
            deleteExecution('EditStudyObject/deleteStudyObject/'+ code);
        } else {
            swal("Cancelado", "El objeto de estudio esta ha salvo", "error");
        }
        
    });
}