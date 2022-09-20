
<?php 


 class GanadoModel extends Mysql
 {   
     private $intIdGanado;            
     private $intCodigo;      
     private $strNombre;
     private $intPeso;               
     private $strRaza;
     private $strCategoria;
     private $strOrigen;
     private $strLote;             
     private $strFechaNacimiento;
     private $intStatus;  
     private $strMortalidad; 
     private $strObservacion;            
     private $strfotoRes;

     /*confinguacion de select*/ 
     private $strConfiLote;
     private $strConfiRaza;
     private $strConfiCategoria;
     private $strConfiOrigen;   
     
     public function __construct()
     {
       parent:: __construct();
     }


  public function insertGanado( int $codigo, string $nombre, float $peso, string $raza, string $categoria, string $origen, string $lote, string $fecha_nacimiento, int $status, ?string $mortalidad, string $observacion, string $fotoRes){
    
   
      $this->intCodigo = $codigo;
      $this->strNombre = $nombre;
      $this->intPeso = $peso;
      $this->strRaza = $raza;
      $this->strCategoria = $categoria;
      $this->strOrigen = $origen;
      $this->strLote = $lote;
      $this->strFechaNacimiento = $fecha_nacimiento;  
      $this->intStatus = $status;
      $this->strMortalidad = $mortalidad; 
      $this->strObservacion = $observacion;
      $this->strfotoRes = $fotoRes;


      $return = 0;

      $sql = "SELECT * FROM ganado WHERE codigo = '{$this->intCodigo}' ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO ganado(codigo, nombres, peso, raza, categoria, origen, lote, fecha_nacimiento, status, mortalidad, observacion, foto) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
       
        $arrData = array(
                         $this->intCodigo, 
                         $this->strNombre,
                         $this->intPeso,
                         $this->strRaza,
                         $this->strCategoria, 
                         $this->strOrigen,
                         $this->strLote,
                         $this->strFechaNacimiento,
                         $this->intStatus,
                         $this->strMortalidad,
                         $this->strObservacion,
                         $this->strfotoRes);
       
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }

   public function  insertConfiGanado(?string $lote, ?string $raza, ?string $categoria, ?string $origen){
    
   $this->strConfiLote = $lote;
   $this->strConfiRaza = $raza;
   $this->strConfiCategoria = $categoria;
   $this->strConfiOrigen = $origen;

   $query_insert = "INSERT INTO configganado(lote, raza, categoria, origen) VALUES (?,?,?,?)";

    $return = 0;
   
    $arrData = array(  $this->strConfiLote,
                       $this->strConfiRaza,
                       $this->strConfiCategoria,
                       $this->strConfiOrigen);

    $request_insert = $this->insert($query_insert, $arrData);
    
    return $return;
   }

   public function selectConfiLote(){

    $sql = "SELECT lote FROM configganado where lote is not null "; 

    $request = $this->select_all($sql);
    return $request;

   }
   public function selectConfiRaza(){

    $sql = "SELECT raza FROM configganado where raza is not null "; 

    $request = $this->select_all($sql);
    return $request;

   }
   public function selectConfiCate(){

    $sql = "SELECT categoria FROM configganado where categoria is not null "; 

    $request = $this->select_all($sql);
    return $request;

   }
   public function selectConfiOrigen(){

    $sql = "SELECT origen FROM configganado where origen is not null "; 

    $request = $this->select_all($sql);
    return $request;

   }

   
   public function selectGanados(){

       $sql = "SELECT idganado, codigo, nombres, peso, raza, categoria, origen, lote, fecha_nacimiento, status, mortalidad, observacion, foto
          FROM ganado 
         
          WHERE status !=0";
          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectGanado(int $idganado)
     {
        //buscar usuario +
      $this->intIdGanado = $idganado;
      $sql = "SELECT idganado, codigo, nombres, peso, raza, categoria, origen, lote, fecha_nacimiento, status, mortalidad, observacion, foto,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM ganado 
          WHERE idganado =$this->intIdGanado";
          $request = $this->select($sql);
         return $request;


     }

     public function updateGanado(int $idUsuario, int $codigo, string $nombre, float $peso,string $raza, string $categoria,  string $origen, string $lote, string $fecha_nacimiento, int $status, ?string $mortalidad, string $observacion, string $fotoRes){
         
          $this->intIdGanado = $idUsuario;
          $this->intCodigo = $codigo;
          $this->strNombre = $nombre;
          $this->intPeso = $peso;
          $this->strRaza = $raza;
          $this->strCategoria = $categoria;   
          $this->strOrigen = $origen;
          $this->strLote = $lote;
          $this->strFechaNacimiento = $fecha_nacimiento;  
          $this->intStatus = $status;
          $this->strMortalidad = $mortalidad; 
          $this->strObservacion = $observacion;
          $this->strfotoRes = $fotoRes;
             
           $sql = "SELECT * FROM ganado WHERE  codigo = $this->intCodigo AND idganado != $this->intIdGanado";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  

                $sql = "UPDATE ganado SET codigo =?, nombres =?, peso =?, raza =?, categoria =?, origen=?, lote=?, fecha_nacimiento =?, status=?, mortalidad=?, observacion=?,  foto=? WHERE idganado = $this->intIdGanado";

                    $arrData = array($this->intCodigo, 
                                     $this->strNombre,
                                     $this->intPeso,
                                     $this->strRaza,
                                     $this->strCategoria,
                                     $this->strOrigen,
                                     $this->strLote,
                                     $this->strFechaNacimiento,
                                     $this->intStatus,
                                     $this->strMortalidad,
                                     $this->strObservacion,
                                     $this->strfotoRes);

        $request = $this->update($sql,$arrData);

         }else{
            $request = "exist";
          }
          return $request;
          
      }

      public function deleteGanado(int $idganado)
     {
        $this->intIdGanado = $idganado;
        $sql = "UPDATE ganado SET status = ? WHERE idganado = $this->intIdGanado";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

   
 }



