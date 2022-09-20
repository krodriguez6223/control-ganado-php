<?php 

class Roles extends Controllers{

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
	public function Roles(){

		if (empty($_SESSION['permisosMod']['r']))
			{
			header('Location: '.base_url().'/dashboard');
		     }

		$data['page_id'] = 3;
		$data['page_tage'] = "Roles usuario";
		$data['page_name'] = "rol_usuario";
		$data['page_title'] ="Roles usuario";
		$data['page_function_js'] ="function_roles.js";
		$this->views->getView($this,"roles",$data);
	}
	public function getRoles()
	{   
		$arrData = $this->model->selectRoles();
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
					$btnView = '<a class="btnPermisoRol" onClick ="fntPermisos('.$arrData[$i]['idrol'].')" title="Ver"><i class ="btnView fas fa-key"></i></a>';
				}

				/*================================================
			    CONDICION PARA EL BOTON DE "EDITAR" DE DATA TABLE
			    ================================================*/

				if ($_SESSION['permisosMod']['u']){
					$btnEdit = '<a class="btnEditRol" onClick ="fntEditRol(this,'.$arrData[$i]['idrol'].')" title="Editar"><i class ="btnEdit fas fa-pencil-alt"></i></a>';
				}
				/*==================================================
			    CONDICION PARA EL BOTON DE "ELIMINAR" DE DATA TABLE
			    ===================================================*/
				if ($_SESSION['permisosMod']['d']){
					$btnDel  = '<a class="btnDelRol" onClick ="fntDelRol('.$arrData[$i]['idrol'].')" title="Eliminar"><i class ="btnDel fas fa-trash-alt"></i></a>';

				}

		          $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDel.'</div>'; 
       }
		


		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}

//METODO QUE PERMITE OBTENER LOS REGISTROS DE ROLES PARA EL REGISTRO DEL MODAL USUARIO

 public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	public function getRol(int $idrol)
	{
		$intIdrol = intval(strClean($idrol));
		if ($intIdrol >0) 
		{
			$arrData = $this->model->selectRol($intIdrol);
			if (empty($arrData))
			 {
				$arrResponse  = array('status' => false, 'msg' => 'Datos no encontrados.' );
			}else{
				$arrResponse  = array('status' => true, 'data' => $arrData);

			}echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setRol(){ //Con esto podremos almacenar un nuevo Rol
			$intIdrol       = intval($_POST['idRol']);
			$strRol         = strClean($_POST['txtNombre']); // Con strClean limpiamos para 
			$strDescripcion = strClean($_POST['txtDescripcion']); //evitar inyecciones SQL
			$intStatus      = intval($_POST['listStatus']);

			
			if ($intIdrol ==0) 
			{
				//Crear un nuevo rol
				$request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
				$option = 1;

				if ($request_rol != 'exist') {
						
						$arrResponse = array('status' => true, 'msg' => 'Datos guardado correctamente.');
				
				}else if($request_rol == 'exist'){

					$arrResponse = array('status' => false, 'msg' => '!Atención. el rol ingresado ya existe');
				 
				 }else{
						$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
					}


			}else{

				//Actualizar
				$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
				$option = 2;

				$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

			}			
			
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); //Con "die" detenemos o cerramos el proceso de este metodo

		}

		
		public function delRol()
		{
			if($_POST){
				$intIdrol = intval($_POST['idrol']);
				$requestDelete = $this->model->deleteRol($intIdrol);
				if($requestDelete == 'ok'){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				}else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol');
				} 
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			} 
			die();
		}

}
 ?>