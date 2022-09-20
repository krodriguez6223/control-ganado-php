let tableProduccion;

document.addEventListener('DOMContentLoaded',function(){

	tableProduccion = $('#tableProduccion').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false,
	    "language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Produccion/getProducciones",
			"dataSrc":""

		},
		"columns":[
          {"data":"codigo"},
          {"data":"nomOrdeniador"},
          {"data":"cantLitro"},
          {"data":"horario"},
          {"data":"fechaOrdenio"},  
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
          		"columns": [0,1,2,3,4,5]
          	}
          },{
          	"extend": "excelHtml5",
          	"text": "<i class='fas fa-file-excel'></i>",
          	"titleAttr":"Exportar a excel",
          	"className": "btn btn-success btn-sm",
          	"exportOptions": {
          		"columns": [0,1,2,3,4,5]
          	}
          },{
          	"extend": "pdfHtml5",
          	"text": "<i class='fas fa-file-pdf'></i>",
          	"titleAttr":"Exportar a PDF",
          	"className": "btn btn-danger btn-sm",
          	"exportOptions": {
          		"columns": [0,1,2,3,4,5]
          	}


          },{
          	"extend": "csvHtml5",
          	"text": "<i class='fas fa-file-csv'></i>",
          	"titleAttr":"Exportar a csv",
          	"className": "btn btn-info btn-sm",
          	"exportOptions": {
          		"columns": [0,1,2,3,4,5]
          	}

          },
          {
          	"extend": "print",
          	"text": "<i class='fas fa-print'></i> ",
          	"titleAttr":"Imprimir",
          	"className": "btn btn-primary btn-sm",
          	"exportOptions": {
          		"columns": [0,1,2,3,4,5]
          	}

          }

           ],
		"responsive":"true",
		"bDestroy":true,
		"aLengthMenu":[[3,10,20,50,100],[3,10,20,50,100]],
		"order":[[0,"desc"]]
	});

	//BUSCAR RES PARA EL TRATAMIENTO
	$('#txtCodigo').keyup(function(event) {
		event.preventDefault();
		let res = $(this).val();

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Produccion/buscarRes';
		let formData = new FormData(formProduccion);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				console.log(request.responseText);

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{    
					
					 $('#idganado').val(objData.data.idganado);
					 $('#txtNombre').val(objData.data.nombres);
					 $('#txtCategoria').val(objData.data.categoria);
					 $('#txtPeso').val(objData.data.peso);
					 $('#txtRaza').val(objData.data.raza);

					 //bloquear campos
					 $('#txtNombre').attr('disabled','disabled');
					 $('#txtCategoria').attr('disabled','disabled');
					 $('#txtPeso').attr('disabled','disabled');
					 $('#txtRaza').attr('disabled','disabled');

				}else{

					// limpiar los campos si la respuesta es 0
					 $('#idGanado').val('');
					 $('#txtNombre').val('');
					 $('#txtCategoria').val('');
					 $('#txtPeso').val('');
					 $('#txtRaza').val('');
				}
         
         }else{

         	  return false;
         }
       }
	});

// INGRESO DE PRODUCCION DE LA LECHE

	let formProduccion = document.querySelector("#formProduccion");
	formProduccion.onsubmit = function(e){
		e.preventDefault();

		//datos de trataiento baño
					let strNomOrdeñador = document.querySelector('#nomOrdeñador').value;
					let intCantLitro = document.querySelector('#cantLitros').value;
					let strHorario = document.querySelector('#horario').value;
					let strFechaOrdeño = document.querySelector('#fechaOrdeño').value;

		
				if  ( strNomOrdeñador == '' || intCantLitro == '' || strHorario    == '' ||  strFechaOrdeño == '' )

						{
							swal("Atención", "Todos los campos con (*) asterisco son obligatorios ", "error");
							return false;
			     }
		
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Produccion/ingresarProduccion';
		let formData = new FormData(formProduccion);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);
				console.log(request.responseText);
			
				if (objData.status) 
				{
					$('#modalFormProduccion').modal("hide");
					formProduccion.reset();
					swal("Registro", objData.msg , "success");
					tableProduccion.api().ajax.reload(function(){
			
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

//VER LOS DATOS DE CADA TRATAMIENTRO DEL GANADO REGISTRADO
function fntViewProduccion(idproduccion){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Produccion/getProduccion/'+idproduccion;
			request.open("GET",ajaxUrl,true);
			request.send();

			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);
				
					document.querySelector("#celCodigo").innerHTML = objData.data.codigo;
					document.querySelector("#celNomOrdeñador").innerHTML = objData.data.nomOrdeniador;
					document.querySelector("#celCantLitros").innerHTML = objData.data.cantLitro;
					document.querySelector("#celHorario").innerHTML = objData.data.horario;
					document.querySelector("#celFechaOrdeño").innerHTML = objData.data.fechaOrdenio;
					document.querySelector("#celObserv").innerHTML = objData.data.fechaObserv;
					document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

					$('#modalViewProduccion').modal('show');
				}
			 }
		}  


//EDITAR UN registro
  
    function fntEditProduccion(idproduccion){

			document.querySelector('#titleModal').innerHTML = "Actualizar Produccion";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Produccion/getProduccion/'+idproduccion;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status)  
					
				{ 
					document.querySelector("#idProduccion").value = objData.data.idProduccion;
					document.querySelector("#txtCodigo").value =objData.data.codigo;
					document.querySelector("#nomOrdeñador").value = objData.data.nomOrdeniador;
					document.querySelector("#cantLitros").value = objData.data.cantLitro;
					document.querySelector("#horario").value = objData.data.horario;
					document.querySelector("#fechaOrdeño").value = objData.data.fechaOrdenio;
					document.querySelector("#txtObservacion").value = objData.data.fechaObserv;
	
				}
			}
		} 

			 $('#modalFormProduccion').modal('show');

                    							   
			}	


function fntDelProduccion(idproduccion){
	      
          swal({
          			title: "Eliminar tratamiento",
          			text: "¿Realmente quiere eliminar este tratamiento?",
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
					let ajaxUrl = base_url+'/Produccion/delProduccion/';
					let strData = "idProduccion="+idProduccion;
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							let objData = JSON.parse(request.responseText);
							console.log(request.responseText);
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableProduccion.api().ajax.reload(function(){
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
	document.querySelector('#idProduccion').value = "";
	document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML="Nuevo Ordeño";
	document.querySelector("#formProduccion").reset();

	
	
	$('#modalFormProduccion').modal('show');

}

$('#fechaOrdeño').datepicker({

          dateFormat: "yy-mm-dd",	
});
