var tableRoles;
let rowTable = "";



let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded',function(){

/*========================================================
    Muestra la tabla de roles de  usuarios de datatables
==========================================================*/
	
	  tableRoles = $('#tableRoles').dataTable({
		
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Roles/getRoles",
			"dataSrc":""
		},
		"columns":[

	          {"data":"nombrerol"},
	          {"data":"descripcion"},
	          {"data":"status"},
	          {"data":"options"},

		    ],


		   'dom': 'lBfrtip',
	          'buttons': [
	          {
	          	"extend": "copyHtml5",
	          	"text": "<i class='far fa-copy'></i> ",
	          	"titleAttr":"Copiar",
	          	"className": "btn btn-secondary btn-sm",
	          	"exportOptions": {
                	"columns": [0,1,2,3]
          	   }
	          },{
	          	"extend": "excelHtml5",
	          	"text": "<i class='fas fa-file-excel'></i>",
	          	"titleAttr":"Exportar a excel",
	          	"className": "btn btn-success btn-sm",
	          	"exportOptions": {
                     "columns": [0,1,2,3]
                 }
	          },{
	          	"extend": "pdfHtml5",
	          	"text": "<i class='fas fa-file-pdf'></i>",
	          	"titleAttr":"Exportar a PDF",
	          	"className": "btn btn-danger btn-sm",
	          	"exportOptions": {
                     "columns": [0,1,2,3]
                 }
	          },{
	          	"extend": "csvHtml5",
	          	"text": "<i class='fas fa-file-csv'></i>",
	          	"titleAttr":"Exportar a csv",
	          	"className": "btn btn-info btn-sm",
	          	"exportOptions": {
                     "columns": [0,1,2,3]
                   }
		         },
		      ],

		      	"aProcessing":true,
				"aServerSide":true,
				"autoWidth": false,

				"responsive":"true",
				"bDestroy":true,
				"aLengthMenu":[[5,10,20,50,100],[5,10,20,50,100]],
				

		        "columnDefs":[{
				            
				            "searchable": false,
				            "orderable": false,
				            "targets": 0
	       		 			
	       		 			}],

	       		"order":[[0,"asc"]]

				});
	
/*=============================================
    Registro de roles de usuarios
=============================================*/

if(document.querySelector("#formRol")){	
	let formRol = document.querySelector("#formRol");
	formRol.onsubmit = function(e){
		e.preventDefault();

		let intIdRol = document.querySelector('#idRol').value;	
		let strNombre = document.querySelector('#txtNombre').value;
		let strDescripcion = document.querySelector('#txtDescripcion').value;
		let intStatus = document.querySelector('#listStatus').value;

		if (strNombre == '' || strDescripcion == '' || intStatus == '') 
		{
			swal("Atención", "Todos los campos son obligatorios.", "error");
			return false;
		}
		
		divLoading.style.display = "flex";

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Roles/setRol';
		let formData = new FormData(formRol);
		
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{

					$('#modalFormRol').modal("hide");
					
					formRol.reset();
					
					swal("Roles de usuario", objData.msg , "success");

					tableRoles.api().ajax.reload();

					}else{
						swal("Error", objData.msg , "error");

					}
				}

				divLoading.style.display = "none";
               		return false;
			}
	}	}
});

window.addEventListener("load", function() {
    
        setTimeout(() => { 

    }, 500);
  }, false);


/*=====================================================================================================
    Funciión para editar un registro de un rol de usuario en especifico en las acciones en el datatable
======================================================================================================*/

function fntEditRol(element, idrol){

			
			rowTable = element.parentNode.parentNode.parentNode;

			document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			divLoading.style.display= "flex";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Roles/getRol/'+idrol;
			request.open("GET",ajaxUrl,true);
			request.send();

			request.onreadystatechange =function(){
				if (request.readyState == 4 && request.status == 200){
				
				let objData = JSON.parse(request.responseText);
				if (objData.status) 
				{ 
					document.querySelector("#idRol").value = objData.data.idrol;
					document.querySelector("#txtNombre").value =objData.data.nombrerol;
					document.querySelector("#txtDescripcion").value =objData.data.descripcion;

					if (objData.data.status == 1) 
					{
						var optionSelect = '<option value="1" selected class = "notBlock">Activo</option>';
					}else{
						var optionSelect = '<option value="2" selected class= "notBlock">Inactivo</option>';
					}

					let htmlselect = `${optionSelect}
									<option value ="1">Activo</option>
									<option value ="2">Inactivo</option>
									`;
					document.querySelector("#listStatus").innerHTML = htmlselect;
					
					$('#modalFormRol').modal('show');

				}else{
					swal("Error", objData.msg , "error");
			}
		
		}   divLoading.style.display = "none";
                  return false;
	}
    }
    
/*===============================================================================================
   Funcion para eliminar un rol de usuario en especificio a traves de las acciones de datatable
================================================================================================*/
function fntDelRol(idrol){
  
      swal({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el Rol?",
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
            let ajaxUrl = base_url+'/Roles/delRol/';
            let strData = "idrol="+idrol;

            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){

                    var objData = JSON.parse(request.responseText);

                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableRoles.api().ajax.reload();

                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}

/*===============================================================================================
   Funcion para obtner los permisos de roles de usuario 
================================================================================================*/

function fntPermisos(idrol){
			
			divLoading.style.display= "flex";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
			
			request.open("GET",ajaxUrl, true);
			request.send();

			request.onreadystatechange = function(){

			if (request.readyState == 4 && request.status == 200) {

			document.querySelector('#contentAjax').innerHTML = request.responseText;
				
			$('.modalPermisos').modal('show');
				
			document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
		}

		divLoading.style.display = "none";
           	return false;
	}
}			

/*===============================================================================================
   Funcion para guardar los permisos de roles de usuarios 
================================================================================================*/

function fntSavePermisos(event){
			
			divLoading.style.display= "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Permisos/setPermisos';
			let formElement = document.querySelector("#formPermisos");
			let formData = new FormData(formElement);
			request.open("POST", ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){

			if (request.readyState == 4 && request.status == 200) {
			
			let objData = JSON.parse(request.responseText);
			
			if (objData.status) 
			{
				swal("Permisos de usuario", objData.msg, "success");

			}else{

				swal("Error", objData.msg, "error");
			}
		}
	 }
}

/*=========================================================================
   Funcion para abrir el modal de registro y actulizacion de un rol de usuario
===========================================================================*/

$('#tableRoles').DataTable();

function openModal(){


	rowTable = "";
	document.querySelector('#idRol').Value="";
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
	document.querySelector('#formRol').reset();

	$('#modalFormRol').modal('show');
}