
<?php

class Inventario extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start(); 
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(6);
	} 
	public function Inventario ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		{
			header('Location: '.base_url().'/dashboard');
		} 

		$data['page_tage'] = "Inventario";
		$data['page_name'] = "inventario";
		$data['page_title'] ="Registro de inventario ";
		$data['page_function_js'] ="functions_inventario.js";
		$this->views->getView($this,"inventario",$data);
	
	}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar

	public function ingresarGanado(){
		

	     if ($_POST) {

	     	  if (empty($_POST['txtCodigo']) ||
	     	      empty($_POST['txtNombre']) || 
	     	       empty($_POST['txtStock']) || 
	     	  empty($_POST['listCategoria']) || 
	     	     empty($_POST['listStatus']) || 
	       	       empty(['txtDescripcion']) 
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

					$directorio = "Assets/images/uploads/";

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
	     	  	 	$intCodigo               = intval(strclean($_POST['txtCodigo']));
					$strNombre               = ucwords(strClean($_POST['txtNombre'])); 
					$intStock                = intval(strClean($_POST['txtStock'])); 
					$strCategoria  		     = $_POST['listCategoria'];
					$strStatus  		     = ucwords(strClean($_POST['listStatus']));
					$strDescripcion  		 = ucwords(strClean($_POST['txtDescripcion']));
					$strFoto                 = $ruta;
					
					

					if ($idGanado ==0) 
					{
 
						$option  = 1;
				    
					    $request_user = $this->model->insertGanado(
																$intCodigo,
																$strNombre,
																$intStock,				
															    $strCategoria,
															    $strStatus,
															    $strDescripcion,
															    $strFoto);

					    if ($request_user  !=  'exist') {
					    	
					    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

					    }else if ($request_user == 'exist'){

					    	$arrResponse = array('status' => false, 'msg' => '!Atención. el producto ingresado ya existe');
					    }else{

					    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
					    }

					}else{

						$option = 2;

						 $request_user = $this->model->updateGanado(   
						 									    $idGanado,
																$intCodigo,
																$strNombre,
																$intStock,				
															    $strCategoria,
															    $strStatus,
															    $strDescripcion,
															    $strFoto);

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
					$btnView = '<a class="btnViewGanado" onClick ="fntViewGanado('.$arrData[$i]['idganado'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';
				}

				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditGanado" onClick ="fntEditGanado('.$arrData[$i]['idganado'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/
				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelGanado" onClick ="fntDelGanado('.$arrData[$i]['idganado'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

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
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
				
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}


	}
 ?>