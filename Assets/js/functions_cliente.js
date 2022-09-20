let tableCliente;

document.addEventListener('DOMContentLoaded',function(){

    tableCliente = $('#tableCliente').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "autoWidth": false,
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url":" "+base_url+"/Clientes/getClientes",
            "dataSrc":""

        },
        "columns":[
          {"data":"idCliente"},
          {"data":"cedula"},
          {"data":"nombres"},
          {"data":"apellidos"},
          {"data":"telefono"},
          {"data":"email_user"}, 
          {"data":"direccion"},
          {"data":"status"},    
          {"data":"options"}
        ],

        'dom': 'lBfrtip', 
          'buttons': [
          {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i>",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary btn-sm",
            "exportOptions": {
                "columns": [0,1,2,3,4,5,6,7]
            }
          },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i>",
            "titleAttr":"Exportar a excel",
            "className": "btn btn-success btn-sm",
            "exportOptions": {
                "columns": [0,1,2,3,4,5,6,7]
            }
          },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i>",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-danger btn-sm",
            "exportOptions": {
                "columns": [0,1,2,3,4,5,6,7]
            }


          },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i>",
            "titleAttr":"Exportar a csv",
            "className": "btn btn-info btn-sm",
            "exportOptions": {
                "columns": [0,1,2,3,4,5,6,7]
            }

          },
          {
            "extend": "print",
            "text": "<i class='fas fa-print'></i> ",
            "titleAttr":"Imprimir",
            "className": "btn btn-primary btn-sm",
            "exportOptions": {
                "columns": [0,1,2,3,4,5,6,7]
            }

          }

           ],
        "responsive":"true",
        "bDestroy":true,
        "aLengthMenu":[[3,10,20,50,100],[3,10,20,50,100]],
        "order":[[0,"desc"]]
    });


// INGRESO DE CLIENTES

    let formCliente = document.querySelector("#formCliente");
    formCliente.onsubmit = function(e){
        e.preventDefault();

        //datos de trataiento baño
                    let intCedula = document.querySelector('#txtCedula').value;
                    let strDireccion = document.querySelector('#txtDireccion').value;
                    let strNombre = document.querySelector('#txtNombre').value;
                    let strApellidos = document.querySelector('#txtApellido').value;
                    let intTelefono = document.querySelector('#txtTelefono').value;
                    let strEmail = document.querySelector('#txtEmail').value;
                    let strObservacion = document.querySelector('#txtObservacion').value;
                    let strStatus = document.querySelector('#listStatus').value;

        
                if  ( intCedula == '' || strDireccion == ''|| strNombre == ''|| strApellidos == ''|| intTelefono == ''|| strEmail == ''|| strStatus == '')

                        {
                            swal("Atención", "Todos los campos con (*) asterisco son obligatorios ", "error");
                            return false;
                 }
        
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Clientes/ingresarClientes';
        let formData = new FormData(formCliente);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status ==200){

                let objData = JSON.parse(request.responseText);
                console.log(request.responseText);
            
                if (objData.status) 
                {
                    $('#modalFormCliente').modal("hide");
                    formCliente.reset();
                    swal("Registro", objData.msg , "success");
                    tableCliente.api().ajax.reload(function(){
            
                    });
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                    

                }
            }
        }       

    },false);

window.addEventListener("load", function() {
    
        setTimeout(() => { 
       
      
    }, 500);

  
  }, false);

//VER LOS DATOS DE CADA CLIENTES REGISTRADOS
function fntViewCliente(idcliente){

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Clientes/getCliente/'+idcliente;
            request.open("GET",ajaxUrl,true);
            request.send();

            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status ==200){
                
                let objData = JSON.parse(request.responseText);
                console.log("objData", objData);
                            

                    let estadoCliente = objData.data.status == 1?
                    '<span class="badge badge-success">Activo</span>':
                    '<span class="badge badge-danger">Inactivo</span>';
                
                    document.querySelector("#celCedula").innerHTML = objData.data.cedula;
                    document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                    document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                    document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                    document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                    document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
                    document.querySelector("#celStatus").innerHTML = estadoCliente;
                    document.querySelector("#celObservacion").innerHTML = objData.data.observacion;
                    document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

                    $('#modalViewCliente').modal('show');
                }
             }
            
        }  


//EDITAR REGISTRO DEL CLIENTE
  
    function fntEditCliente(idcliente){

            document.querySelector('#titleModal').innerHTML = "Actualizar Clientes";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML= "Actualizar";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Clientes/getCliente/'+idcliente;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status ==200){
                
                let objData = JSON.parse(request.responseText);

                if (objData.status)  
                    
                { 
                    document.querySelector("#idCliente").value = objData.data.idCliente;
                    document.querySelector("#txtCedula").value =objData.data.cedula;
                    document.querySelector("#txtNombre").value =objData.data.nombres;
                    document.querySelector("#txtApellido").value = objData.data.apellidos;
                    document.querySelector("#txtTelefono").value = objData.data.telefono;
                    document.querySelector("#txtEmail").value = objData.data.email_user;
                    document.querySelector("#txtDireccion").value = objData.data.direccion;
                    document.querySelector("#txtObservacion").value = objData.data.observacion;
                    document.querySelector("#listStatus").value =objData.data.status;
                    $('#listStatus').selectpicker('render');

                }
            }
        } 

             $('#modalFormCliente').modal('show');

                                                   
            }   
//ELIMINAR UN CLIENTE

function fntDelCliente(idcliente){
    
          swal({
                    title: "Eliminar cliente",
                    text: "¿Realmente quiere eliminar este cliente?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, eliminar!",
                    cancelButtontext: "No, cancelar!",
                    closeOnConfirm: false,
                    closeOnCancel: true
         
          }, function(isConfirm){

               if(isConfirm)
               {
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Clientes/delCliente/';
                    let strData = "idCliente="+idcliente;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            console.log(request.responseText);
                            if(objData.status){

                                swal("Eliminar!", objData.msg, "success");
                                tableCliente.api().ajax.reload(function(){
                                    setTimeout(() => { 
                                    
                                    
                                }, 500);
                                });

                            } else{ 

                            swal("Atencion!", objData.msg, "error");
                            }
                        }
                    }
                }
            });
        }


        function openModal()
{
    document.querySelector('#idCliente').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML="Nuevo cliente";
    document.querySelector("#formCliente").reset();
    $("#listStatus").val('').trigger('change');
    $('#modalFormCliente').modal('show');

}

