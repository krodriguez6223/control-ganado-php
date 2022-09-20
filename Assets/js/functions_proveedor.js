let tableProveedor;

document.addEventListener('DOMContentLoaded',function(){

	tableProveedor = $('#tableProveedor').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false,
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Proveedores/getGanados",
			"dataSrc":""

		},
		"columns":[
          {"data":"cedula"},
          {"data":"nombres"},
          {"data":"contacto"},
          {"data":"direccion"},	
          {"data":"email"},
          {"data":"categoria"},
          {"data":"status"},
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
                "columns": [0,1,2,3,4,5,6]
            }
          },{
          	"extend": "excelHtml5",
          	"text": "<i class='fas fa-file-excel'></i>",
          	"titleAttr":"Exportar a excel",
          	"className": "btn btn-success btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4,5,6]
            }
          },{
          	"extend": "pdfHtml5",
          	"text": "<i class='fas fa-file-pdf'></i> ",
          	"titleAttr":"Exportar a PDF",
          	"className": "btn btn-danger btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4,5,6]
            }

          },{
          	"extend": "csvHtml5",
          	"text": "<i class='fas fa-file-csv'></i>",
          	"titleAttr":"Exportar a csv",
          	"className": "btn btn-info btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4,5,6]
            }

          },{
          	"extend": "print",
          	"text": "<i class='fas fa-print'></i> ",
          	"titleAttr":"Imprimir",
          	"className": "btn btn-primary btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4,5,6]
            }

          }

           ],
		"responsive":"true",
		"bDestroy":true,
		"aLengthMenu":[[3,10,20,50,100],[3,10,20,50,100]],
		"order":[[0,"desc"]]
	});

	let formProveedor = document.querySelector("#formProveedor");
	formProveedor.onsubmit = function(e){
		e.preventDefault();

		let intCedula = document.querySelector('#txtCedula').value;	
		let strNombre = document.querySelector('#txtNombre').value;
		let intContacto = document.querySelector('#txtContacto').value;
		let strDireccion = document.querySelector('#txtDireccion').value;
		let strCorreo = document.querySelector('#txtEmail').value;
		let strCategoria = document.querySelector('#listCategoria').value;
		let strObservacion = document.querySelector('#txtObservacion').value;
		let strEstado = document.querySelector('#listEstado').value;
		
	
		if (intCedula == '' ||
		    strNombre == '' || 
		  intContacto == '' || 
		 strDireccion == '' || 
		 strCorreo    == '' || 
		 strCategoria == '' || 
		 strEstado    == '' ) 
		{
			swal("Atención", "Todos los campos son obligatorios.", "error");
			return false;
		}

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Proveedores/ingresarGanado';
		let formData = new FormData(formProveedor);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{
					$('#modalFormProveedor').modal("hide");
					formProveedor.reset();
					swal("Registro", objData.msg , "success");
					tableProveedor.api().ajax.reload(function(){
			
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


//funcion que permite visualizar los datos del usuario
function fntViewGanado(idganado){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Proveedores/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();

             console.log(request);
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

	          if (objData.status) 
				{ 
                    let estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>':
                    '<span class="badge badge-danger">Inactivo</span>';
				
					document.querySelector("#celCedula").innerHTML = objData.data.cedula;
					document.querySelector("#celNombre").innerHTML = objData.data.nombres;
					document.querySelector("#celContacto").innerHTML = objData.data.contacto;
					document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
					document.querySelector("#celEmail").innerHTML = objData.data.email;
					document.querySelector("#celCategoria").innerHTML = objData.data.categoria;
					document.querySelector("#celObservacion").innerHTML = objData.data.observacion;
					document.querySelector("#celEstado").innerHTML = estadoUsuario;
					document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

					
					$('#modalViewProveedor').modal('show');
				}else{
					swal("Error", objData.msg , "error");
				 
  				}
			 }
		}  
			
	}
	//EDITAR UN USUARIO
    function fntEditGanado(idganado){

			document.querySelector('#titleModal').innerHTML = "Actualizar Proveedor";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Proveedores/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{ 
					document.querySelector("#idGanado").value = objData.data.idganado;
					document.querySelector("#txtCedula").value =objData.data.cedula;
					document.querySelector("#txtNombre").value =objData.data.nombres;
					document.querySelector("#txtContacto").value =objData.data.contacto;
					document.querySelector("#txtDireccion").value =objData.data.direccion;
					document.querySelector("#txtEmail").value =objData.data.email;
					document.querySelector("#listCategoria").value =objData.data.categoria;
					document.querySelector("#txtObservacion").value =objData.data.observacion;
					document.querySelector("#listEstado").value =objData.data.status;
					$('#listEstado').selectpicker('render');
					
				}
			} 
			 $('#modalFormProveedor').modal('show');
                    							   
			}	
	     }

//eliminar un usuario

function fntDelGanado(idganado){
	       
          swal({
          			title: "Eliminar proveedor",
          			text: "¿Realmente quiere eliminar este proveedor?",
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
					let ajaxUrl = base_url+'/Proveedores/delGanado/';
					let strData = "idGanado="+idGanado;
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							let objData = JSON.parse(request.responseText);
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableProveedor.api().ajax.reload(function(){
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
	document.querySelector('#idGanado').value = "";
	document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML="Nuevo proveedor";
	document.querySelector("#formProveedor").reset();


	$("#listCategoria").val('').trigger('change');
	$("#listEstado").val('').trigger('change');
	

	$('#modalFormProveedor').modal('show');

}




