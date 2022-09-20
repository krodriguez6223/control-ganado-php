
<?php 


 class TratamientoModel extends Mysql
 {   
    private $intIdTratamiento;
    private $intCodigo;
    private $intIdGanado;
    private $intStatus; 
     
    //tramiento Banio
    private $strTipoBanio;              
    private $strTipoMedicina;
    private $strFechaBanio;
    private $strFechaProxBanio;
    private $strObservBanio;
    //tramiento desparacitacion
    private $strTipoDesparacitacion;
    private $strTipoDesparasitante;
    private $strFechaDesparasitacion;
    private $strFechaProxDesparasitacion;
    private $strObserDesparacitacion;
    //tramiento vacunacion
    private $strTipoVacunacion;
    private $strNomVacuna;
    private $strFechaVacunacion;
    private $strFechaProxVacunacion;
    private $strObserVacunacion; 
     
     public function __construct()
     {
       parent:: __construct();
     }

 public function insertTratamiento( int $codigo, int $idganado, string $status, ?string $tipoBanio, ?string $tipoMedicina, ?string $fechaBanio, ?string $fechaProxBanio, ?string $obserBanio, ?string $tipoDesparasitacion, ?string $tipoDesparasitante, ?string $fechaDesparasitacion, ?string $fechaProxDesparasitacion, ?string $observDesparasitacion, ?string $tipoVacunacion, ?string $nomVacuna, ?string $fechaVacunacion, ?string $fechaProxVacunacion, ?string $obserVacunacion){
    
   
             $this->intCodigo = $codigo;
             $this->intIdGanado = $idganado;
             $this->intStatus = $status;
            //tramiento Banio
             $this->strTipoBanio = $tipoBanio;               
             $this->strTipoMedicina = $tipoMedicina;
             $this->strFechaBanio = $fechaBanio;
             $this->strFechaProxBanio = $fechaProxBanio;
             $this->strObservBanio = $obserBanio;
            //tramiento desparacitacion
             $this->strTipoDesparacitacion = $tipoDesparasitacion;
             $this->strTipoDesparasitante = $tipoDesparasitante;
             $this->strFechaDesparasitacion = $fechaDesparasitacion;
             $this->strFechaProxDesparasitacion = $fechaProxDesparasitacion;
             $this->strObserDesparacitacion = $observDesparasitacion;
            //tramiento vacunacion
             $this->strTipoVacu = $tipoVacunacion;
             $this->strNomVacuna = $nomVacuna;
             $this->strFechaVacunacion = $fechaVacunacion;
             $this->strFechaProxVacunacion = $fechaProxVacunacion;
             $this->strObserVacunacion =  $obserVacunacion;
            

        $query_insert = "INSERT INTO tratamiento(codigo, ganadoId, status, tipoBanio,  tipoMedicina, fechaBanio, fechaProxBanio, obserBanio, tipoDesparasitacion, tipoDesparasitante, fechaDesparasitacion, fechaProxDesparasitacion, observDesparasitacion, tipoVacunacion, nomVacuna, fechaVacunacion, fechaProxVacunacion, obserVacunacion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
       
        $arrData = array(    $this->intCodigo,
                             $this->intIdGanado,
                             $this->intStatus,
                             //tramiento Banio
                             $this->strTipoBanio,         
                             $this->strTipoMedicina,
                             $this->strFechaBanio,
                             $this->strFechaProxBanio,
                             $this->strObservBanio,
                            //tramiento desparacitacion
                             $this->strTipoDesparacitacion,
                             $this->strTipoDesparasitante,
                             $this->strFechaDesparasitacion,
                             $this->strFechaProxDesparasitacion,
                             $this->strObserDesparacitacion,
                            //tramiento vacunacion
                             $this->strTipoVacu,
                             $this->strNomVacuna,
                             $this->strFechaVacunacion,
                             $this->strFechaProxVacunacion,
                             $this->strObserVacunacion
                             
                         );

        $request_insert = $this->insert($query_insert,$arrData); 
        return $request_insert;

   }

   
   public function selectTratamientos(){

       $sql = "SELECT idTratamiento, codigo, ganadoId, tipoBanio,  tipoMedicina, fechaBanio, fechaProxBanio, obserBanio, tipoDesparasitacion, tipoDesparasitante, fechaDesparasitacion, fechaProxDesparasitacion, observDesparasitacion, tipoVacunacion, nomVacuna, fechaVacunacion, fechaProxVacunacion, obserVacunacion FROM tratamiento  WHERE status !=0";

          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectTratamiento(int $idtratamiento)
     {
        //buscar usuario +
      $this->intIdTratamiento = $idtratamiento;
      $sql = "SELECT idTratamiento, codigo, ganadoId, tipoBanio,  tipoMedicina, fechaBanio, fechaProxBanio, obserBanio, tipoDesparasitacion, tipoDesparasitante, fechaDesparasitacion, fechaProxDesparasitacion, observDesparasitacion, tipoVacunacion, nomVacuna, fechaVacunacion, fechaProxVacunacion, obserVacunacion,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM tratamiento 
          WHERE idtratamiento =$this->intIdTratamiento";
          $request = $this->select($sql);
         return $request;


     }
      //  SENTENCIA PARA BUSQUEDA DE RES PARA REALIZAR EL TRATAMIENTO
     public function searchRes($codigo){

         $this->$codigo = $codigo;

        $sql = "SELECT idganado, codigo, nombres,categoria, status,peso,raza FROM ganado WHERE codigo LIKE '$codigo' and status = 1";

        $request = $this->select($sql);
        return $request;
     }
     

     public function updateTratamiento(int $idTratamiento, int $codigo, string $status, ?string $tipoBanio, ?string $tipoMedicina, ?string $fechaBanio, ?string $fechaProxBanio, ?string $obserBanio, ?string $tipoDesparasitacion, ?string $tipoDesparasitante, ?string $fechaDesparasitacion, ?string $fechaProxDesparasitacion, ?string $observDesparasitacion, ?string $tipoVacunacion, ?string $nomVacuna, ?string $fechaVacunacion, ?string $fechaProxVacunacion, ?string $obserVacunacion){
         
             $this->intIdTratamiento = $idTratamiento;
             $this->intCodigo = $codigo;
             $this->intStatus = $status;
            //tramiento Banio
             $this->strTipoBanio = $tipoBanio;               
             $this->strTipoMedicina = $tipoMedicina;
             $this->strFechaBanio = $fechaBanio;
             $this->strFechaProxBanio = $fechaProxBanio;
             $this->strObservBanio = $obserBanio;
            //tramiento desparacitacion
             $this->strTipoDesparacitacion = $tipoDesparasitacion;
             $this->strTipoDesparasitante = $tipoDesparasitante;
             $this->strFechaDesparasitacion = $fechaDesparasitacion;
             $this->strFechaProxDesparasitacion = $fechaProxDesparasitacion;
             $this->strObserDesparacitacion = $observDesparasitacion;
            //tramiento vacunacion
             $this->strTipoVacu = $tipoVacunacion;
             $this->strNomVacuna = $nomVacuna;
             $this->strFechaVacunacion = $fechaVacunacion;
             $this->strFechaProxVacunacion = $fechaProxVacunacion;
             $this->strObserVacunacion =  $obserVacunacion;
              

                $sql = "UPDATE tratamiento SET codigo =?, status =?, tipoBanio =?, tipoMedicina =?, fechaBanio =?, fechaProxBanio =?, obserBanio=?, tipoDesparasitacion=?, tipoDesparasitante =?, fechaDesparasitacion=?, fechaProxDesparasitacion=?, observDesparasitacion=?, tipoVacunacion=?, nomVacuna=?, fechaVacunacion=?, fechaProxVacunacion=?, obserVacunacion=? WHERE idTratamiento = $this->intIdTratamiento";

                        $arrData = array($this->intCodigo, 
                                         $this->intStatus,
                                         //tramiento Banio
                                         $this->strTipoBanio,         
                                         $this->strTipoMedicina,
                                         $this->strFechaBanio,
                                         $this->strFechaProxBanio,
                                         $this->strObservBanio,
                                        //tramiento desparacitacion
                                         $this->strTipoDesparacitacion,
                                         $this->strTipoDesparasitante,
                                         $this->strFechaDesparasitacion,
                                         $this->strFechaProxDesparasitacion,
                                         $this->strObserDesparacitacion,
                                        //tramiento vacunacion
                                         $this->strTipoVacu,
                                         $this->strNomVacuna,
                                         $this->strFechaVacunacion,
                                         $this->strFechaProxVacunacion,
                                         $this->strObserVacunacion);

        $request = $this->update($sql,$arrData);
        return $request;
          
      }

      //eliminar usuario

      public function deleteTratamiento(int $idtratamiento)
     {
        $this->intIdTratamiento = $idtratamiento;
        $sql = "UPDATE tratamiento SET status = ? WHERE idTratamiento = $this->intIdTratamiento";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }
   
 }



