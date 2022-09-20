

     <?php 

 class ClientesModel extends Mysql
 {   
     private $intIdCliente;            
     private $intCedula;      
     private $strNombre;               
     private $strApellido; 
     private $intTelefono;             
     private $strEmail;  
     private $strDireccion;                 
     private $intStatus; 
     private $strObservacion;   
     
     public function __construct()
     {
       parent:: __construct();
     }

  public function insertCliente( int $cedula, string $nombre, string $apellido, int $telefono, string $email, string $direccion, int $status, string $observacion){
      
   
      $this->intCedula = $cedula;
      $this->strNombre = $nombre;
      $this->strApellido = $apellido;
      $this->intTelefono = $telefono;
      $this->strEmail = $email;
      $this->strDireccion = $direccion; 
      $this->intStatus = $status;
      $this->strObservacion = $observacion;


      $return = 0;

      $sql = "SELECT * FROM cliente WHERE
      email_user ='{$this->strEmail}' OR cedula = $this->intCedula ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO cliente(cedula,nombres,apellidos,telefono,email_user,direccion,status, observacion ) VALUES(?,?,?,?,?,?,?,?)";
       
        $arrData = array(
                         $this->intCedula, 
                         $this->strNombre,
                         $this->strApellido,
                         $this->intTelefono,
                         $this->strEmail,
                         $this->strDireccion, 
                         $this->intStatus,
                         $this->strObservacion);
       
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }

    public function selectClientes(){

       $sql = "SELECT idCliente,cedula,nombres,apellidos,telefono,email_user,status,direccion,observacion 
          FROM cliente  WHERE status !=0 ";
          $request = $this->select_all($sql);
          return $request;
     }

    
     public function getCliente(int $idcliente)
     {
        
      $this->intIdCliente = $idcliente;
      $sql = "SELECT idCliente,cedula,nombres,apellidos,telefono,email_user,status,direccion,observacion,
          DATE_FORMAT(datecreatred, '%d-%m-%Y')AS fechaRegistro
          FROM cliente 
          WHERE idcliente =$this->intIdCliente";
          $request = $this->select($sql);
         return $request;


     }

     public function updateCliente(int $idCliente,  int $cedula, string $nombre, string $apellido, int $telefono, string $email, string $direccion, int $status, string $observacion){
         
          $this->intIdCliente = $idCliente;
          $this->intCedula = $cedula;
          $this->strNombre = $nombre;
          $this->strApellido = $apellido;
          $this->intTelefono = $telefono;
          $this->strEmail = $email;
          $this->strDireccion = $direccion; 
          $this->intStatus = $status;
          $this->strObservacion = $observacion;
         
           $sql = "SELECT * FROM cliente WHERE (email_user = '{$this->strEmail}' AND idCliente != $this->intIdCliente) 
           OR (cedula = $this->intCedula AND idCliente != $this->intIdCliente)";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  
              $sql = "UPDATE cliente SET cedula =?, nombres =?, apellidos=?, telefono =?, email_user =?, direccion=?, status=?, observacion=? WHERE idcliente = $this->intIdCliente";

                    $arrData = array($this->intCedula, 
                                     $this->strNombre,
                                     $this->strApellido,
                                     $this->intTelefono,
                                     $this->strEmail,
                                     $this->strDireccion, 
                                     $this->intStatus,
                                     $this->strObservacion);
       
        $request = $this->update($sql,$arrData);

         }else{
            $request = "exist";
          }
          return $request;
          
      }

      //eliminar usuario

      public function deleteCliente(int $idcliente)
     {
        $this->intIdCliente = $idcliente;
        $sql = "UPDATE cliente SET status = ? WHERE idcliente = $this->intIdCliente";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }


 

   
 }

 ?>

