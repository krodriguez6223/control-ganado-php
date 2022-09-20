let tableEmpleado;
let selectorFecha;

document.addEventListener('DOMContentLoaded',function(){

	tableEmpleado = $('#tableEmpleado').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false,
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Empleados/getGanados",
			"dataSrc":""

		},
		"columns":[
          {"data":"cedula"},
          {"data":"nombres"}, 
          {"data":"apellidos"},
          {"data":"correo"},	
          {"data":"contacto"},
          {"data":"edad"},
          {"data":"cargo"},  
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

          },{
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

	let formEmpleado = document.querySelector("#formEmpleado");
	formEmpleado.onsubmit = function(e){
		e.preventDefault();

		let intCedula = document.querySelector('#txtCedula').value;	
		let strNombres = document.querySelector('#txtNombres').value;
		let strApellidos = document.querySelector('#txtApellidos').value;
		let strCorreo = document.querySelector('#txtCorreo').value;
		let intContacto = document.querySelector('#txtContacto').value;
		let intEdad = document.querySelector('#txtEdad').value;
		let strCargo = document.querySelector('#txtCargo').value;
		let strObservacion = document.querySelector('#txtObservacion').value;
		let strEstado = document.querySelector('#listStatus').value;
		let strFoto = document.querySelector('#fotoEmpleado').value;

		
	
		if ( intCedula == '' ||
		    strNombres == '' || 
		  strApellidos == '' || 
		     strCorreo == '' || 
		intContacto    == '' || 
		       intEdad == '' || 
		   strCargo    == '' || 
             strEstado == '') 
		{
			swal("Atención", "Todos los campos son obligatorios.", "error");
			return false;
		}

		let elementsValid = document.getElementsByClassName("valid");
		for(let i =0; i < elementsValid.length; i++){
			if (elementsValid[i].classList.contains('is-invalid')){
				swal("Atencion", "Por favor verifique los campos en rojo", "error");
				return false;
			}	
		}

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Empleados/ingresarGanado';
		let formData = new FormData(formEmpleado);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{
					$('#modalFormEmpleado').modal("hide");
					formEmpleado.reset();
					swal("Registro", objData.msg , "success");
					tableEmpleado.api().ajax.reload(function(){
			
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
function fntViewEmpleado(idganado){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Empleados/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

	            

				if (objData.status) 
				{ 

					if (objData.data.status == 1) {

				      let estadoEmpleado = '<span class="badge badge-success">Activo</span>'

					}else {

					let estadoEmpleado = '<span class="badge badge-danger">Inactivo</span>'

					}
				
					
				    document.querySelector("#celCedula").innerHTML = objData.data.cedula;
					document.querySelector("#celNombres").innerHTML = objData.data.nombres;
					document.querySelector("#celApellidos").innerHTML = objData.data.apellidos;
					document.querySelector("#celCorreo").innerHTML = objData.data.correo;
					document.querySelector("#celContacto").innerHTML = objData.data.contacto;
					document.querySelector("#celEdad").innerHTML = objData.data.edad;
					document.querySelector("#celCargo").innerHTML = objData.data.cargo;
					document.querySelector("#celObservacion").innerHTML = objData.data.observacion;
					document.querySelector("#celEstado").innerHTML = estadoEmpleado;
					document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
					document.querySelector("#celFotoEmpleado").innerHTML = objData.data.foto;
					

					
					$('#modalViewEmpleado').modal('show');
				}else{
					swal("Error", objData.msg , "error");
				 
  				}
			 }
		}  
			
	}
	//EDITAR UN USUARIO
    function fntEditEmpleado(idganado){

			document.querySelector('#titleModal').innerHTML = "Actualizar empleado";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Empleados/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{ 
					document.querySelector("#idGanado").value = objData.data.idganado;
					document.querySelector("#txtCedula").value =objData.data.cedula;
					document.querySelector("#txtNombres").value =objData.data.nombres;
					document.querySelector("#txtApellidos").value =objData.data.apellidos;
					document.querySelector("#txtCorreo").value =objData.data.correo;
					document.querySelector("#txtContacto").value =objData.data.contacto;
					document.querySelector("#txtEdad").value =objData.data.edad;
					document.querySelector("#txtCargo").value =objData.data.cargo;
					document.querySelector("#listStatus").value =objData.data.status;		
					document.querySelector("#txtObservacion").value =objData.data.observacion;
					document.querySelector("#fotoEmpleado").value =objData.data.foto;
					
				}
			} 
			 $('#modalFormEmpleado').modal('show');
                    							   
			}	
	     }

//eliminar un usuario

function fntDelEmpleado(idganado){
	
          swal({
          			title: "Eliminar res",
          			text: "¿Realmente quiere eliminar esta res?",
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
					let ajaxUrl = base_url+'/Empleados/delGanado/';
					let strData = "idGanado="+idGanado;
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							let objData = JSON.parse(request.responseText);
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableEmpleado.api().ajax.reload(function(){
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
	document.querySelector('#titleModal').innerHTML="Nuevo empleado";
	document.querySelector("#formEmpleado").reset();


	$("#listStatus").val('').trigger('change');

	$('#modalFormEmpleado').modal('show');

}


	/*=============================================
	SUBIR FOTO TEMPORAL DE OPINIÓN
	=============================================*/


	$("#fotoRes").change(function(){
	$(".alert").remove();

	let imagen = this.files[0];
	console.log("imagen",imagen);

	/*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    	$("#fotoRes").val("");

    	$("#fotoRes").after();

    	swal("Atención", "¡La imagen debe estar en formato JPG o PNG!", "error");
			
	return false;

    	return;

    }else if(imagen["size"] > 2000000){

    	$("#fotoRes").val("");

    	$("#fotoRes").after();

    	swal("Atención", "¡La imagen no debe pesar más de 2MB!", "error");
			
	return false;

    	return;
    
    }else{

    	 let datosImagen = new FileReader;

    	 datosImagen.readAsDataURL(imagen);

    	 $(datosImagen).on("load", function(event){

    	 	let rutaImagen = event.target.result;

    	 	$(".prevFotoRes").attr("src", rutaImagen);

    	 })

    }

})



