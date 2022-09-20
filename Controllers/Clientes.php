 
<?php

class Clientes extends Controllers{
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
	public function Clientes ($parems){

		if (empty($_SESSION['permisosMod']['r']))
		 { 

		 	header('Location: '.base_url().'/dashboard');
		 }

		$data['page_tage'] = "clientes";
		$data['page_name'] = "cliente";
		$data['page_title'] ="Registro de clientes ";
		$data['page_function_js'] ="functions_cliente.js";
	    
		$this->views->getView($this,"clientes",$data);
	
	}

//INGRESA UN NUEVO CLIENTE 
	public function ingresarClientes(){

	     if ($_POST ) {


	     	  if (empty($_POST['txtCedula']) || empty($_POST['txtDireccion']) || empty($_POST['txtNombre']) || empty($_POST['txtEmail']) ||  empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['listStatus'])) 

	     	   {	

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos. Ingrese el codigo.' );
	     	  
	     	  }else{ 
			     	  		$idCliente	                   = intval($_POST['idCliente']);
			     	  	 	$intCedula                     = intval($_POST['txtCedula']);
			     	  	 	$strNombre                     = ucwords(strClean($_POST['txtNombre']));
							$strApellido                   = ucwords(strClean($_POST['txtApellido'])); 
							$intTelefono                   =  intval($_POST['txtTelefono']);
							$strEmail                      = ucwords(strClean($_POST['txtEmail'])); 
							$strDireccion                  = ucwords(strClean($_POST['txtDireccion'])); 
 							$intStatus                     =  intval($_POST['listStatus']);
						    $strObservacion                = ucwords(strClean($_POST['txtObservacion'])); 					

					if ($idCliente ==0 ) 
					{
 
						$option  = 1;
						 $request_Cliente = $this->model->insertCliente(	    $intCedula,
																			$strNombre,
																			$strApellido,
																			$intTelefono,
																			$strEmail,
																			$strDireccion,
																			$intStatus,
																			$strObservacion	
																		 );										    
															    

					    if ($request_Cliente  != '') {
					    	
						    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

						    }else{

						    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
						    }

					}else{

//ACTUALIZA LOS REGISTRO DE UN CLIENTE
						$option = 2;

						 $request_Cliente = $this->model->updateCliente(  $idCliente,
										 								  $intCedula,
																		  $strNombre,
																		  $strApellido,
																		  $intTelefono,
																		  $strEmail,
																		  $strDireccion,
																		  $intStatus,
																		   $strObservacion	
																      );


						 $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');			

		}
	}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

}


	   public function getClientes()
	   {

		      $arrData = $this->model->selectClientes();

		      for ($i=0; $i < count($arrData); $i++) { 
		      
				
			    $btnView = '';
		      	$btnEdit = '';	
				$btnDel  = '';
				$btnPDF  = '';

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
					$btnView = '<a class="ViewProduccion" id="tamañoBtnView" onClick ="fntViewCliente('.$arrData[$i]['idCliente'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';
				}

				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/


				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditTratamiento" id="tamañoBtnEdit" onClick ="fntEditCliente('.$arrData[$i]['idCliente'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}

				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelTratamiento"id="tamañoBtnDel" onClick ="fntDelCliente('.$arrData[$i]['idCliente'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnPDF.' '.$btnView.' '.$btnEdit.' '.$btnDel.' </div>'; 
       } 


		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	   }

	 
	public function getCliente($idcliente)
	{   
		$idcliente = intval($idcliente);
		if ($idcliente >0) 
		{
			$arrData = $this->model->getCliente($idcliente);
			
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


	    public function delCliente()
		{
			if($_POST){
				$intIdCliente = intval($_POST['idCliente']);
				$requestDelete = $this->model->deleteCliente($intIdCliente);
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