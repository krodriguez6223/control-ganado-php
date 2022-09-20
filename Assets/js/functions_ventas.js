let tableTratamiento;
let selectorFecha;

document.addEventListener('DOMContentLoaded',function(){

	tableTratamiento = $('#tableTratamiento').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false,
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Tratamiento/getTratamientos",
			"dataSrc":""

		},
		"columns":[
		      {"data":"idTratamiento"},
          {"data":"codigo"},
          {"data":"tipoBanio"},
          {"data":"fechaBanio"},
            {"data":"tipoDesparasitacion"},
          {"data":"fechaDesparasitacion"},  
            {"data":"tipoVacunacion"},
          {"data":"fechaVacunacion"},
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
          		"columns": [0,2,3,4,5,6,7]
          	}
          },{
          	"extend": "excelHtml5",
          	"text": "<i class='fas fa-file-excel'></i>",
          	"titleAttr":"Exportar a excel",
          	"className": "btn btn-success btn-sm",
          	"exportOptions": {
          		"columns": [0,2,3,4,5,6,7]
          	}
          },{
          	"extend": "pdfHtml5",
          	"text": "<i class='fas fa-file-pdf'></i>",
          	"titleAttr":"Exportar a PDF",
          	"className": "btn btn-danger btn-sm",
          	"exportOptions": {
          		"columns": [0,2,3,4,5,6,7]
          	}


          },{
          	"extend": "csvHtml5",
          	"text": "<i class='fas fa-file-csv'></i>",
          	"titleAttr":"Exportar a csv",
          	"className": "btn btn-info btn-sm",
          	"exportOptions": {
          		"columns": [0,2,3,4,5,6,7]
          	}

          },
          {
          	"extend": "print",
          	"text": "<i class='fas fa-print'></i> ",
          	"titleAttr":"Imprimir",
          	"className": "btn btn-primary btn-sm",
          	"exportOptions": {
          		"columns": [0,2,3,4,5,6,7]
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

		if(res == ''){
			return false;
		}else{

			

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Tratamiento/buscarRes';
		let formData = new FormData(formTratamiento);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				console.log(request.responseText);

				let objData = JSON.parse(request.responseText);

				if(objData == '')
				{
					return false;
				}

				if (objData.status) 
				{
	         if (objData.data.status == 1) {

				      let estadoRes = '<span class="badge badge-success">Activo</span>'

					   }else if(objData.data.status == 2){

				    	let estadoRes = '<span class="badge badge-danger">Muerta</span>'

				    	}else if(objData.data.status == 3){

				    	let estadoRes = '<span class="badge badge-warning">Vendida</span>'
				    	

				    	}else{

					    let estadoRes = '<span class="badge badge-info">Descarte</span>'
					  }
					
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
     }
	
	});


// INGRESO DE TRATAMIENTO DE RECES DESDE EL MODAL

	let formTratamiento = document.querySelector("#formTratamiento");
	formTratamiento.onsubmit = function(e){
		e.preventDefault();

		//datos de trataiento baño
					let strTipoBanio = document.querySelector('#tipoBanio').value;
					let strMedicamento = document.querySelector('#tipoMedica').value;
					let strFechaBanio = document.querySelector('#fechaBanio').value;
					let strFechaProxBanio = document.querySelector('#fechaProxBanio').value;
		//datos de trataiento desparasitacion	
					let strTmpDesparasitacion = document.querySelector('#tipoDesparasitacion').value;
					let strTipoDesparasitante = document.querySelector('#tipoDesparasitante').value;
					let strFechaDesparasitacion = document.querySelector('#fechaDesparasitacion').value;
					let strFechaProxDesparasitacion = document.querySelector('#fechaProxDesparasitacion').value;
		//datos de trataiento vacunacion
		      let strTipoVacuna = document.querySelector('#tipoVacuna').value;
					let strNombreVacuna = document.querySelector('#nombreVacuna').value;
					let strFechaVacunacion = document.querySelector('#fechaVacunacion').value;
					let strFechaProxVacuna = document.querySelector('#fechaProxVacuna').value;	

				
	// VALIDACIONES PARA QUE TODOS LOS CAMPOS CON * SEAN OBLIGATORIOS	
	if (document.getElementById("check_tratamientoBaño").checked) {

				if  ( strTipoBanio == '' || strMedicamento == '' || strFechaBanio    == '' ||  strFechaProxBanio == '' )

						{
							swal("Atención", "Todos los campos con (*) asterisco son obligatorios del Tratamiento. Banio", "error");
							return false;
			     }
			  }
		
  if (document.getElementById("check_trataDespa").checked) {
	
			if ( strTmpDesparasitacion == '' || strTipoDesparasitante == '' || strFechaDesparasitacion == '' || strFechaProxDesparasitacion == '' ) 
				{
						swal("Atención", "Todos los campos con (*) asterisco son obligatorios del Tratamiento. Desparacitacion", "error");
						return false;
				}
   } 
 if (document.getElementById("check_trataVacun").checked) {
	 
		 if ( strTipoVacuna == '' || strNombreVacuna == '' || strFechaProxVacuna == '') 
	    {
	    	swal("Atención", "Todos los campos con (*) asterisco son obligatorios del Tratamiento. Vacunación", "error");
				return false;
		 }
  }

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Tratamiento/ingresarTratamiento';
		let formData = new FormData(formTratamiento);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);
				console.log(request.responseText);
			
				if (objData.status) 
				{
					$('#modalFormTratamiento').modal("hide");
					formTratamiento.reset();
					swal("Registro", objData.msg , "success");
					tableTratamiento.api().ajax.reload(function(){
			
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
function fntViewTratamiento(idtratamiento){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Tratamiento/getTratamiento/'+idtratamiento;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				  let objData = JSON.parse(request.responseText);

					document.querySelector("#celCodigo").innerHTML = objData.data.codigo;

					//tratamiento Baño
					document.querySelector("#celTipoBanio").innerHTML = objData.data.tipoBanio;
					document.querySelector("#celTipoMedicina").innerHTML = objData.data.tipoMedicina;
					document.querySelector("#celFechaBanio").innerHTML = objData.data.fechaBanio;
					document.querySelector("#celFechaProxBanio").innerHTML = objData.data.fechaProxBanio;
					document.querySelector("#celObservBanio").innerHTML = objData.data.obserBanio;

					//tratamiento Desparasitacion
					document.querySelector("#celTipoDesparasitacion").innerHTML = objData.data.tipoDesparasitacion;
					document.querySelector("#celTipoDesparasitante").innerHTML = objData.data.tipoDesparasitante;
					document.querySelector("#celFechaDesparasitación").innerHTML = objData.data.fechaDesparasitacion;
					document.querySelector("#celFechaProxDesparasitacion").innerHTML = objData.data.fechaProxDesparasitacion;
					document.querySelector("#celObservDesparasitacion").innerHTML = objData.data.observDesparasitacion;
					
					//tratamiento vacunacion
					document.querySelector("#celTipoVacunacion").innerHTML = objData.data.tipoVacunacion;
					document.querySelector("#celNomVacuna").innerHTML = objData.data.nomVacuna;
					document.querySelector("#celFechaVacunacion").innerHTML = objData.data.fechaVacunacion;
					document.querySelector("#celFechaProxVacunacion").innerHTML = objData.data.fechaProxVacunacion;
					document.querySelector("#celObservVacunacion").innerHTML = objData.data.obserVacunacion;

					document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

					$('#modalViewTratamiento').modal('show');
				}else{
					swal("Error", objData.msg , "error");
				 
  				}
			 }
		}  

		//VER LOS DATOS DE CADA TRATAMIENTRO DEL GANADO REGISTRADO
function btnViewPDF(idtrata){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Tratamiento/getTratamiento/'+idtrata;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				  let objData = JSON.parse(request.responseText);


				    //generarPDF(objData.data.idTratamiento, objData.data.codigo, objData.data.tipoBanio)

				   // location.reload();

					console.log(request.responseText);

					document.querySelector("#celCodigo").innerHTML = objData.data.codigo;

					$('#modalViewsTratamiento').modal('show');
				//	location.href="PDF/imprimir.php";
				
				}
			 }
		}  
			
	
	//CARGA LOS DATOS EN EL MODAL PARA EDITAR EL TRATAMIENTO
    function fntEditTratamiento(idtratamiento){

			document.querySelector('#titleModal').innerHTML = "Actualizar Tratamiento";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Tratamiento/getTratamiento/'+idtratamiento;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status)  
					
				{ 
					document.querySelector("#idTratamiento").value = objData.data.idTratamiento;
					document.querySelector("#txtCodigo").value =objData.data.codigo;
				
				//tratamiento baño
				  if (document.querySelector("#tipoBanio").value =objData.data.tipoBanio) {

				  	  document.getElementById("check_tratamientoBaño").checked = true;
				  	  document.getElementById('tipoBanio').disabled = false;
				  	  document.getElementById('tipoMedica').disabled = false;
				  	  document.getElementById('fechaBanio').disabled = false;
				  	  document.getElementById('fechaProxBanio').disabled = false;
				  	  document.getElementById('txtObservacion').disabled = false;

				  }else{
				  	  document.getElementById("check_tratamientoBaño").checked = false;
				  	  document.getElementById('tipoBanio').disabled = true;
				  	  document.getElementById('tipoMedica').disabled = true;
				  	  document.getElementById('fechaBanio').disabled = true;
				  	  document.getElementById('fechaProxBanio').disabled = true;
				  	  document.getElementById('txtObservacion').disabled = true;

				  }

					document.querySelector("#tipoBanio").value =objData.data.tipoBanio;
					document.querySelector("#tipoMedica").value =objData.data.tipoMedicina;					
					document.querySelector("#fechaBanio").value =objData.data.fechaBanio;				
					document.querySelector("#fechaProxBanio").value =objData.data.fechaProxBanio;		
					document.querySelector("#txtObservacion").value =objData.data.obserBanio;			
				
				//tratamiento desparasitacion
					if (document.querySelector("#tipoDesparasitacion").value =objData.data.tipoDesparasitacion) {

				  	  document.getElementById("check_trataDespa").checked = true;
				  	  document.getElementById('tipoDesparasitacion').disabled = false;
				  	  document.getElementById('tipoDesparasitante').disabled = false;
				  	  document.getElementById('fechaDesparasitacion').disabled = false;
				  	  document.getElementById('fechaProxDesparasitacion').disabled = false;
				  	  document.getElementById('observDesparasitacion').disabled = false;
				  }else{
				  	  document.getElementById("check_trataDespa").checked = false;
				  	  document.getElementById('tipoDesparasitacion').disabled = true;
				  	  document.getElementById('tipoDesparasitante').disabled = true;
				  	  document.getElementById('fechaDesparasitacion').disabled = true;
				  	  document.getElementById('fechaProxDesparasitacion').disabled = true;
				  	  document.getElementById('observDesparasitacion').disabled = true;

				  }

					document.querySelector("#tipoDesparasitacion").value =objData.data.tipoDesparasitacion;
					document.querySelector("#tipoDesparasitante").value =objData.data.tipoDesparasitante;					
					document.querySelector("#fechaDesparasitacion").value =objData.data.fechaDesparasitacion;				
					document.querySelector("#fechaProxDesparasitacion").value =objData.data.fechaProxDesparasitacion;		
					document.querySelector("#observDesparasitacion").value =objData.data.observDesparasitacion;			
				
				}
				//tratamiento vacunacion
					if (document.querySelector("#nombreVacuna").value =objData.data.nomVacuna) {

				  	  document.getElementById("check_trataVacun").checked = true;
				  	  document.getElementById('nombreVacuna').disabled = false;
				  	  document.getElementById('tipoVacuna').disabled = false;
				  	  document.getElementById('fechaVacunacion').disabled = false;
				  	  document.getElementById('fechaProxVacuna').disabled = false;
				  	  document.getElementById('observVacunacion').disabled = false;
				  }else{
				  	  document.getElementById("check_trataVacun").checked = false;
				  	  document.getElementById('nombreVacuna').disabled = true;
				  	  document.getElementById('tipoVacuna').disabled = true;
				  	  document.getElementById('fechaVacunacion').disabled = true;
				  	  document.getElementById('fechaProxVacuna').disabled = true;
				  	  document.getElementById('observVacunacion').disabled = true;

				  }

					document.querySelector("#nombreVacuna").value =objData.data.nomVacuna;
					document.querySelector("#tipoVacuna").value =objData.data.tipoVacunacion;					
					document.querySelector("#fechaVacunacion").value =objData.data.fechaVacunacion;				
					document.querySelector("#fechaProxVacuna").value =objData.data.fechaProxVacunacion;		
					document.querySelector("#observVacunacion").value =objData.data.obserVacunacion;			
				
				}
			} 
			 $('#modalFormTratamiento').modal('show');
                    							   
			}	

//eliminar un usuario

function fntDelGanado(idtratamiento){
	       
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
					let ajaxUrl = base_url+'/Tratamiento/delTratamiento/';
					let strData = "idTratamiento="+idTratamiento;
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							let objData = JSON.parse(request.responseText);
							console.log(request.responseText);
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableTratamiento.api().ajax.reload(function(){
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
	document.querySelector('#idTratamiento').value = "";
	document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML="Nuevo Tratamiento";
	document.querySelector("#formTratamiento").reset();

	
	
	$('#modalFormTratamiento').modal('show');

}








