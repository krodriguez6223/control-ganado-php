let tableUsuarios;
let rowTable = "";

 
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded',function(){

 
/*=============================================
    Muestra la tabla de usuarios de datatables
=============================================*/

	tableUsuarios = $('#tableUsuarios').dataTable({
		"aProcessing":true,
		"aServerSide":true,
        "autoWidth": false,
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},

       	"ajax":{
         "url":" "+base_url+"/Usuarios/getUsuarios?="+"&deRango="+ $("#deRango").val()+"&hastaRango="+$("#hastaRango").val(),
         "dataSrc":""
        },
          
		"columns":[ 
          {"data":"cedula"},
          {"data":"nombres"},
          {"data":"apellidos"},	
          {"data":"email_user"},
          {"data":"nombrerol"},
          {"data":"status"},
          {"data":"telefono"},
          {"data":"options"}
		],

		'dom': 'lBfrtip',
          'buttons': [
          {
          	"extend": "copyHtml5",
          	"text": "<i class='far fa-copy'></i> ",
          	"titleAttr":"Copiar",
          	"className": "btn btn-secondary btn-sm",
            "exportOptions": {
                "columns": [0,2,3,4,5]
            }
          },{
          	"extend": "excelHtml5",
          	"text": "<i class='fas fa-file-excel'></i> ",
          	"titleAttr":"Exportar a excel",
          	"className": "btn btn-success btn-sm",
            "exportOptions": {
                "columns": [0,2,3,4,5]
            }
          },{
          	"extend": "pdfHtml5",
          	"text": "<i class='fas fa-file-pdf'></i> ",
          	"titleAttr":"Exportar a PDF",
          	"className": "btn btn-danger btn-sm",
            "exportOptions": {
                "columns": [0,2,3,4,5]
            }

          },{
          	"extend": "csvHtml5",
          	"text": "<i class='fas fa-file-csv'></i> ",
          	"titleAttr":"Exportar a csv",
          	"className": "btn btn-info btn-sm",
            "exportOptions": {
                "columns": [0,2,3,4,5]
            } 
          }

           ],

            "responsive":true,
    		"bDestroy":true,
    		"aLengthMenu":[[3,10,20,50,100],[3,10,20,50,100]],
          	"order":[[0,"desc"]]

	       });


/*=============================================
    Registro de usuario
=============================================*/

if(document.querySelector("#formUsuario")){
        let formUsuario = document.querySelector("#formUsuario");
        formUsuario.onsubmit = function(e) {
            e.preventDefault();
           
            let strIdentificacion = document.querySelector('#txtCedula').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let intTipousuario = document.querySelector('#listRolid').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listStatus').value;

            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let elementsValid = document.getElementsByClassName("valid");
            
            for (let i = 0; i < elementsValid.length; i++) { 
               
                if(elementsValid[i].classList.contains('is-invalid')) { 
                   
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    
                    return false;
                } 
            } 
            divLoading.style.display = "flex";
            
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/setUsuario'; 
            let formData = new FormData(formUsuario);
          
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
               
                if(request.readyState == 4 && request.status == 200){
                   
                    let objData = JSON.parse(request.responseText);
                    
                    if(objData.status)
                    {
                        
                      
                        $('#modalFormUsuario').modal("hide");
                       
                        formUsuario.reset();
                       
                        swal("Usuarios", objData.msg ,"success");
                    
                    }else{
                       
                       swal("Error", objData.msg , "error");
                    }
                }
               
                divLoading.style.display = "none";
                return false;
            }
        }
    }

}, false);
window.addEventListener('load', function() {
        fntRolesUsuario();
       
}, false);

/*=============================================
   Funcion para extraer los roles de usuario
=============================================*/

function fntRolesUsuario(){
    if(document.querySelector('#listRolid')){
        let ajaxUrl = base_url+'/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid').selectpicker('render');
            }
        }
    }
}


/*==============================================================================
    Funcion para mostras en un modal los registro de un usuario en especifico
==============================================================================*/

function fntViewUsuario(idpersona){
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
          
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){
               
            if(request.readyState == 4 && request.status == 200){
            
            let objData = JSON.parse(request.responseText);

            if(objData.status)
           
            {
               let estadoUsuario = objData.data.status == 1 ? 
              
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celCedula").innerHTML = objData.data.cedula;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
               
                $('#modalViewUser').modal('show');
           
            }else{
                
                swal("Error", objData.msg , "error");
            }
        }
    }
}

/*===================================================================================================
    Funciión para editar un registro de un usuario en especifico en las acciones en el datatable
====================================================================================================*/

function fntEditUsuario(element, idpersona){

            rowTable = element.parentNode.parentNode.parentNode;

            document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            divLoading.style.display= "flex";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
           
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

             if(request.readyState == 4 && request.status == 200){
           
            let objData = JSON.parse(request.responseText);

            if(objData.status)
           
            {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtCedula").value = objData.data.cedula;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#listRolid").value =objData.data.idrol;
               
                $('#listRolid').selectpicker('render');

               
                if(objData.data.status == 1){
                  
                    document.querySelector("#listStatus").value = 1;
                }else{
                   
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
           
            divLoading.style.display = "none";
            return false;
        }
    
        $('#modalFormUsuario').modal('show');
    }

}

/*=========================================================================================
   Funcion para eliminar un usuario en especificio a traves de las acciones de datatable
===========================================================================================*/

function fntDelUsuario(idpersona){
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/delUsuario';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                   
              
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableUsuarios.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

/*==========================================================
    metodo para filtrar por rango de fechas en el datatable
=============================================================*/

$('#daterange-btn').daterangepicker(
  {  "locale": {
       "format": "YYYY-MM-DD",
       "separator": " - ",
       "applyLabel": "Aplicar",
       "cancelLabel": "Cancelar",
       "fromLabel": "Desde",
       "toLabel": "Hasta",
       "customRangeLabel": "Rango Personalizado",
       "daysOfWeek": [
           "Do",
           "Lu",
           "Ma",
           "Mi",
           "Ju",
           "Vi",
           "Sa"
       ],
       "monthNames": [
           "Enero",
           "Febrero",
           "Marzo",
           "Abril",
           "Mayo",
           "Junio",
           "Julio",
           "Agosto",
           "Septiembre",
           "Octubre",
           "Noviembre",
           "Diciembre"
       ],
       "firstDay": 1
     },
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Este Año'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'Último Año': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
    },
    startDate: moment($("#deRango").val()),
    endDate  : moment($("#hastaRango").val()),
  },
  function (start, end) {
            
      window.location = base_url+"/Usuarios?deRango="+start.format('YYYY-MM-DD')+"&hastaRango="+end.format('YYYY-MM-DD');
  }
)
 
/*=========================================================================
   Funcion para abrir el modal de registro y actulizacion de un usuario
===========================================================================*/

function openModal()

{   rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}


    