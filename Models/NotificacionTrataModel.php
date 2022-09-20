<?php 



class NotificacionTrataModel extends Mysql
 
 {
     
     public function __construct()
     {
       parent:: __construct();
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

     //MUESTRA EN LA TABLA LAS RECES A TRATAR DEL DIA ACTUAL
     
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

     //MUESTRA EN LA TABLA LAS RECES A TRATAR EN LOS PROXIMOS 5 DIAS

     //muestra la cantidad de reces a tratamiento baño del prox 5 dias
     public function cantTraBañoCincoDays(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE date_sub(fechaProxBanio, interval 5 day) = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }

     //muestra la cantidad de reces a tratamiento desparacitacion del prox 5 dias
     public function cantTraDesparacitacionCincoDays(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE date_sub(fechaProxDesparasitacion, interval 5 day) = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
       //muestra la cantidad de reces a tratamiento VACUNACION del prox 5 dias
     public function cantTraVacunacionCincoDays(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE date_sub(fechaProxVacunacion, interval 5 day) = curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }

     //muestra reces a tratamiento baño EN LOS PROX. 5 DIAS
     public function TraBañoCincoDays(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaBanio, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE date_sub(t.fechaProxBanio, interval 5 day) = curdate() AND t.status !=0 ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     //muestra  reces a tratamiento desparacitacion EN LOS PROX. 5 DIAS
     public function TraDesparacitacionCincoDays(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaDesparasitacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE date_sub(t.fechaProxDesparasitacion, interval 5 day) = curdate() AND t.status !=0  ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }
     //muestra  reces a tratamiento desparacitacion EN LOS PROX. 5 DIAS
     public function TraVacunacionCincoDays(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaVacunacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE date_sub(t.fechaProxVacunacion, interval 5 day) = curdate() AND t.status !=0";
      $request = $this->select_all($sql);
     
    
      return $request;

     }
/*NOTIFICACION DE TODOS LAS RECES ATRATAR*/

     //muestra reces a tratamiento baño 
     public function TraBañoTodos(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxBanio, g.categoria  
                  FROM tratamiento t 
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxBanio >= curdate() AND t.status !=0 ORDER BY t.fechaProxBanio ASC ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     //muestra  reces a tratamiento desparacitacion 
     public function TraDesparacitacionTodos(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxDesparasitacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxDesparasitacion >= curdate() AND t.status !=0 ORDER BY t.fechaProxDesparasitacion ASC";
      $request = $this->select_all($sql);
     
    
      return $request;

     }
     //muestra  reces a tratamiento desparacitacion 
     public function TraVacunacionTodos(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxVacunacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxVacunacion >= curdate() AND t.status !=0 ORDER BY t.fechaProxVacunacion ASC";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     public function cantTraBañoTodos(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxBanio >= curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }

     
     public function cantTraDesparacitacionTodos(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxDesparasitacion >= curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
       
     public function cantTraVacunacionTodos(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxVacunacion >= curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
     /*NOTIFICACION DE TODOS LAS RECES ATRATAR ATRASADOS*/

     //muestra reces a tratamiento baño 
     public function TraBañoAtrasa(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxBanio, g.categoria  
                  FROM tratamiento t 
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxBanio < curdate() AND t.status !=0 ORDER BY t.fechaProxBanio ASC ";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     //muestra  reces a tratamiento desparacitacion 
     public function TraDesparacitacionAtrasa(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxDesparasitacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxDesparasitacion < curdate() AND t.status !=0 ORDER BY t.fechaProxDesparasitacion ASC";
      $request = $this->select_all($sql);
     
    
      return $request;

     }
     //muestra  reces a tratamiento desparacitacion 
     public function TraVacunacionAtrasa(){

     $sql="SELECT t.idTratamiento, t.codigo, t.fechaProxVacunacion, g.categoria 
                  FROM tratamiento t
                  INNER JOIN ganado g ON t.ganadoid = g.idganado 
                  WHERE t.fechaProxVacunacion < curdate() AND t.status !=0 ORDER BY t.fechaProxVacunacion ASC";
      $request = $this->select_all($sql);
     
    
      return $request;

     }

     public function cantTraBañoAtrasa(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxBanio < curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }

     
     public function cantTraDesparacitacionAtrasa(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxDesparasitacion < curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
       
     public function cantTraVacunacionAtrasa(){

     $sql="SELECT idTratamiento, codigo, COUNT(idTratamiento) total FROM tratamiento WHERE fechaProxVacunacion < curdate() AND status !=0 ";
      $request = $this->select($sql);
      $total = $request['total'];
    
      return $request;

     }
     


   }

 ?>

