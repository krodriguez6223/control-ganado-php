 <?php 
/*=============================================
=  Devuelve la direcion URL del sistemas  =
=============================================*/

function base_url()
	{
		return BASE_URL;
	}

/*=============================================
=  Devuelve la direcion URL de assets  =
=============================================*/

function media()
	{
		
		return BASE_URL."/Assets";
	}

/*=============================================
=  Funcion para imprimir en formato un array
=============================================*/
function dep($data)
	{
		$format  = print_r('<pre>');
		$format .= print_r($data);
		$format .= print_r('</pre>');
		return $format;
	}

/*======================================================
=  funcion que devuelve la el header de la plantilla  =
=======================================================*/

function headerAdmin($data="")
	{
		$view_header = "Views/Template/header_admin.php";
		require_once($view_header);
	}

/*======================================================
=  funcion que devuelve la el footer de la plantilla  =
========================================================*/

function footerAdmin($data="")
	{
		$view_footer = "Views/Template/footer_admin.php";
		require_once($view_footer);
	}

/*======================================================
=  funcion que hace el llamado del modal a la vista   =
========================================================*/

function getModal(string $nameModal, $data)
	{
		
		$view_modal = "Views/Template/Modals/{$nameModal}.php";
		require_once $view_modal;
	}

/*======================================================
		=  funcion que retorna file 		 =
========================================================*/

function getFile(string $url, $data)
	{
		ob_start();
		require_once("Views/{$url}.php");
		$file = ob_get_clean();
		return $file;
	}

/*======================================================
=  funcion un array de los datos de session logueado  =
========================================================*/

function sessionUser(int $idpersona)
	{
		
		require_once ("Models/LoginModel.php");
		$objLogin = new LoginModel();
		$request = $objLogin->sessionLogin($idpersona);
		return $request;
	}

/*======================================================
=  funcion que permite almacenar las imagenes del ganado  =
========================================================*/
 function uploadImage(array $data, string $name)
 	{
      
        $url_temp = $data['tmp_name'];
        $destino    = 'Assets/images/uploads/'.$name;        
        $move = move_uploaded_file($url_temp, $destino);
        return $move;
    }
/*======================================================
=  funcion que almacena la foto de los usuarios  =
========================================================*/   
 
 function uploadImageUser(array $data, string $name)
	{
	    $url_temp = $data['tmp_name'];
	    $destino    = 'Assets/images/users/'.$name;        
	    $move = move_uploaded_file($url_temp, $destino);
	    return $move;
	}

/*======================================================
=  funcion que eliminar archivos de un repositorio  =
========================================================*/

function deleteFile(string $name)
	{
	      
	     unlink('Assets/images/uploads/'.$name);
	}

/*================================================================
=  funcion que envia correo para la recuperacion de contraseñas  =
=================================================================*/
   
function sendEmail($data,$template)
    
    {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }

/*======================================================
=  funcion que devuelve la el footer de la plantilla  =
========================================================*/
  
function getPermisos(int $idmodulo)
    {
    	
    	require_once ("Models/PermisosModel.php");

    	$objPermisos = new PermisosModel();
    	$idrol = $_SESSION['userData']['idrol'];
    	$arrPermisos = $objPermisos->permisosModulo($idrol);
    	$permisos = '';
    	$permisosMod = '';
    	if (count($arrPermisos) > 0) {
    		$permisos = $arrPermisos;
    		$permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo]: "";
    	}
    	
    	$_SESSION['permisos'] = $permisos;
    	$_SESSION['permisosMod'] = $permisosMod;
    }
/*======================================================
=  funcion que devuelve los meses del año en un array  =
========================================================*/

function Meses()
	{
    	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    	return $meses;
    }

/*=====================================================================
=  funcion que devuelve un array para las notificaciones en el header  =
=======================================================================*/

function notCantTraHead()
	{

	    require_once ("Models/NotificacionTrataModel.php");

	    $objNoti = new NotificacionTrataModel();

	    $baño = $objNoti->cantTraBaño();
	    $deparacitacion = $objNoti->cantTraDesparacitacion();
	    $vacunacion = $objNoti->cantTraVacunacion();

	    $data = array('baño' => $baño,
	    				  'desparacitacion' => $deparacitacion,
	    				  'vacunacion' =>$vacunacion );
		return $data;
	}
/*======================================================================================
=  funcion que limpiar caracteres para evitar inyeccion sql en los input de registros  =
=======================================================================================*/

function strClean($strCadena)
	{
	
		$string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
		$string = trim($string);//Elimina espacios en blanco al inicio
		$string = stripslashes($string);//elimina las \ invertidas
		$string = str_ireplace("<script>","",$string);
		$string = str_ireplace("</script>","",$string);
		$string = str_ireplace("<script src>","",$string);
		$string = str_ireplace("<script type=>","",$string);
		$string = str_ireplace("SELECT *FROM","",$string);
		$string = str_ireplace("DELETE FROM","",$string);
		$string = str_ireplace("INSERT INTO","",$string);
		$string = str_ireplace("SELECT COUNT(*) FROM","",$string);
		$string = str_ireplace("DROP TABLE","",$string);
		$string = str_ireplace("OR '1'='1","",$string);
		$string = str_ireplace('OR "1"="1"',"",$string);
		$string = str_ireplace('OR ´1´=´1´',"",$string);
		$string = str_ireplace("is NULL; --","",$string);
		$string = str_ireplace("is NULL; --","",$string);
		$string = str_ireplace("LIKE '","",$string);
		$string = str_ireplace('LIKE "',"",$string);
		$string = str_ireplace("LIKE ´","",$string);
		$string = str_ireplace("OR 'a'='a","",$string);
		$string = str_ireplace('OR "a"=a"',"",$string);
		$string = str_ireplace("OR ´a´=´a","",$string);
		$string = str_ireplace("OR ´a´=´a","",$string);
		$string = str_ireplace("--","",$string);
		$string = str_ireplace("^","",$string);
		$string = str_ireplace("[","",$string);
		$string = str_ireplace("]","",$string);
		$string = str_ireplace("==","",$string);

		return $string;
	}

/*========================================================================================
=  funcion para generar una cadena de caracteres aleatorios para encriptar un password  =
=========================================================================================*/
function  passGenerator($lenght = 10)

	{
		$pass = "";
		$longitudPass=$lenght;
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstivwxyz1234567890";
		$longitudCadena = strlen($cadena);

		for($i=1; $i<=$longitudPass; $i++)
		{
			$pos = rand(0,$longitudCadena-1);
			$pass .=substr($cadena, $pos,1);
		}
		return $pass;
	}

/*======================================================
=  funcion que devuelve un token  =
========================================================*/
  function token()
	{
	  	$r1 = bin2hex(random_bytes(10));
	  	$r2 = bin2hex(random_bytes(10));
	  	$r3 = bin2hex(random_bytes(10));
	  	$r4 = bin2hex(random_bytes(10));
	  	$token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
	  	return $token;
	}

/*======================================================
=  funcion que devuelve la el formato de moneda   =
========================================================*/
   
   function formatoMoney($cantidad){
   	$cantidad = number_format($cantidad,2,SPD,SPM);
   	return $cantidad;
   }
   //Zona horaria
   date_default_timezone_set('America/Guayaquil');

 ?>
