

document.addEventListener('DOMContentLoaded',function(){

let divLoading = document.querySelector("#divLoading");
let formPerfil = document.querySelector("#formPerfil");
	formPerfil.onsubmit = function(e){
		e.preventDefault();

		let intCedula = document.querySelector('#txtCedula').value;	
		let strNombre = document.querySelector('#txtNombre').value;
		let strApellido = document.querySelector('#txtApellido').value;
		let intTelefono = document.querySelector('#txtTelefono').value;
		let strPassword = document.querySelector('#txtPassword').value;
		let strPasswordConfim = document.querySelector('#txtConfirmPassword').value;
		

		if (intCedula == '' || strNombre == '' || strApellido == ''  ||  intTelefono=='') 
		{
			swal("Atención", "Todos los campos son obligatorios.", "error");
			return false;
		}

		if (strPassword != "" || strPasswordConfim !="") 
		{
			if (strPassword != strPasswordConfim){
				swal("Atención", "Las contraseñas no son iguales.", "info");
				return false;
			}
			if (strPassword.length < 8) {
				swal("Atención", "La contraseña debe tener un mímino de 8 caracteres.", "info");
				return false;
			}
		}

		let elementsValid = document.getElementsByClassName("valid");
		for(let i = 0; i < elementsValid.length; i++){
			if (elementsValid[i].classList.contains('is-invalid')){
				swal("Atencion", "Por favor verifique los campos en rojo", "error");
				return false;
			}	
		}
        divLoading.style.display= "flex";
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Perfil/actualizarPerfil';
		let formData = new FormData(formPerfil);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
			if (request.readyState != 4) return;
			if(request.status ==200){

				let objData = JSON.parse(request.responseText);

				if (objData.status) 
				{
					$('#modalFormPerfil').modal("hide");
					
					swal({
						title: "",
						text: objData.msg,
						type: "success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: false,

					},function(isConfirm){
						if (isConfirm) {
							location.reload();
						}
					});
			
					
					}else{
						swal("Error", objData.msg , "error");
					}
					
					divLoading.style.display = "none";
                    return false;
				}
			}
		}		

	},false);




let formFoto = document.querySelector("#formFoto");
     formFoto.onsubmit = function(e){
		e.preventDefault();

		let fotoPerfil = document.querySelector('#fotoPerfil').value;
		let fileimg = document.querySelector("#fotoPerfil").files;
        let nav = window.URL || window.webkitURL;	
		
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		let ajaxUrl = base_url+'/Perfil/actualizarFoto';
		let formData = new FormData(formFoto);

		request.open("POST",ajaxUrl,true);
		request.send(formData);


		request.onreadystatechange = function(){
			
			if (request.readyState == 4 && request.status == 200){

				let objData = JSON.parse(request.responseText);

			if (objData.status) 
				{
						swal({
						title: "",
						text: objData.msg,
						type: "success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: false,

					},function(isConfirm){
						if (isConfirm) {
							location.reload();
						}
					});
			
					
					}else{
						swal("Error", objData.msg , "error");
					}

				}
			}
		}		

	


function openModalPerfil()
{
    	$('#modalFormPerfil').modal('show');
} 

  /*=============================================
    Validamoa imagen de subida del usuario
  =============================================*/
    function validateImageJS(event, input){

     let image = event.target.files[0];

    if (image["type"] !== "image/png" && image["type"] !== "image/jpeg" && image["type"] !== "image/gif") {
      
       
    		swal("Atención", "La imagen debe ser en formato JPG, PNG o GIF." , "error");

        return;
    }

    else if(image["size"] > 2000000){

    	swal("Atención", "La imagen debe ser no mayor a 2MB." , "error");

      return;
    
    }else{

      let data = new FileReader();
      data.readAsDataURL(image);

      $(data).on("load", function(event){

        let path = event.target.result;

        $("."+input).attr("src", path);
        
      })

    }

    }