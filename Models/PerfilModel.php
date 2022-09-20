<?php 

class PerfilModel extends Mysql
 {   
     private $intIdUsuario;            
     private $intCedula;      
     private $strNombre;               
     private $strApellido; 
     private $intTelefono;             
     private $strEmail;  
     private $strPassword;
     private $strFotoPerfil;
           
    
     public function __construct()
     {
       parent:: __construct();
     }

         /*=============================================
         =   Actualizar los datos de perfil            =
         =============================================*/
         
            public function updatePerfil(int $idUsuario, int $cedula, string $nombre, string $apellido, int $telefono, string $password){

                $this->intIdUsuario = $idUsuario;
                $this->intCedula = $cedula;
                $this->strNombre = $nombre;
                $this->strApellido = $apellido;
                $this->intTelefono = $telefono;
                $this->strPassword = $password;
             

             if ($this->strPassword != "") 
             {
             	$sql="UPDATE persona SET cedula =?, nombres =?, apellidos =?, telefono = ?, password = ? 
                      WHERE idpersona = $this->intIdUsuario";

             	$arrData = array($this->intCedula,
             					  $this->strNombre,
             					  $this->strApellido,
             					  $this->intTelefono,
             					  $this->strPassword);
             }else{
             	$sql= "UPDATE persona SET cedula =?, nombres =?, apellidos =?, telefono=? 
                        WHERE idpersona = $this->intIdUsuario";
             	 
             	 $arrData = array($this->intCedula,
             	 				  $this->strNombre,
             	 				  $this->strApellido,
             	 				  $this->intTelefono);
             }
             $request = $this->update($sql,$arrData);
             return $request;
     }
        /*=============================================
         =   Actualizar la foto de perfil            =
         =============================================*/
            public function updateFotoPerfil($idUsuario, $fotoPerfil){

                    $this->intIdUsuario = $idUsuario;
                    $this->strFotoPerfil = $fotoPerfil;

                    $sql = "UPDATE persona SET foto = ? WHERE idpersona = $this->intIdUsuario";

                    $arrData = array($this->strFotoPerfil);

                    $request = $this->update($sql,$arrData);
                    return $request;

              }
  }
?>