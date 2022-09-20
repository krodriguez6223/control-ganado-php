let tableGanado;
let selectorFecha; 

document.addEventListener('DOMContentLoaded',function(){

/*========================================================
    subida de imagen para el registro de ganado
==========================================================*/

if(document.querySelector("#foto")){
    let foto = document.querySelector("#foto");
    foto.onchange = function(e) {
       
        let uploadFoto = document.querySelector("#foto").value;
        let fileimg = document.querySelector("#foto").files;
        let nav = window.URL || window.webkitURL;
        let contactAlert = document.querySelector('#form_alert');
        
        if(uploadFoto !=''){
           
            let type = fileimg[0].type;
            let name = fileimg[0].name;
            
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
               
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                
                if(document.querySelector('#img')){
                 
                document.querySelector('#img').remove();
                }
                
                document.querySelector('.delPhoto').classList.add("notBlock");
                
                foto.value="";
                
                return false;
           
        }else{  
                contactAlert.innerHTML='';
                   
                if(document.querySelector('#img')){
                document.querySelector('#img').remove();
                
                }
                    
                document.querySelector('.delPhoto').classList.remove("notBlock");
                   
                let objeto_url = nav.createObjectURL(this.files[0]);
                    
                document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
               
                }
        }else{
            
            alert("No selecciono foto");
           
            if(document.querySelector('#img')){
                document.querySelector('#img').remove();

            }
        }
    }
}

if(document.querySelector(".delPhoto")){
   
			    let delPhoto = document.querySelector(".delPhoto");
			    delPhoto.onclick = function(e) {
			    	
			    	document.querySelector("#foto_remove").value = 1;
			        
			        removePhoto();
    }
}

/*========================================================
    MOSTRAR: la tabla de ganados registrado en el datatable
==========================================================*/

tableGanado = $('#tableGanado').dataTable({
		
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false,
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Ganado/getGanados",
			"dataSrc":""

		},
		"columns":[
		  {"data":"idganado"},
          {"data":"codigo"},
          {"data":"nombres"},
          {"data":"peso"},
          {"data":"raza"},
          {"data":"categoria"},
          {"data":"status"},
          {"data": "foto",
                   "render": function(url_fotoRes) {
                    return '<img  id="tamano"src="Assets/images/uploads/'+url_fotoRes+'" />';
        }},  
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
          	"text": "<i class='fas fa-file-pdf'></i>",
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
/*=============================================
    REGISTRO: de ganado
=============================================*/

if(document.querySelector("#formGanado")){

let formGanado = document.querySelector("#formGanado");
formGanado.onsubmit = function(e){
		e.preventDefault();

		let intCodigo = document.querySelector('#txtCodigo').value;	
		let strNombre = document.querySelector('#txtNombre').value;
		let intPesoRes = document.querySelector('#pesoRes').value;
		let strRaza = document.querySelector('#listRaza').value;
		let strCategoria = document.querySelector('#listCategoria').value;
		let strOrigen = document.querySelector('#listOrigen').value;
		let strLote = document.querySelector('#listLote').value;
		let strFechaNacimiento = document.querySelector('#fechaNacimiento').value;
		let strEstado = document.querySelector('#listStatus').value;

		if (intCodigo == '' ||
		    strNombre == '' || 
		   intPesoRes == '' || 
		   strRaza    == '' || 
		 strCategoria == '' || 
		 strOrigen    == '' || 
		 strLote      == '' ||
   strFechaNacimiento == '' ||
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
		let ajaxUrl = base_url+'/Ganado/ingresarGanado';
		let formData = new FormData(formGanado);
		
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{

					$('#modalFormGanado').modal("hide");
					
					formGanado.reset();

					swal("Registro", objData.msg , "success");

					tableGanado.api().ajax.reload(function(){
						removePhoto();
			
					});

					}else{
						
						swal("Error", objData.msg , "error");
					}

				}
			}
		}
	}		

	}, false);


window.addEventListener("load", function() {
    
        setTimeout(() => { 
      
    }, 500);

  }, false);


/*===========================================================
    VER: Funciión para mostrar los datos registrado en el modal
=============================================================*/

function fntViewGanado(idganado){

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Ganado/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();

			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);


				if (objData.status) 
				{ 

					if (objData.data.status == 1) {
 
				             var estadoRes = '<span class="badge badge-success">Activo</span>'

					}else if(objData.data.status == 2){

					         var estadoRes = '<span class="badge badge-danger">Muerta</span>'

					}else if(objData.data.status == 3){

							 var estadoRes = '<span class="badge badge-warning">Vendida</span>'
					}else{

							 var estadoRes = '<span class="badge badge-info">Descarte</span>'
					}
				
					document.querySelector("#celCodigo").innerHTML = objData.data.codigo;
					document.querySelector("#celNombre").innerHTML = objData.data.nombres;
					document.querySelector("#celPesoRes").innerHTML = objData.data.peso;
					document.querySelector("#celRaza").innerHTML = objData.data.raza;
					document.querySelector("#celCategoria").innerHTML = objData.data.categoria;
					document.querySelector("#celOrigen").innerHTML = objData.data.origen;
					document.querySelector("#celLote").innerHTML = objData.data.lote;
					document.querySelector("#celFechaNacimiento").innerHTML = objData.data.fecha_nacimiento;
					document.querySelector("#celEstado").innerHTML = estadoRes;
					document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
					document.querySelector("#celObservacion").innerHTML = objData.data.observacion;
					document.querySelector("#celMortalidad").innerHTML = objData.data.mortalidad;
				    document.querySelector("#celFoto").innerHTML = '<img src="'+objData.data.url_fotoRes+'"></img>';
				
					
					$('#modalViewGanado').modal('show');

				}else{
					swal("Error", objData.msg , "error");
				 
  				}
			 }
		}  
			
	}


/*==========================================================================
    CONFIGURACION: Funciión para ingresar nuesvas razas y categoria del registro de ganado
=============================================================================*/

function fntConfGanado(){

$('#modalViewConfig').modal("show");
document.querySelector("#formConf").reset();

	let formConf = document.querySelector("#formConf");
	formConf.onsubmit = function(e){
		e.preventDefault();

		let elementsValid = document.getElementsByClassName("valid");
		
		for(let i =0; i < elementsValid.length; i++){
			if (elementsValid[i].classList.contains('is-invalid')){
				swal("Atencion", "Por favor verifique los campos en rojo", "error");
				return false;
			}	
		}

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Ganado/ingresarConfig';
		let formData = new FormData(formConf);
		
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{
					$('#modalViewConfig').modal("hide");
					
					formGanado.reset();
					
					swal("Registro", objData.msg , "success");
				
					tableGanado.api().ajax.reload(function(){

						});
					}
					
					else{
						
						swal("Error", objData.msg , "error");
				}

			}
		}
	}		

}
			
/*==========================================================================
   EDITAR:  Funciión para editar los registros de un ganado
=============================================================================*/

    function fntEditGanado(idganado){

			document.querySelector('#titleModal').innerHTML = "Actualizar Ganado";
			document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
			document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
			document.querySelector('#btnText').innerHTML= "Actualizar";

			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Ganado/getGanado/'+idganado;
		
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
			
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{ 
					document.querySelector("#idGanado").value = objData.data.idganado;
					document.querySelector("#txtCodigo").value =objData.data.codigo;
					document.querySelector("#txtNombre").value =objData.data.nombres;
					document.querySelector("#pesoRes").value =objData.data.peso;
					document.querySelector("#listRaza").value =objData.data.raza;
					$('#listRaza').selectpicker('render');
					
					document.querySelector("#listCategoria").value =objData.data.categoria;
					$('#listCategoria').selectpicker('render');
					
					document.querySelector("#listOrigen").value =objData.data.origen;
					$('#listOrigen').selectpicker('render');
					
					document.querySelector("#listLote").value =objData.data.lote;
					$('#listLote').selectpicker('render');
					
					document.querySelector("#fechaNacimiento").value =objData.data.fecha_nacimiento;
					document.querySelector("#listStatus").value =objData.data.status;
					$('#listStatus').selectpicker('render');
					
					$("#listStatus").change(function() {

						$('#listMortalidad').prop('disabled', false);
     
				      if($("#listStatus").val() == "2"){
				       
				        $('#listMortalidad').prop('disabled', false);

				      }else{

				        $('#listMortalidad').prop('disabled', 'disabled');
				        $("#listMortalidad").val('').trigger('change');
				       
				      }

				    });
				    document.querySelector("#listMortalidad").value =objData.data.mortalidad;
					document.querySelector("#txtObservacion").value =objData.data.observacion;
					document.querySelector("#foto_Actual").value =objData.data.foto;
					document.querySelector("#foto_remove").value = 0;

					if (document.querySelector('#img')) {
					  
					     	document.querySelector('#img').src = objData.data.url_fotoRes;
					 
					 }else{
					 		document.querySelector('.prevPhoto div').innerHTML = "<img id='img'src="+objData.data.url_fotoRes+">";
					 }
					 if (objData.data.foto == 'vacaPortada.jpg') {
					 
					 		document.querySelector('.delPhoto').classList.add("notBlock");
					 }else{
					 	
					 		document.querySelector('.delPhoto').classList.remove("notBlock");
					 }
				}
			} 
			 
			 $('#modalFormGanado').modal('show');    							   
	}	
}

/*==========================================================================
    ELIMINAR: Funciión para eliminar los registro de un ganado
=============================================================================*/

function fntDelGanado(idganado){
	
          
          swal({
          			title: "Eliminar res",
			        text: "¿Realmente quiere eliminar la res?",
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
            let ajaxUrl = base_url+'/Ganado/delGanado/';
            let strData = "idganado="+idganado;
					
			request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
						
						if(request.readyState == 4 && request.status == 200){


							var objData = JSON.parse(request.responseText);
								
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableGanado.api().ajax.reload();

							} else{ 

							swal("Atencion!", objData.msg, "error");
							}
						}
					}
				}
			});
	    }

/*==========================================================================
   REMOVER FOTO:  Funciión para remover foto en el modal de registro de ganado
=============================================================================*/
		
		function removePhoto(){
		    document.querySelector('#foto').value ="";
		    document.querySelector('.delPhoto').classList.add("notBlock");
		    if (document.querySelector('#img')) {
		    	  document.querySelector('#img').remove();
		    }
		  
		}

/*============================================================================================
    LEVANTAR MODAL: Funcion para abrir el modal dependiendo si va a actulizar o a ingresar un nuevo registro
===============================================================================================*/
	  $('#tableGanado').DataTable();

	function openModal()
{
	
	document.querySelector('#idGanado').value = "";
	document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#titleModal').innerHTML="Nueva res";
	document.querySelector("#formGanado").reset();
	removePhoto();


/*============================================================================================
    limpia los campos de los select al abri el modal cuando se va a registrar una res
===============================================================================================*/
	
	$("#listEspecie").val('').trigger('change');
	$("#listRaza").val('').trigger('change');
	$("#listCategoria").val('').trigger('change');
	$("#listPelaje").val('').trigger('change');
	$("#listOrigen").val('').trigger('change');
	$("#listLote").val('').trigger('change');
	$("#listStatus").val('').trigger('change');
	$("#listMortalidad").val('').trigger('change');
    $('#listMortalidad').prop('disabled', true);


	$('#modalFormGanado').modal('show');

}

/*=============================================
  Registro de ganado fecha de nacimiento
=============================================*/

$('#fechaNacimiento').datepicker({
    		autoclose: true,	
          language: "es",	
});

/*=============================================================================
  Funcion para habilitar select de causa de mortalidad en el registro de ganado
===============================================================================*/


$("#listStatus").change(function() {
     
      if($("#listStatus").val() == "2"){
       
        $('#listMortalidad').prop('disabled', false);

      }else{

        $('#listMortalidad').prop('disabled', 'disabled');
       
     }

});

/*=============================================
  Funcion para levantar modal de configuracion 
=============================================*/

function modalShow(){

	$('#exampleModal').on('show.bs.modal', function (event) {
  
  let button = $(event.relatedTarget) 
  let recipient = button.data('whatever') 
  let modal = $(this)
 
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)

})

}
