<?php 

class HistorialModel extends Mysql
 {
     
     public function __construct()
     {
       parent:: __construct();
     }

     public function selectTratamientoIJ(int $Codigo)
     {

      $this->intCodigo = $Codigo;
      $sql = "SELECT  t.codigo,
                      t.tipoBanio,
                      t.tipoMedicina,
                      t.fechaBanio,
                      t.fechaProxBanio,
                      t.obserBanio, 
                      t.tipoDesparasitacion,
                      t.tipoDesparasitante,
                      t.fechaDesparasitacion,
                      t.fechaProxDesparasitacion,
                      t.observDesparasitacion,
                      t.tipoVacunacion, 
                      t.nomVacuna, 
                      t.fechaVacunacion, 
                      t.fechaProxVacunacion,
                      t.obserVacunacion,
                      g.nombres,
                      g.peso,
                      g.peso,
                      g.raza,
                      g.categoria,
                      g.origen,
                      g.lote,
                      g.fecha_nacimiento,
                      g.foto,
          DATE_FORMAT(t.datecreated, '%d-%m-%Y') AS fechaRegistro FROM tratamiento t
              INNER JOIN   ganado g ON t.ganadoid = g.idganado
              WHERE t.codigo = $this->intCodigo";
          $request = $this->select_all($sql);
         return $request;
    }

     public function selectProduccionIJ(int $Codigo)
     {

      $this->intCodigo = $Codigo;

      $sql = "SELECT  p.idProduccion,
                      p.codigo,
                      p.nomOrdeniador,
                      p.cantLitro,
                      p.horario,
                      p.fechaOrdenio,
                      p.fechaObserv, 
                      g.nombres,
                      g.peso,
                      g.peso,
                      g.raza,
                      g.categoria,
                      g.origen,
                      g.lote,
                      g.fecha_nacimiento,
                      g.foto,
          DATE_FORMAT(p.datecreated, '%d-%m-%Y') AS fechaRegistro, SUM(cantLitro) as TotalLitros FROM produccion p
              INNER JOIN   ganado g ON p.ganadoIdpro = g.idganado
              WHERE  p.codigo = $this->intCodigo and p.status  !=0";
          $request = $this->select_all($sql);
         return $request;
    }

   
 }