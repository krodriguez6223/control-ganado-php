let tableInventario;
let selectorFecha;

document.addEventListener('DOMContentLoaded',function(){

	tableInventario = $('#tableInventario').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"autoWidth": false, 
		"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url":" "+base_url+"/Inventario/getGanados",
			"dataSrc":""

		},
		"columns":[
          {"data":"codigo"},
          {"data":"nombre"},
          {"data":"stock"},
          {"data":"categoria"},  
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
                "columns": [0,1,2,3,4]
            }
          },{
          	"extend": "excelHtml5",
          	"text": "<i class='fas fa-file-excel'></i>",
          	"titleAttr":"Exportar a excel",
          	"className": "btn btn-success btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4]
            }
          },{
          	"extend": "pdfHtml5",
          	"text": "<i class='fas fa-file-pdf'></i>",
          	"titleAttr":"Exportar a PDF",
          	"className": "btn btn-danger btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4]
            }

          },{
          	"extend": "csvHtml5",
          	"text": "<i class='fas fa-file-csv'></i>",
          	"titleAttr":"Exportar a csv",
          	"className": "btn btn-info btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4]
            }

          },{
          	"extend": "print",
          	"text": "<i class='fas fa-print'></i> ",
          	"titleAttr":"Imprimir",
          	"className": "btn btn-primary btn-sm",
          	"exportOptions": {
                "columns": [0,1,2,3,4]
            }

          }

           ],
		"responsive":"true",
		"bDestroy":true,
		"aLengthMenu":[[3,10,20,50,100],[3,10,20,50,100]],
		"order":[[0,"desc"]]
	});

	let formInventario = document.querySelector("#formInventario");
	formInventario.onsubmit = function(e){
		e.preventDefault();

		let intCodigo = document.querySelector('#txtCodigo').value;	
		let strNombre = document.querySelector('#txtNombre').value;
		let intStock = document.querySelector('#txtStock').value;
		let strCategoria = document.querySelector('#listCategoria').value;
		let strEstado = document.querySelector('#listStatus').value;
		let strDescripcion = document.querySelector('#txtDescripcion').value;
		
			
		if (intCodigo == '' ||
		    strNombre == '' || 
		     intStock == '' || 
		 strCategoria == '' || 
            strEstado == '') 
		{
			swal("Atención", "Todos los campos son obligatorios.", "error");
			return false;
		}

		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Inventario/ingresarGanado';
		let formData = new FormData(formInventario);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState == 4 && request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{
					$('#modalFormInventario').modal("hide");
					formInventario.reset();
					swal("Registro", objData.msg , "success");
					tableInventario.api().ajax.reload(function(){
			
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
			let ajaxUrl = base_url+'/Inventario/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();

             console.log(request);
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);   

				if (objData.status) 
				{ 

					if (objData.data.status == 1) {

				      var estadoInventario = '<span class="badge badge-success">Activo</span>'

					}else {

							var estadoInventario = '<span class="badge badge-danger">Inactivo</span>'

					}
				
					document.querySelector("#celCodigo").innerHTML = objData.data.codigo;
					document.querySelector("#celNombre").innerHTML = objData.data.nombre;
					document.querySelector("#celStock").innerHTML = objData.data.stock;
					document.querySelector("#celCategoria").innerHTML = objData.data.categoria;
					document.querySelector("#celEstado").innerHTML = estadoInventario;
					document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
					document.querySelector("#celFoto").innerHTML = objData.data.foto;
					
					
					$('#modalViewInventario').modal('show');
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
			let ajaxUrl = base_url+'/Inventario/getGanado/'+idganado;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if (request.readyState == 4 && request.status ==200){
				
				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{ 
					document.querySelector("#idGanado").value = objData.data.idganado;
					document.querySelector("#txtCodigo").value =objData.data.codigo;
					document.querySelector("#txtNombre").value =objData.data.nombre;
					document.querySelector("#txtStock").value =objData.data.stock;
					document.querySelector("#listStatus").value =objData.data.status;
					$('#listStatus').selectpicker('render');
					document.querySelector("#listCategoria").value =objData.data.categoria;
					$('#listCategoria').selectpicker('render');
					document.querySelector("#txtDescripcion").value =objData.data.descripcion;
					document.querySelector("#fotoProducto").value =objData.data.foto;
					
				}
			} 
			 $('#modalFormInventario').modal('show');
                    							   
			}	
	     }

//eliminar un usuario

function fntDelGanado(idganado){
          
          swal({
          			title: "Eliminar producto",
          			text: "¿Realmente quiere eliminar este producto?",
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
					let ajaxUrl = base_url+'/Inventario/delGanado/';
					let strData = "idGanado="+idGanado;
					request.open("POST",ajaxUrl,true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(strData);
					request.onreadystatechange = function(){
						if(request.readyState == 4 && request.status == 200){
							let objData = JSON.parse(request.responseText);
							if(objData.status){

								swal("Eliminar!", objData.msg, "success");
								tableInventario.api().ajax.reload(function(){
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
	document.querySelector('#titleModal').innerHTML="Nuevo producto";
	document.querySelector("#formInventario").reset();


	$("#listCategoria").val('').trigger('change');
	$("#listStatus").val('').trigger('change');
	
	$('#modalFormInventario').modal('show');

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



