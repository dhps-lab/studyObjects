
document.addEventListener('DOMContentLoaded', function(){
    getStatisticAmount('StudyObject', document.getElementById("StudyObject"));
    getStatisticAmount('Subject', document.getElementById("Subject"));
    getStatisticAmount('Teacher', document.getElementById("Teacher"));
    getStatisticAmount('AssignStudyObject', document.getElementById("AssignStudyObject"));
});

function getStatisticAmount(method, element) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back + 'Statistics/methodStatistic/';
    let formData = new FormData();
    method = 'amount' + method;
    formData.append('method', method);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            element.innerHTML = objData.data;
        }
    };
}

function getStatisticWithFunction(method, componentFunction){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_back + 'Statistics/methodStatistic/';
    let formData = new FormData();
    let dataResponse = '';
    formData.append('method', method);
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            //console.log(method);
            //console.log(objData);
            componentFunction(objData.data);
        }
    };   
}

function getStatisticWithFunctionMultipleParams(method, componentFunction){

    if (Array.isArray(method)){
        let promises = [];
        let promise= {};
        method.forEach(item => {
             promise = new Promise(function (resolve, reject) {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_back + 'Statistics/methodStatistic/';
                let formData = new FormData();
                formData.append('method', item);
                request.open('POST', ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        resolve(objData.data);
                    }
                };

            });
            promises.push(promise)
        });

        Promise.all(promises).then(function(objData) {
            componentFunction(objData);
        });
    }
}