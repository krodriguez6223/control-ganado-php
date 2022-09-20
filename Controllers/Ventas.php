
<?php

class Ventas extends Controllers{
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
	public function Ventas ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		 { 

		 	header('Location: '.base_url().'/dashboard');
		 }

		$data['page_tage'] = "Ventas";
		$data['page_name'] = "ventas";
		$data['page_title'] ="Registro de ventas ";
		$data['page_function_js'] ="functions_ventas.js";

		   //notificaciones de tratamiento

		 //muestra EN TABLA reces a tratamiento del actual dia
	    $data['TratarActualBañoHOY'] = $this->model->TraBañoHOY();
	    $data['TratarActualDespaHOY'] = $this->model->TraDesparacitacionHOY();
	    $data['TratarActualVacunaHOY'] = $this->model->TraVacunacionHOY();
	    
	    $data['cantReTratarActualBaño'] = $this->model->cantTraBaño();
	    $data['cantReTratarActualDespa'] = $this->model->cantTraDesparacitacion();
	    $data['cantReTratarActualVacuna'] = $this->model->cantTraVacunacion();
	    
		$this->views->getView($this,"ventas",$data);
	
	}

	//buscar res con el codigo
	public function buscarRes($codigo){
		
		if (!empty($_POST['txtCodigo'])) {

			$codigo = $_POST['txtCodigo'];

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
		                    $strTipoBanio                  = isset($_POST['tipoBanio']) ? $_POST['tipoBanio'] : NULL; 
							$strTipoMedicina  	           = isset($_POST['tipoMedica']) ? $_POST['tipoMedica'] : NULL;
							$strFechaBanio  		       = isset($_POST['fechaBanio']) ? $_POST['fechaBanio'] : NULL;
							$strFechaProxBanio  	       = isset($_POST['fechaProxBanio']) ? $_POST['fechaProxBanio'] : NULL;
							$strObservBanio                = isset($_POST['txtObservacion']) ? $_POST['txtObservacion'] : NULL;
							//tratamiendo desparasitacion
							$strTipoDesparacitacion        = isset($_POST['tipoDesparasitacion']) ? $_POST['tipoDesparasitacion'] : NULL; 
							$strTipoDesparasitante         = isset($_POST['tipoDesparasitante']) ? $_POST['tipoDesparasitante'] : NULL;
							$strFechaDesparasitacion       = isset($_POST['fechaDesparasitacion']) ? $_POST['fechaDesparasitacion'] : NULL;
							$strFechaProxDesparasitacion   = isset($_POST['fechaProxDesparasitacion']) ? $_POST['fechaProxDesparasitacion'] : NULL;
							$strObserDesparacitacion       = isset($_POST['observDesparasitacion']) ? $_POST['observDesparasitacion'] : NULL;
							//tratamiendo baño
							$strTipoVacunacion             = isset($_POST['tipoVacuna']) ? $_POST['tipoVacuna'] : NULL; 
							$strNomVacuna                  = isset($_POST['nombreVacuna']) ? $_POST['nombreVacuna'] : NULL;
							$strFechaVacunacion            = isset($_POST['fechaVacunacion']) ? $_POST['fechaVacunacion'] : NULL;
							$strFechaProxVacunacion        = isset($_POST['fechaProxVacuna']) ? $_POST['fechaProxVacuna'] : NULL;
							$strObserVacunacion            = isset($_POST['fechaProxVacuna']) ? $_POST['observVacunacion'] : NULL;
						
							

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


				if ($_SESSION['permisosMod']['r']){
					$btnPDF  = '<a title="Historial Tratamiento" href="'.base_url().'/historial/reporteHistorial/'.$arrData[$i]['codigo'].'" target="_blanck" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>';

				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm btnViewTratamiento" id="tamañoBtnView" onClick ="fntViewTratamiento('.$arrData[$i]['idTratamiento'].')" title="Ver"><i class="fas fa-eye"></i></button>';


				}

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary btn-sm btnEditTratamiento" id="tamañoBtnEdit" onClick ="fntEditTratamiento('.$arrData[$i]['idTratamiento'].')" title="Editar"><i class ="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<button class="btn btn-danger btn-sm btnDelTratamiento"id="tamañoBtnDel" onClick ="fntDelGanado('.$arrData[$i]['idTratamiento'].')" title="Eliminar"><i class ="fas fa-trash-alt"></i></button>';

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

	    //elimnar ganado

	    public function delTratamiento()
		{
			if($_POST){
				$intIdTratamiento = intval($_POST['idTratamiento']);
				$requestDelete = $this->model->deleteTratamiento($intIdTratamiento);
				if($requestDelete ){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el tratamiento');
				
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el tratamiento');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}




	}
 ?>