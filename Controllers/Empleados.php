
<?php

class Empleados extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start();
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		//Permite la obtencion del modulo correspondiente y sus permisos
		getPermisos(7);
	}
	public function Empleados ($parems){

		 if (empty($_SESSION['permisosMod']['r']))
			{
				header('Location: '.base_url().'/dashboard');
			} 

		$data['page_tage'] = "Empleado"; 
		$data['page_name'] = "empleado";
		$data['page_title'] ="Registro de empleados ";
		$data['page_function_js'] ="functions_empleado.js";
		$this->views->getView($this,"empleados",$data);
	
	}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar

	public function ingresarGanado(){
		
 
	     if ($_POST) {

	     	  if (    empty($_POST['txtCedula']) ||
	     	         empty($_POST['txtNombres']) || 
	     	       empty($_POST['txtApellidos']) || 
	     	          empty($_POST['txtCorreo']) || 
	     	        empty($_POST['txtContacto']) || 
	     	            empty($_POST['txtEdad']) || 
	     	           empty($_POST['txtCargo']) || 
	     	         empty($_POST['listStatus'])  
	    
	     	     ) 

	     	   {

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos.' );
	     	  
	     	  }else{

		     	    /*=============================================
					VALIDACIÓN FOTO LADO SERVIDOR
					=============================================*/

				if(isset($_FILES["fotoRes"]["tmp_name"]) && !empty($_FILES["fotoRes"]["tmp_name"]))

				    {

					/*=============================================
					CAPTURAR ANCHO Y ALTO ORIGINAL DE LA IMAGEN Y DEFINIR LOS NUEVOS VALORES
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoRes"]["tmp_name"]);

					$nuevoAncho = 300;
					$nuevoAlto = 240;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "Assets/images/uploads/empleados";

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoRes"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100, 9999);

						$ruta = $directorio.$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoRes"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);


					}else if($_FILES["fotoRes"]["type"] == "image/png"){

						$aleatorio = mt_rand(100, 9999);

						$ruta = $directorio.$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["fotoRes"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
			
						imagesavealpha($destino, TRUE);	

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}else{

						return;
					}

				}else{


					$ruta = "Assets/images/uploads/default.jpg";
				}

	     	  
	     	  		$idGanado		         = intval($_POST['idGanado']); 
	     	  	 	$intCedula               = intval(strclean($_POST['txtCedula']));
					$strNombres              = ucwords(strClean($_POST['txtNombres'])); 
					$strApellidos            = ucwords(strClean($_POST['txtApellidos'])); 
					$strCorreo  		     = ucwords(strClean($_POST['txtCorreo']));
					$intContacto  		     = ucwords(strClean($_POST['txtContacto']));
					$intEdad  		         = intval(strClean($_POST['txtEdad']));
					$strCargo  		         = ucwords(strClean($_POST['txtCargo']));
					$strObservacion  		 = ucwords(strClean($_POST['txtObservacion']));
					$strEstado 		         = $_POST['listStatus'];
					$strFotoEmpleado         = $ruta;
					
					

					if ($idGanado ==0) 
					{
 
						$option  = 1;
				    
					    $request_user = $this->model->insertGanado(

																$intCedula,
																$strNombres,
																$strApellidos,				
															    $strCorreo,
															    $intContacto,
															    $intEdad,
															    $strCargo,
															    $strObservacion,
															    $strEstado,
															    $strFotoEmpleado);

					    if ($request_user  !=  'exist') {
					    	
					    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

					    }else if ($request_user == 'exist'){

					    	$arrResponse = array('status' => false, 'msg' => '!Atención. el codigo ingresado ya existe');
					    }else{

					    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
					    }

					}else{

						$option = 2;

						 $request_user = $this->model->updateGanado(   
						 									    $idGanado,
																$intCedula,
																$strNombres,
																$strApellidos,				
															    $strCorreo,
															    $intContacto,
															    $intEdad,
															    $strCargo,
															    $strObservacion,
															    $strEstado,
															    $strFotoEmpleado);


						 $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');			

		}
	}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

		}


	   public function getGanados()
	   {

		      $arrData = $this->model->selectGanados();

		      for ($i=0; $i < count($arrData); $i++) { 
		      
				
			    $btnView = '';
		      	$btnEdit = '';	
				$btnDel  = '';
				
			  if ($arrData[$i]['status'] == 1)
				 {
					$arrData[$i]['status'] = '<span class ="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class ="badge badge-danger">Inactivo</span>';
				}

				/*================================================
			    CONDICION PARA EL BOTON DE "VER" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<a class="btnViewEmpleado" onClick ="fntViewEmpleado('.$arrData[$i]['idganado'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';
				}

				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditEmpleado" onClick ="fntEditEmpleado('.$arrData[$i]['idganado'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}

				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelEmpleado" onClick ="fntDelEmpleado('.$arrData[$i]['idganado'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDel.'</div>'; 
       }

		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	   }
//OBTENER DATOS DEL USUARIO

	 	 
	public function getGanado(int $idganado)
	{   
		$idganado = intval($idganado);
		if ($idganado >0) 
		{
			$arrData = $this->model->selectGanado($idganado);
			
			if (empty($arrData))
			 {
				$arrResponse  = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse  = array('status' => true, 'data' => $arrData);

			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
		}
		die();
	    }
	    //elimnar ganado

	    public function delGanado()
		{
			if($_POST){
				$intIdGanado = intval($_POST['idGanado']);
				$requestDelete = $this->model->deleteGanado($intIdGanado);
				if($requestDelete ){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la res');
				
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la res');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}


	}
 ?>