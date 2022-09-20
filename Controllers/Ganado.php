
<?php

class Ganado extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start();
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(3);
	}
	public function Ganado ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		{
			header('Location: '.base_url().'/dashboard'); 
		} 

		$data['page_tage'] = "Ganado";
		$data['page_name'] = "ganado";
		$data['page_title'] ="Registro de Ganado ";
		$data['page_function_js'] ="functions_ganado.js";

		$data['confLote'] = $this->model->selectConfiLote();
		$data['confRaza'] = $this->model->selectConfiRaza();
		$data['confCate'] = $this->model->selectConfiCate();
		$data['confOrigen'] = $this->model->selectConfiOrigen();
		
		$this->views->getView($this,"ganado",$data);
	
	}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar

	public function ingresarGanado(){
		
	     if ($_POST) {

	     	  if (empty($_POST['txtCodigo']) ||
	     	      empty($_POST['txtNombre']) || 
	     	        empty($_POST['pesoRes']) || 
	     	       empty($_POST['listRaza']) || 
	     	  empty($_POST['listCategoria']) || 
	     	     empty($_POST['listOrigen']) ||
	     	       empty($_POST['listLote']) ||
	     	empty($_POST['fechaNacimiento']) ||
	     	     empty($_POST['listStatus']) || 
	     	       empty(['txtObservacion']) 
	     	     ) 

	     	   {

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos.' );
	     	  
	     	  }else{
		     	      	  
	     	  		$idGanado		         = intval($_POST['idGanado']); 
	     	  	 	$intCodigo               = intval(strclean($_POST['txtCodigo']));
					$strNombre               = ucwords(strClean($_POST['txtNombre'])); 
					$intPeso                 = intval(strClean($_POST['pesoRes'])); 
					$strRaza  		         = $_POST['listRaza'];
					$strCategoria  		     = $_POST['listCategoria'];
					$strOrigen  		     = $_POST['listOrigen'];
					$strLote 		         = $_POST['listLote'];
					$strfechaNacimiento      = strtolower(strClean($_POST['fechaNacimiento']));
					$intStatus			     = intval(strClean($_POST['listStatus']));
                    $strMortalidad           = !empty($_POST['listMortalidad']) ? $_POST['listMortalidad'] : NULL; 
                    $strObservacion          = strtolower(strClean($_POST['txtObservacion']));
					
					$foto   	 	= $_FILES['foto'];
					$nombre_foto 	= $foto['name'];
					$type 		 	= $foto['type'];
					$url_temp    	= $foto['tmp_name'];
					$fotoRes 	= 'vacaPortada.jpg';
					
					if($nombre_foto != ''){
						$fotoRes = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
					}
					
					

					if ($idGanado ==0) 
					{
 
						$option  = 1;
				    
					    $request_user = $this->model->insertGanado(
																$intCodigo,
																$strNombre,
																$intPeso,				
															    $strRaza,
															    $strCategoria,
															    $strOrigen,
															    $strLote,
															    $strfechaNacimiento,
															    $intStatus,
															    $strMortalidad,
															    $strObservacion,
															    $fotoRes);

					    if ($request_user  !=  'exist') {
					    	
					    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');
					    	if($nombre_foto != ''){ uploadImage($foto,$fotoRes); }

					    }else if ($request_user == 'exist'){

					    	$arrResponse = array('status' => false, 'msg' => '!Atención. el codigo ingresado ya existe');
					    }else{

					    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
					    }

					}else{

						$option = 2;

						if ($nombre_foto == '') {
							if ($_POST['foto_Actual'] != 'vacaPortada.jpg' && $_POST['foto_remove'] == 0)  {
								$fotoRes = $_POST['foto_Actual'];
							}
						}


						 
						 $request_user = $this->model->updateGanado(   
						 									    $idGanado,
																$intCodigo,
																$strNombre,
																$intPeso,				
															    $strRaza,
															    $strCategoria,
															    $strOrigen,
															    $strLote,
															    $strfechaNacimiento,
															    $intStatus,
															    $strMortalidad,
															    $strObservacion,
															    $fotoRes);


						 $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
						 if($nombre_foto != ''){ uploadImage($foto,$fotoRes); }
						 if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_Actual'] != 'vacaPortada.jpg')||
						       ($nombre_foto != '' && $_POST['foto_Actual'] != 'vacaPortada.jpg')) {
						 				deleteFile($_POST['foto_Actual']);
						 			}			

		}
	}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

		}


   public function ingresarConfig(){

   	      $strLote  = !empty($_POST['txtLote']) ? $_POST['txtLote'] : NULL;
   	      $strRaza  = !empty($_POST['txtRaza']) ? $_POST['txtRaza'] : NULL;
   	      $strCategoria  = !empty($_POST['txtCategoria']) ? $_POST['txtCategoria'] : NULL;
   	      $strOrigen  = !empty($_POST['txtOrigen']) ? $_POST['txtOrigen'] : NULL;
		
	     
	     $request_Config = $this->model->insertConfiGanado($strLote,
	     													$strRaza,
	     													$strCategoria,
	     													$strOrigen);

	     $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

	     echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);


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
					$arrData[$i]['status'] = '<span class ="badge badge-success">Activa</span>';

				}else if($arrData[$i]['status'] == 2){

					$arrData[$i]['status'] = '<span class ="badge badge-danger">Muerta</span>';

				}elseif ($arrData[$i]['status'] == 3) {
					$arrData[$i]['status'] = '<span class ="badge badge-warning">Vendida</span>';

				}else{
					$arrData[$i]['status'] = '<span class ="badge badge-info">Descarte</span>';
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
//OBTENER DATOS DEL Ganado

	 	 
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
				$arrData['url_fotoRes'] = media().'/images/uploads/'.$arrData['foto'];
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

				$intIdGanado = intval($_POST['idganado']);
				
				$requestDelete = $this->model->deleteGanado($intIdGanado);
				
				if($requestDelete){
					
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la res');

				}else {
					
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar res');
				} 
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}

	   

	}
 ?>