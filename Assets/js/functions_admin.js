function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    else if (tecla==0||tecla==9)  return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n); 
}

function testText(txtString){
    let stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant){
    let intCantidad = new RegExp(/^([0-9])*$/);
    if(intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function fntEmailValidate(email){
    let stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}

function fntValidText(){
	let validText = document.querySelectorAll(".validText");
    validText.forEach(function(validText) {
        validText.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!testText(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}				
		});
	});
}

function fntValidNumber(){
	let validNumber = document.querySelectorAll(".validNumber");
    validNumber.forEach(function(validNumber) {
        validNumber.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!testEntero(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
				
			}				
		});
	});
}

function fntValidEmail(){
	let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function(validEmail) {
        validEmail.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!fntEmailValidate(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
				
			}				
		});
	});
}
/*
function validar() {

		   let cad = document.getElementById('validNumber').value.trim();
	        let total = 0;
	        let longitud = cad.length;
	        let longcheck = longitud - 1;

	        if (cad !== "" && longitud === 10){
	          for(i = 0; i < longcheck; i++){
	            if (i%2 === 0) {
	              let aux = cad.charAt(i) * 2;
	              if (aux > 9) aux -= 9;
	              total += aux;
	            } else {
	              total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
          }
}
          total = total % 10 ? 10 - total % 10 : 0;

          if (cad.charAt(longitud-1) == total) {
            swal("Atencion", "Cédula invalida", "error");
            return false;
          }
        }
*/
window.addEventListener('load', function() {
	fntValidText();
	fntValidEmail(); 
	fntValidNumber();
	
}, false);