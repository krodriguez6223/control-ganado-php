

     <?php 

 class UsuariosModel extends Mysql
 {   
     private $intIdUsuario;            
     private $intCedula;      
     private $strNombre;               
     private $strApellido; 
     private $intTelefono;             
     private $strEmail;  
     private $strPassword;  
     private $strToken;                
     private $intTipousuario; 
     private $intStatus;  
     private $strBetween1;
     private $strBetween2; 
     
     public function __construct()
     {
       parent:: __construct();
     }

  public function insertUsuario( int $cedula, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipousuario, int $status){
      

   
      $this->intCedula = $cedula;
      $this->strNombre = $nombre;
      $this->strApellido = $apellido;
      $this->intTelefono = $telefono;
      $this->strEmail = $email;
      $this->strPassword = $password; 
      $this->intTipousuario = $tipousuario;
      $this->intStatus = $status;


      $return = 0;

      $sql = "SELECT * FROM persona WHERE
      email_user ='{$this->strEmail}' OR cedula = $this->intCedula ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO persona(cedula,nombres,apellidos,telefono,email_user,password,rolid,status ) VALUES(?,?,?,?,?,?,?,?)";
       
        $arrData = array(
                         $this->intCedula, 
                         $this->strNombre,
                         $this->strApellido,
                         $this->intTelefono,
                         $this->strEmail,
                         $this->strPassword, 
                         $this->intTipousuario, 
                         $this->intStatus);
       
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }


   public function selectUsuarios($between1, $between2){

       $this->strBetween1 = $between1;
       $this->strBetween2 = $between2; 

       $whereAdmin = "";
       if ($_SESSION['idUser'] != 1) {
           $whereAdmin = " and p.idpersona !=1";
       }

       if ($between1 != null) {
              
               $sql = "SELECT p.idpersona,p.cedula,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,r.idrol,r.nombrerol
                  FROM persona p 
                  INNER JOIN rol r  
                  ON p.rolid = r.idrol
                  WHERE datecreated BETWEEN '$between1' AND '$between2' AND p.status !=0".$whereAdmin;
                  $request = $this->select_all($sql);
                  return $request;

                  }else{

                    $sql = "SELECT p.idpersona,p.cedula,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,r.idrol,r.nombrerol
                  FROM persona p 
                  INNER JOIN rol r  
                  ON p.rolid = r.idrol
                  WHERE p.status !=0".$whereAdmin;
                  $request = $this->select_all($sql);
                  return $request;



                  } 
       }

          /*datecreated BETWEEN '$between1' AND '$between2' AND */

     public function selectUsuario(int $idpersona)
     {
        //buscar usuario +
      $this->intIdUsuario = $idpersona;
      $sql = "SELECT p.idpersona,p.cedula,p.nombres,p.apellidos,p.telefono,p.email_user,p.nit,p.nombrefiscal,p.direccionfiscal,r.idrol,r.nombrerol,p.status,
          DATE_FORMAT(p.datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM persona p 
          INNER JOIN rol r 
          ON p.rolid = r.idrol
          WHERE p.idpersona =$this->intIdUsuario";
          $request = $this->select($sql);
         return $request;


     }

     public function updateUsuario(int $idUsuario, int $cedula, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipousuario, int $status){
         
          $this->intIdUsuario = $idUsuario;
          $this->intCedula = $cedula;
          $this->strNombre = $nombre;
          $this->strApellido = $apellido;
          $this->intTelefono = $telefono;
          $this->strEmail = $email;
          $this->strPassword = $password;
          $this->intTipousuario = $tipousuario;
          $this->intStatus = $status;
         
           $sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario) 
           OR (cedula = $this->intCedula AND idpersona != $this->intIdUsuario)";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  if ($this->strPassword != "") 
               {
                  $sql = "UPDATE persona SET cedula =?, nombres =?, apellidos=?, telefono =?, email_user =?, password =?, rolid=?, status=? WHERE idpersona = $this->intIdUsuario";

                   $arrData = array($this->intCedula, 
                                   $this->strNombre,
                                   $this->strApellido,
                                   $this->intTelefono,
                                   $this->strEmail,
                                   $this->strPassword, 
                                   $this->intTipousuario, 
                                   $this->intStatus);
              }else{

                $sql = "UPDATE persona SET cedula =?, nombres =?, apellidos=?, telefono =?, email_user =?, rolid=?, status=? WHERE idpersona = $this->intIdUsuario";

                    $arrData = array($this->intCedula, 
                                     $this->strNombre,
                                     $this->strApellido,
                                     $this->intTelefono,
                                     $this->strEmail,
                                     $this->intTipousuario, 
                                     $this->intStatus);
                      }

       
        $request = $this->update($sql,$arrData);

         }else{
            $request = "exist";
          }
          return $request;
          
      }

      //eliminar usuario

      public function deleteUsuario(int $idpersona)
     {
        $this->intIdUsuario = $idpersona;
        $sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

 
 

   
 }

 ?>

