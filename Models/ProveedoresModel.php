
<?php 


 class ProveedoresModel extends Mysql
 {   
     private $intIdGanado;                         
     private $intCedula;              
     private $strNombre;               
     private $intContacto;             
     private $strDireccion;              
     private $strCorreo;              
     private $strCategoria;              
     private $strObservacion;        
     private $strEstado;    
     
     public function __construct()
     {
       parent:: __construct();
     }


  public function insertGanado( int $cedula, string $nombre, string $contacto, string $direccion, string $email, string $categoria, string $observacion, string $estado){
    
   
      $this->intCedula = $cedula;
      $this->strNombre = $nombre;
      $this->intContacto = $contacto;
      $this->strDireccion = $direccion;
      $this->strCorreo = $email;
      $this->strCategoria = $categoria;
      $this->strObservacion = $observacion;
      $this->strEstado = $estado;
     
      $return = 0;

      $sql = "SELECT * FROM proveedor WHERE cedula = '{$this->intCedula}' ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO proveedor(cedula, nombres, contacto, direccion, email, categoria, observacion, status) VALUES(?,?,?,?,?,?,?,?)";
       
        $arrData = array(
                          $this->intCedula, 
                          $this->strNombre, 
                          $this->intContacto, 
                          $this->strDireccion, 
                          $this->strCorreo, 
                          $this->strCategoria, 
                          $this->strObservacion, 
                          $this->strEstado 
                      );
                           
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }

   
   public function selectGanados(){

       $sql = "SELECT idganado, cedula, nombres, contacto, direccion, email, categoria, observacion, status
          FROM proveedor 
         
          WHERE status !=0";
          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectGanado(int $idganado)
     {
        //buscar usuario +
      $this->intIdGanado = $idganado;
      $sql = "SELECT idganado, cedula, nombres, contacto, direccion, email, categoria, observacion, status,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM proveedor 
          WHERE idganado =$this->intIdGanado";
          $request = $this->select($sql);
         return $request;


     }

     public function updateGanado(int $idUsuario, int $cedula, string $nombre, int $contacto, string $direccion, string $email, string $categoria, string $observacion, string $estado){
         
          $this->intIdGanado = $idUsuario;
          $this->intCedula = $cedula;
          $this->strNombre = $nombre;
          $this->intContacto = $contacto;
          $this->strDireccion = $direccion;
          $this->strCorreo = $email;
          $this->strCategoria = $categoria;
          $this->strObservacion = $observacion;
          $this->strEstado = $estado;
         
             
           $sql = "SELECT * FROM proveedor WHERE  cedula = $this->intCedula AND idganado != $this->intIdGanado";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  

                $sql = "UPDATE proveedor SET cedula =?, nombres =?, contacto =?, direccion =?, email =?, categoria =?, observacion=?, status=? WHERE idganado = $this->intIdGanado";

                    $arrData = array( 
                                      $this->intCedula, 
                                      $this->strNombre, 
                                      $this->intContacto, 
                                      $this->strDireccion, 
                                      $this->strCorreo, 
                                      $this->strCategoria, 
                                      $this->strObservacion, 
                                      $this->strEstado
                                  );

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
        $sql = "UPDATE proveedor SET status = ? WHERE idganado = $this->intIdGanado";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

   
 }



