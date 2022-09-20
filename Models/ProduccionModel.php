
<?php 


 class ProduccionModel extends Mysql
 {   
    private $intIdProduccion;
    private $intCodigo;
    private $intIdGanado;
    private $intStatus; 
     
    //tramiento Banio
    private $strNomOrdeñador;              
    private $intCantLitro;
    private $strHorario;
    private $strFechaOrdeño;
    private $strFechaObserv;
        
     
     public function __construct()
     {
       parent:: __construct();
     }
public function empleados(){

       $sql = "SELECT idganado, nombres, apellidos, cargo FROM empleado  WHERE status !=0";

          $request = $this->select_all($sql);
          return $request;
     }


  public function insertProduccion( int $codigo, int $idganado, string $status, string $nomOrdeñador, int $cantLitro, string $horario, string $fechaOrdeño, string $fechaObserv){
    
   
             $this->intCodigo = $codigo;
             $this->intIdGanado = $idganado;
             $this->intStatus = $status;
             $this->strNomOrdeñador = $nomOrdeñador;               
             $this->intCantLitro = $cantLitro;
             $this->strHorario = $horario;
             $this->strFechaOrdeño = $fechaOrdeño;
             $this->strFechaObserv = $fechaObserv;
            

        $query_insert = "INSERT INTO produccion(codigo, ganadoIdpro, status, nomOrdeniador, cantLitro, horario, fechaOrdenio, fechaObserv) VALUES(?,?,?,?,?,?,?,?)";
       
        $arrData = array(    $this->intCodigo,
                             $this->intIdGanado,
                             $this->intStatus,
                             $this->strNomOrdeñador,             
                             $this->intCantLitro,
                             $this->strHorario,
                             $this->strFechaOrdeño,
                             $this->strFechaObserv
                                             
                         );

        $request_insert = $this->insert($query_insert,$arrData); 
        return $request_insert;

   }

   
   public function selectProducciones(){

       $sql = "SELECT idProduccion, codigo, ganadoIdpro, status, nomOrdeniador, cantLitro, horario, fechaOrdenio, fechaObserv FROM produccion  WHERE status !=0";

          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectProduccion(int $idproduccion)
     {
        //buscar usuario +
      $this->intIdProduccion = $idproduccion;
      $sql = "SELECT idProduccion, codigo, ganadoIdpro, status, nomOrdeniador, cantLitro, horario, fechaOrdenio, fechaObserv,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM produccion 
          WHERE idproduccion =$this->intIdProduccion";
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
     

     public function updateTratamiento(int $idProduccion, int $codigo, int $idganado, string $status, string $nomOrdeñador, int $cantLitro, string $horario, string $fechaOrdeño, string $fechaObserv){
         
             $this->intIdProduccion = $idProduccion;
             $this->intCodigo = $codigo;
             $this->intIdGanado = $idganado;
             $this->intStatus = $status;
             $this->strNomOrdeñador = $nomOrdeñador;               
             $this->intCantLitro = $cantLitro;
             $this->strHorario = $horario;
             $this->strFechaOrdeño = $fechaOrdeño;
             $this->strFechaObserv = $fechaObserv;
              

                $sql = "UPDATE produccion SET codigo =?, status = ?, nomOrdeniador = ?, cantLitro = ?, horario = ?, fechaOrdenio = ?, fechaObserv =? WHERE idProduccion = $this->intIdProduccion";

                        $arrData = array(
                                         $this->intCodigo,
                                         $this->intStatus,
                                         $this->strNomOrdeñador,             
                                         $this->intCantLitro,
                                         $this->strHorario,
                                         $this->strFechaOrdeño,
                                         $this->strFechaObserv
                                     );

        $request = $this->update($sql,$arrData);
        return $request;
          
      }

      //eliminar usuario

      public function deleteProduccion(int $idproduccion)
     {
        $this->intIdProduccion = $idproduccion;
        $sql = "UPDATE produccion SET status = ? WHERE idProduccion = $this->intIdProduccion";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

    //NOTIFICACIONES DE TRATAMIENTO 
     //muestra reces a tratamiento baño del actual dia
     public function TraBañoHOY(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaBanio, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxBanio = curdate() AND t.status !=0 ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     //muestra  reces a tratamiento desparacitacion del actual dia
     public function TraDesparacitacionHOY(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaDesparasitacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxDesparasitacion = curdate() AND t.status !=0  ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }
     //muestra  reces a tratamiento desparacitacion del actual dia
     public function TraVacunacionHOY(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaVacunacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxVacunacion = curdate() AND t.status !=0";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

         //muestra la cantidad de reces a tratamiento baño del actual dia
     public function cantTraBaño(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxBanio = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }

     //muestra la cantidad de reces a tratamiento desparacitacion del actual dia
     public function cantTraDesparacitacion(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxDesparasitacion = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
       //muestra la cantidad de reces a tratamiento VACUNACION del actual dia
     public function cantTraVacunacion(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxVacunacion = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }


   
 }



