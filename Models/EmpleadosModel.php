
<?php 


 class EmpleadosModel extends Mysql
 {   
     private $intIdGanado;            
     private $intCedula;      
     private $strNombres;
     private $strApellidos;               
     private $strCorreo ; 
     private $intContacto; 
     private $intEdad;
     private $strCargo;
     private $strObservacion;
     private $strEstado;             
     private $strFotoEmpleado;
      
     public function __construct()
     {
       parent:: __construct();
     }


  public function insertGanado( int $cedula, string $nombres, string $apellidos, string $correo, string $contacto, string $edad, string $cargo, string $observacion, int $status, string $fotoEmpleado){
    
   
      $this->intCedula = $cedula;
      $this->strNombres = $nombres;
      $this->strApellidos = $apellidos;
      $this->strCorreo = $correo;
      $this->intContacto = $contacto;
      $this->intEdad = $edad;
      $this->strCargo = $cargo;
      $this->strObservacion = $observacion;
      $this->intStatus = $status;
      $this->strFotoEmpleado = $fotoEmpleado;


      $return = 0;

      $sql = "SELECT * FROM empleado WHERE cedula = '{$this->intCedula}' ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO empleado(cedula, nombres, apellidos, correo, contacto, edad, cargo, observacion, status, foto) VALUES(?,?,?,?,?,?,?,?,?,?)";
       
        $arrData = array(
                          $this->intCedula,
                          $this->strNombres,
                          $this->strApellidos,
                          $this->strCorreo,
                          $this->intContacto,
                          $this->intEdad,
                          $this->strCargo,
                          $this->strObservacion,
                          $this->intStatus,
                          $this->strFotoEmpleado);
       
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }

   public function selectGanados(){

       $sql = "SELECT idganado, cedula, nombres, apellidos, correo, contacto, edad, cargo, observacion, status, foto
          FROM empleado 
         
          WHERE status !=0";
          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectGanado(int $idganado)
     {
        //buscar usuario +
      $this->intIdGanado = $idganado;
      $sql = "SELECT idganado, cedula, nombres, apellidos, correo, contacto, edad, cargo, observacion, status, foto,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM empleado 
          WHERE idganado =$this->intIdGanado";
          $request = $this->select($sql);
         return $request;


     }

     public function updateGanado(int $idUsuario, int $cedula, string $nombres, string $apellidos, string $correo, string $contacto, string $edad, string $cargo, string $observacion, int $status, string $fotoEmpleado){
         
          $this->intIdGanado = $idUsuario;
          $this->intCedula = $cedula;
          $this->strNombres = $nombres;
          $this->strApellidos = $apellidos;
          $this->strCorreo = $correo;
          $this->intContacto = $contacto;
          $this->intEdad = $edad;
          $this->strCargo = $cargo;
          $this->strObservacion = $observacion;
          $this->intStatus = $status;
          $this->strFotoEmpleado = $fotoEmpleado;
             
           $sql = "SELECT * FROM empleado WHERE  cedula = $this->intCedula AND idganado != $this->intIdGanado";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  

                $sql = "UPDATE empleado SET cedula =?, nombres =?, apellidos =?, correo =?, contacto =?, edad =?, cargo=?, observacion=?, status=?, foto=? WHERE idganado = $this->intIdGanado";

                    $arrData = array( $this->intCedula,
                                      $this->strNombres,
                                      $this->strApellidos,
                                      $this->strCorreo,
                                      $this->intContacto,
                                      $this->intEdad,
                                      $this->strCargo,
                                      $this->strObservacion,
                                      $this->intStatus,
                                      $this->strFotoEmpleado);

        $request = $this->update($sql,$arrData);

         }else{
            $request = "exist";
          }
          return $request;
          
      }

      //eliminar usuario

      public function deleteGanado(int $idganado)
     {
        $this->intIdGanado = $idganado;
        $sql = "UPDATE empleado SET status = ? WHERE idganado = $this->intIdGanado";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

   
 }



