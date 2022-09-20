<?php 

 /**
  * summary
  */
 class DashboardModel extends Mysql
 {
     
     public function __construct()
     {
       parent:: __construct();
     }

     
     public function cantGanado(){

      $sql="SELECT COUNT(*) total FROM ganado WHERE status !=0";
      $request = $this->select($sql);
      $total = $request['total'];
      return $total;
     }

     public function cantEmpleados(){

      $sql="SELECT COUNT(*) total FROM empleado WHERE status !=0";
      $request = $this->select($sql);
      $total = $request['total'];
      return $total;
     }

      public function cantVentas(){

      $sql="SELECT COUNT(*) total FROM venta WHERE status !=0";
      $request = $this->select($sql);
      $total = $request['total'];
      return $total;
     }
      public function cantTratamiento(){

      $sql="SELECT COUNT(*) total FROM tratamiento";
      $request = $this->select($sql);
      $total = $request['total'];
      return $total;
     }

     public function lastOrders(){
     
     }

     // CONSULTA PARA OBTENER LAS VACAS ORDEÑADAS DEL DIA
     public function producDiaria(){

      $diaActual = date('Y-m-d');

      $sql = "SELECT codigo, nomOrdeniador, cantLitro, horario, fechaOrdenio FROM produccion WHERE  
      DATE(fechaOrdenio) =  '$diaActual' AND status !=0 ORDER BY cantLitro DESC LIMIT 10";
      $total = $this->select_all($sql);
     
      return $total;

     }


     // CONSULTA PARA OBTENER LA PRODUCCION MENSUAL DE LECHE 
     public function producMensual(int $mes, int $anio){

      $sql = "SELECT codigo, SUM(cantLitro) AS totalProduccion FROM produccion WHERE  MONTH(fechaOrdenio) = $mes AND YEAR (fechaOrdenio) = $anio AND status !=0";

      $meses = Meses();

      $total = $this->select_all($sql);
      $arrData = array('mes'=> $meses[intval($mes -1 )], 'anio' => $anio, 'totalProduccion' => $total);
      return $arrData;
     }

       public function selectProMesDia(int $anio, int $mes){

        $totalProduccionMes = 0;
        $arrProduccionDias = array();
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $n_dias = 1;
        for ($i= 0; $i < $dias ; $i++){
        $date = date_create($anio."-".$mes."-".$n_dias);
        $fechaProduccion = date_format($date, "Y-m-d");  

      $sql = "SELECT DAY(fechaOrdenio) AS dia, COUNT(idProduccion) as cantidad, SUM(cantLitro) as total FROM produccion WHERE DATE(fechaOrdenio) = '$fechaProduccion' AND status !=0"; 

        $produccionDia = $this->select($sql);
        $produccionDia['dia'] = $n_dias;
        $produccionDia['total'] = $produccionDia['total'] == "" ? 0 : $produccionDia['total'];
        $totalProduccionMes += $produccionDia['total'];
        array_push($arrProduccionDias, $produccionDia);
        $n_dias++;
        }
        $meses = Meses();
        $arrData = array('anio' => $anio, 'mes'=> $meses[intval($mes -1 )], 'total'=> $totalProduccionMes, 'produccion' => $arrProduccionDias);
        return $arrData;   
 }


     public function selectTotalProduAnio(int $anio){

      $sql= "SELECT $anio AS anio,  SUM(cantLitro) AS produLeche
                  FROM produccion
                  WHERE YEAR(fechaOrdenio)= $anio AND status !=0 ";

      $total = $this->select_all($sql);
      $arrData = array('anio' => $anio, 'totalProduccion' => $total);
      return $arrData;

     }

      public function selectProduAnioMes(int $anio){
        $arrMProduccion = array();
        $arrMeses = Meses();
        for ($i=1; $i < 13; $i++) { 
          $arrData = array('anio'=>'','no_mes'=>'','mes'=>'','produLeche'=>'');
          
          $sql = "SELECT $anio AS anio, $i AS mes, SUM(cantLitro) AS produLeche
                  FROM produccion
                  WHERE MONTH(fechaOrdenio)= $i AND YEAR(fechaOrdenio)= $anio AND status !=0 
                  GROUP BY MONTH(fechaOrdenio)";
          $produccionMes = $this->select($sql);


          $arrData['mes'] = $arrMeses[$i-1];

         
          if (empty($produccionMes)) {
                $arrData['anio'] = $anio;
                $arrData['no_mes'] = $i;
                $arrData['produLeche'] = 0;
          }else{
                $arrData['anio'] =   $produccionMes['anio'];
                $arrData['no_mes'] = $produccionMes['mes'];
                $arrData['produLeche'] =  $produccionMes['produLeche'];

          }

          array_push($arrMProduccion, $arrData); 


        }
        $arrProduccion = array('anio'=> $anio, 'meses' => $arrMProduccion);
        return $arrProduccion;

      }

       // CONSULTA PARA OBTENER LA PRODUCCION MENSUAL DE LECHE POR LA MAÑANA
   
     public function producTotalmesMañana(int $mes, $anio){

      $sql = "SELECT SUM(cantLitro) as totalProduccionMañana FROM produccion WHERE MONTH(fechaOrdenio) = $mes AND YEAR(fechaOrdenio) = $anio AND  status !=0 AND horario = 'Mañana'";
      $meses = Meses();
      $total = $this->select_all($sql); 

      if (empty($total[0]['totalProduccionMañana']) ) {

         $total[0] = array('totalProduccionMañana' => 0);
         
         $arrData = array('mes'=> $meses[intval($mes -1 )], 'totalmañana' => $total);

         return $arrData;
       
       }else{

        $arrData = array('mes'=> $meses[intval($mes -1 )], 'totalmañana' => $total);   
                 
        return $arrData;
   
       } 
      
      
    }
     
      public function producTotalmesTarde(int $mes, $anio){

      $sql = "SELECT SUM(cantLitro) as totalProduccionTarde FROM produccion WHERE MONTH(fechaOrdenio) = $mes AND YEAR(fechaOrdenio) = $anio AND status !=0 AND horario = 'tarde'";
      $meses = Meses();
      $total = $this->select_all($sql); 
     

      if (empty($total[0]['totalProduccionTarde'])) {

        $total[0] = array('totalProduccionTarde' => 0);
        
        $arrData = array('mes'=> $meses[intval($mes -1 )], 'totaltarde' => $total); 
      
        return $arrData;  

       }else{

        $arrData = array('mes'=> $meses[intval($mes -1 )], 'totaltarde' => $total); 
        return $arrData;

       } 
     
    }
}

 ?>