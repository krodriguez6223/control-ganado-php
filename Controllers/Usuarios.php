
<?php

class Usuarios extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start();
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(2);
	}
	public function Usuarios ($parems){

		 if (empty($_SESSION['permisosMod']['r']))
		 { 

		 	header('Location: '.base_url().'/dashboard');
		 }

		$data['page_tage'] = "Usuarios";
		$data['page_name'] = "usuarios";
		$data['page_title'] ="Usuarios";
		$data['page_function_js'] ="functions_usuarios.js";

		$this->views->getView($this,"usuarios",$data);

		}


//ingresar un nuevo usuario en el modal y actualiza el rol desde el boton editar

	public function setUsuario(){
		

	     if ($_POST) {

	     	  if (empty($_POST['txtCedula']) || empty($_POST['txtNombre']) || empty(['txtApellido']) || empty(['txtTelefono']) || empty(['txtEmail']) || empty(['listRolid']) || empty(['listStatus']) ) 
	     	  {
	     	  	$arrResponse  = array("status" => false , "msg" => 'Datos incorrectos.' );
	     	  }else{
	     	  		$idUsuario		         = intval($_POST['idUsuario']); 
	     	  	 	$intCedula               = intval(strclean($_POST['txtCedula']));
					$strNombre               = ucwords(strClean($_POST['txtNombre'])); 
					$strApellido             = ucwords(strClean($_POST['txtApellido'])); 
					$intTelefono  		     = intval(strClean($_POST['txtTelefono']));
					$strEmail                = strtolower(strClean($_POST['txtEmail']));
					$intTipousuario			 = intval(strClean($_POST['listRolid']));
					$intStatus			     = intval(strClean($_POST['listStatus']));

					if ($idUsuario ==0) 
					{
 
						$option  = 1;

					    $strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256",$_POST['txtPassword']);
					    
					    $request_user = $this->model->insertUsuario(
																$intCedula,
																$strNombre,				
															    $strApellido,
															    $intTelefono,
															    $strEmail,
															    $strPassword,
															    $intTipousuario,
															    $intStatus);

					    if ($request_user  !=  'exist') {
					    	
					    	$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');

					    }else if ($request_user == 'exist'){

					    	$arrResponse = array('status' => false, 'msg' => '!Atención. la cédula o el correo ingresado ya existe');
					    }else{

					    	$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
					    }

					}else{

						$option = 2;

						 $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);

						 $request_user = $this->model->updateUsuario(   
						 									    $idUsuario,
																$intCedula,
																$strNombre,				
															    $strApellido,
															    $intTelefono,
															    $strEmail,
															    $strPassword,
															    $intTipousuario,
															    $intStatus);
						  $arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');	

				
}}
			
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

		}

	   public function getUsuarios()
	   {
 		if ($_SESSION['permisosMod']['r']){

	   	if (!empty($_GET['deRango']) && !empty($_GET['hastaRango'])) {
	   		
	   		
	   		$between1 = $_GET['deRango'];
	   		$between2 = $_GET['hastaRango'];


	   		 $arrData = $this->model->selectUsuarios($between1, $between2);


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
					$btnView = '<a onClick ="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';
				}
			  /*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ) {
					
					      $btnEdit = '<a  onClick ="fntEditUsuario(this,'.$arrData[$i]['idpersona'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></button>';
				  }else{
				  	    $btnEdit = '<a  disabled ><i class="btnEdit fas fa-pencil-alt"></i></a>'; 
				  }
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){

					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
					      ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])){

					$btnDel  = '<a onClick ="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';
			}else{

				    $btnDel = '<a class="btnDisabled" disabled ><i class ="btnDisabled fas fa-trash-alt"></i></a>';

					}

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDel.'</div>'; 
     			  }

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

				die();
			
			}else{

				$arrData = $this->model->selectUsuarios(null, null);


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
					$btnView = '<a onClick ="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver"><i class="btnView fas fa-eye"></i></a>';
				}
			  /*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ) {
					
					      $btnEdit = '<a  onClick ="fntEditUsuario(this,'.$arrData[$i]['idpersona'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></button>';
				  }else{
				  	    $btnEdit = '<a  disabled ><i class="btnEdit fas fa-pencil-alt"></i></a>'; 
				  }
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/

				if ($_SESSION['permisosMod']['d']){

					if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || 
						($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
					      ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])){

					$btnDel  = '<a onClick ="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';
			}else{

				    $btnDel = '<a class="btnDisabled" disabled ><i class ="btnDisabled fas fa-trash-alt"></i></a>';

					}

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDel.'</div>'; 
     			  }



				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

			}
				die();


			}

}
		
//}
	
//OBTENER DATOS DEL USUARIO
	 
	public function getUsuario(int $idpersona)
	{   
		 if ($_SESSION['permisosMod']['r']){


		$idusuario = intval($idpersona);
		if ($idusuario >0) 
		{
			$arrData = $this->model->selectUsuario($idusuario);
			
			if (empty($arrData))
			 {
				$arrResponse  = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse  = array('status' => true, 'data' => $arrData);

			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
	}
		die();
	    }

	    //elimnar usuario
	    public function delUsuario()
		{
			if($_POST){
				$intIdUsuario = intval($_POST['idUsuario']);
				$requestDelete = $this->model->deleteUsuario($intIdUsuario);
				if($requestDelete ){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Usuario');
				
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Usuario');
				} 
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}

     }  
 ?>