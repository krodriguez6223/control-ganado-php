<?php 

class Perfil extends Controllers{
	public function __construct()
	{  

       parent:: __construct();
       session_start();
		if (empty($_SESSION['login'])) 
		{
			 header('Location: '.base_url().'/login');
		}
   }

   /*=============================================
    Metodo para los permisos
    =============================================*/
	public function Perfil()
			{

				if (empty($_SESSION['permisos'][2]['r']))
				  {
			         header('Location: '.base_url().'/dashboard');
		          }	
				    $data['page_tage'] = "Perfil ";
					$data['page_title'] = "Perfil de Usuario";
					$data['page_name'] = "perfil";
					$data['page_function_js'] ="functions_perfil.js";
					
					$this->views->getView($this,"perfil",$data);
			}
			
	/*=============================================
    Actuliza los datos de perfil logueado
    =============================================*/
    public function actualizarPerfil(){ 
				if($_POST){
					
					if (empty($_POST['txtCedula']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) ) 
					{
					
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						
					}else{
						$idUsuario = $_SESSION['idUser'];
						$intCedula = intval($_POST['txtCedula']);
						$strNombre = strClean($_POST['txtNombre']);
						$strApellido = strClean($_POST['txtApellido']);
						$strTelefono = intval(strClean($_POST['txtTelefono']));
						
						$strPassword = "";
						if (!empty($_POST['txtPassword'])) {
							$strPassword = hash("SHA256",$_POST['txtPassword']);
						}
						
						$request_user = $this->model->updatePerfil($idUsuario,
																	$intCedula,
																	$strNombre,
																	$strApellido,
																    $strTelefono,
																    $strPassword);
						if ($request_user)
						 {
							sessionUser($_SESSION['idUser']);

							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

						}else{

							$arrResponse = array('status' => false , 'msg'=> 'no es posible actualizar los datos.');
						}
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
				}//cierre de la condicion post
				die();
			}//cierre del metodo




	/*=============================================
	Actuliza los datos de perfil logueado
	=============================================*/

     public function actualizarFoto(){ 


			  if (isset($_FILES["fotoPerfil"]["tmp_name"]) && empty($_FILES["fotoPerfil"]["tmp_name"])) {
                   
                   
                            $arrResponse = array('status' => false, 'msg' => 'Seleccione una foto.');

                }else{

							$idUsuario      = $_SESSION['idUser'];
							$foto           = $_FILES['fotoPerfil'];
							$nombre_foto 	= $foto['name'];
							$type 		 	= $foto['type'];
							$url_temp    	= $foto['tmp_name'];

								
						   	$fotoPerfil = 'img_fotoPerfil'.$idUsuario.'.jpg';


							$request = $this->model->updateFotoPerfil($idUsuario, $fotoPerfil);


				if ($request) {
							     sessionUser($_SESSION['idUser']);

							$arrResponse = array('status' => true, 'msg' => 'Foto Actualizados correctamente.');

						    if($nombre_foto != ''){ uploadImageUser($foto, $fotoPerfil); }

				else{

							$arrResponse = array('status' => false, 'msg' => 'No es posible actulizar la foto.');
											 	
						     }
				     }
				 }

					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

			        die();

			   
		
		}//clierre del metodo

}//cierre de la clase