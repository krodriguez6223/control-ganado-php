
<?php

class Tratamiento extends Controllers{
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
	
	public function Tratamiento ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		 { 

		 	header('Location: '.base_url().'/dashboard');
		 }

		$data['page_tage'] = "Tratamiento";
		$data['page_name'] = "tratamiento";
		$data['page_title'] ="Registro de Tratamiento ";
		$data['page_function_js'] ="functions_tratamiento.js";
   
		$this->views->getView($this,"tratamiento",$data);

	
	}

	//buscar res con el codigo
	public function buscarRes($codigo){

		

		if (!empty($_POST['txtCodigo'])) {

			$codigo = $_POST['txtCodigo'];

			dep($codigo);

			exit;

			$arrData = $this->model->searchRes($codigo);

			if (empty($arrData))
			 {
				$arrResponse  = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse  = array('status' => true, 'data' => $arrData);

			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

		}


	}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar


	public function ingresarTratamiento(){

		//dep($_POST);

	     if ($_POST ) {


	     	  if (empty($_POST['txtCodigo']) || empty($_POST['idganado']) && $_POST['idTratamiento'] == 0 ) 

	     	   {

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos. Ingrese el codigo.' );
	     	  
	     	  }else{ 
			     	  		$idTratamiento	               = intval($_POST['idTratamiento']);
			     	  	 	$intCodigo                     = intval($_POST['txtCodigo']);
							$intIdGanado                   = intval($_POST['idganado']); 
							$intStatus                     = !empty($_POST['status']) ? $_POST['status'] :'1';
							//tratamiendo baño
		                    $strTipoBanio                  = isset($_POST['tipoBanio']) ? $_POST['tipoBanio'] : null; 
							$strTipoMedicina  	           = isset($_POST['tipoMedica']) ? $_POST['tipoMedica'] : null;
							$strFechaBanio  		       = isset($_POST['fechaBanio']) ? $_POST['fechaBanio'] : null;
							$strFechaProxBanio  	       = isset($_POST['fechaProxBanio']) ? $_POST['fechaProxBanio'] : null;
							$strObservBanio                = isset($_POST['txtObservacion']) ? $_POST['txtObservacion'] : null;
							//tratamiendo desparasitacion
							$strTipoDesparacitacion        = isset($_POST['tipoDesparasitacion']) ? $_POST['tipoDesparasitacion'] : null; 
							$strTipoDesparasitante         = isset($_POST['tipoDesparasitante']) ? $_POST['tipoDesparasitante'] : null;
							$strFechaDesparasitacion       = isset($_POST['fechaDesparasitacion']) ? $_POST['fechaDesparasitacion'] : null;
							$strFechaProxDesparasitacion   = isset($_POST['fechaProxDesparasitacion']) ? $_POST['fechaProxDesparasitacion'] : null;
							$strObserDesparacitacion       = isset($_POST['observDesparasitacion']) ? $_POST['observDesparasitacion'] : null;
							//tratamiendo baño
							$strTipoVacunacion             = isset($_POST['tipoVacuna']) ? $_POST['tipoVacuna'] : null; 
							$strNomVacuna                  = isset($_POST['nombreVacuna']) ? $_POST['nombreVacuna'] : null;
							$strFechaVacunacion            = isset($_POST['fechaVacunacion']) ? $_POST['fechaVacunacion'] : null;
							$strFechaProxVacunacion        = isset($_POST['fechaProxVacuna']) ? $_POST['fechaProxVacuna'] : null;
							$strObserVacunacion            = isset($_POST['fechaProxVacuna']) ? $_POST['observVacunacion'] : null;
						
							

					if ($idTratamiento ==0 ) 
					{
 
						$option  = 1;
						 $request_user = $this->model->insertTratamiento(	$intCodigo,
																			$intIdGanado,
																			$intStatus,	
																		//tramiento baño
																			$strTipoBanio,			
																		    $strTipoMedicina,
																		    $strFechaBanio,
																		    $strFechaProxBanio,
																		    $strObservBanio,
																		//tramiento desparacitacion
																		    $strTipoDesparacitacion,
																		    $strTipoDesparasitante,
																		    $strFechaDesparasitacion,
																		    $strFechaProxDesparasitacion,
																		    $strObserDesparacitacion,
																		 //tramiento vacunacion
																		    $strTipoVacunacion,
																		    $strNomVacuna,
																		    $strFechaVacunacion,
																		    $strFechaProxVacunacion,
																		    $strObserVacunacion
															     );
					   
															    
															    

					    if ($request_user  != '') {
					    	
						    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

						    }else{

						    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
						    }

					}else{

						$option = 2;

						 $request_user = $this->model->updateTratamiento(   $idTratamiento,
									 									    $intCodigo,
																			$intStatus,
																			//tramiento baño
																			$strTipoBanio,			
																		    $strTipoMedicina,
																		    $strFechaBanio,
																		    $strFechaProxBanio,
																		    $strObservBanio,
																		    //tramiento desparacitacion
																		    $strTipoDesparacitacion,
																		    $strTipoDesparasitante,
																		    $strFechaDesparasitacion,
																		    $strFechaProxDesparasitacion,
																		    $strObserDesparacitacion,
																		    //tramiento vacunacion
																		    $strTipoVacunacion,
																		    $strNomVacuna,
																		    $strFechaVacunacion,
																		    $strFechaProxVacunacion,
																		    $strObserVacunacion
																     );


						 $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');			

		}
	}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

}


	   public function getTratamientos()
	   {

		      $arrData = $this->model->selectTratamientos();

		      for ($i=0; $i < count($arrData); $i++) { 
		      
				
			    $btnView = '';
		      	$btnEdit = '';	
				$btnDel  = '';
				$btnPDF  = '';


				/*================================================
			    CONDICION PARA EL BOTON DE "REPORTE" DE DATA TABLE
			    ================================================*/	

				if ($_SESSION['permisosMod']['r']){
					$btnPDF  = '<a title="Historial Tratamiento" href="'.base_url().'/historial/reporteHistorial/'.$arrData[$i]['codigo'].'" target="_blanck" ><i class="btnView fas fa-file-pdf"></i></a>';

				}

				/*================================================
			    CONDICION PARA EL BOTON DE "VER" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<a class="btnViewTratamiento" id="tamañoBtnView" onClick ="fntViewTratamiento('.$arrData[$i]['idTratamiento'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';


				}
				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditTratamiento" id="tamañoBtnEdit" onClick ="fntEditTratamiento('.$arrData[$i]['idTratamiento'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelTratamiento"id="tamañoBtnDel" onClick ="fntDelGanado('.$arrData[$i]['idTratamiento'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnPDF.' '.$btnView.' '.$btnEdit.' '.$btnDel.' </div>'; 
       } 


		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	   }
//OBTENER DATOS DEL USUARIO
	 
	public function getTratamiento(int $idtratamiento)
	{   
		$idtratamiento = intval($idtratamiento);
		if ($idtratamiento >0) 
		{
			$arrData = $this->model->selectTratamiento($idtratamiento);
			
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

	
	    public function delTratamiento()
		{
			if($_POST){
				$intIdTratamiento = intval($_POST['idTratamiento']);
				$requestDelete = $this->model->deleteTratamiento($intIdTratamiento);
				if($requestDelete ){
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el tratamiento');
					}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			} 
			die();
		}




	}
 ?>