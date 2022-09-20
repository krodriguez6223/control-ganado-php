
<?php

class Proveedores extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start();
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(5);
	}
	public function Proveedores ($parems){

		if (empty($_SESSION['permisosMod']['r']))
			{
			header('Location: '.base_url().'/dashboard');
		    }

		$data['page_tage'] = "Proveedor";
		$data['page_name'] = "proveedor";
		$data['page_title'] ="Registro de Proveedor ";
		$data['page_function_js'] ="functions_proveedor.js";
		$this->views->getView($this,"proveedores",$data);
	
	}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar

	public function ingresarGanado(){
		

	     if ($_POST) {

	     	  if ( empty($_POST['txtCedula']) ||
	     	       empty($_POST['txtNombre']) || 
	     	     empty($_POST['txtContacto']) || 
	     	    empty($_POST['txtDireccion']) || 
	     	        empty($_POST['txtEmail']) || 
	     	   empty($_POST['listCategoria']) || 
	     	     empty($_POST['listEstado']) ) 

	     	   {

	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos.' );
	     	  
	     	  }else{
	     	  
	     	  		$idGanado		         = intval($_POST['idGanado']); 
	     	  	 	$intCedula               = intval(strclean($_POST['txtCedula']));
					$strNombre               = ucwords(strClean($_POST['txtNombre'])); 
					$intContacto             = intval(strClean($_POST['txtContacto'])); 
					$strDireccion  		     = ucwords(strClean($_POST['txtDireccion']));
					$strCorreo  		     = ucwords(strClean($_POST['txtEmail']));
					$strCategoria  		     = $_POST['listCategoria'];
					$strObservacion  		 = ucwords(strClean($_POST['txtObservacion']));
					$strEstado  		     = $_POST['listEstado'];		
					

					if ($idGanado ==0) 
					{
 
						$option  = 1;
				    
					    $request_user = $this->model->insertGanado(	         
												     	  	 	$intCedula,          
																$strNombre,          
																$intContacto,        
																$strDireccion,	    
																$strCorreo,	     
																$strCategoria,	    
																$strObservacion,	
																$strEstado 
															   );

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
																	$strNombre,      
																	$intContacto,   
																	$strDireccion,   
																	$strCorreo,	     
																	$strCategoria,   
																	$strObservacion,
																	$strEstado 
																   );


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