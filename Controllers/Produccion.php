
<?php

class Produccion extends Controllers{
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
	public function Produccion ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		 { 

		 	header('Location: '.base_url().'/dashboard');
		 }

		$data['page_tage'] = "Producción";
		$data['page_name'] = "produccion";
		$data['page_title'] ="Registro de producción ";
		$data['page_function_js'] ="functions_produccion.js";

	    $data['empleados'] = $this->model->empleados();
	    
		$this->views->getView($this,"produccion",$data);
	
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


	public function ingresarProduccion(){

		//dep($_POST);

	     if ($_POST ) {


	     	  if (empty($_POST['txtCodigo']) || empty($_POST['idganado']) && $_POST['idProduccion'] == 0 ) 

	     	   {

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos. Ingrese el codigo.' );
	     	  
	     	  }else{ 
			     	  		$idProduccion	               = intval($_POST['idProduccion']);
			     	  	 	$intCodigo                     = intval($_POST['txtCodigo']);
							$intIdGanado                   = intval($_POST['idganado']); 
							$intStatus                     = !empty($_POST['status']) ? $_POST['status'] :'1';
							$strNomOrdeñador               = ucwords(strClean($_POST['nomOrdeñador'])); 
							$intCantLitro                  = intval(strClean($_POST['cantLitros'])); 
							$strHorario                    = ucwords(strClean($_POST['horario']));
							$strFechaOrdeño                = $_POST['fechaOrdeño'];
						    $strObservacion                = ucwords(strClean($_POST['txtObservacion'])); 					

					if ($idProduccion ==0 ) 
					{
 
						$option  = 1;
						 $request_user = $this->model->insertProduccion(	$intCodigo,
																			$intIdGanado,
																			$intStatus,
																			$strNomOrdeñador,
																			$intCantLitro,
																			$strHorario,
																			$strFechaOrdeño,
																			$strObservacion	
																		 );										    
															    

					    if ($request_user  != '') {
					    	
						    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

						    }else{

						    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
						    }

					}else{

						$option = 2;

						 $request_user = $this->model->updateTratamiento(   $idProduccion,
									 									    $intCodigo,
																			$intIdGanado,
																			$intStatus,
																			$strNomOrdeñador,
																			$intCantLitro,
																			$strHorario,
																			$strFechaOrdeño,
																			$strObservacion	
																     );


						 $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');			

		}
	}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

}


	   public function getProducciones()
	   {

		      $arrData = $this->model->selectProducciones();

		      for ($i=0; $i < count($arrData); $i++) { 
		      
				
			    $btnView = '';
		      	$btnEdit = '';	
				$btnDel  = '';
				$btnPDF  = '';

				/*================================================================
			    CONDICION PARA EL BOTON DE "HISTORIAL DE PRODUCCION" DE DATA TABLE
			    ==================================================================*/


				if ($_SESSION['permisosMod']['r']){
					$btnPDF  = '<a title="Historial produccion" href="'.base_url().'/historial/historialProduccion/'.$arrData[$i]['codigo'].'" target="_blanck"><i class="btnView fas fa-file-pdf"></i></a>';

				}
				/*================================================
			    CONDICION PARA EL BOTON DE "VER" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<a class="ViewProduccion" id="tamañoBtnView" onClick ="fntViewProduccion('.$arrData[$i]['idProduccion'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';


				}
				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditTratamiento" id="tamañoBtnEdit" onClick ="fntEditProduccion('.$arrData[$i]['idProduccion'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelTratamiento"id="tamañoBtnDel" onClick ="fntDelProduccion('.$arrData[$i]['idProduccion'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnPDF.' '.$btnView.' '.$btnEdit.' '.$btnDel.' </div>'; 
       } 


		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	   }

	 
	public function getProduccion($idproduccion)
	{   
		$idproduccion = intval($idproduccion);
		if ($idproduccion >0) 
		{
			$arrData = $this->model->selectProduccion($idproduccion);
			
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


	    public function delProduccion()
		{
			if($_POST){
				$intIdProduccion = intval($_POST['idProduccion']);
				$requestDelete = $this->model->deleteProduccion($intIdProduccion);
				if($requestDelete ){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el registro');
				
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el registro');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}

	}
 ?>