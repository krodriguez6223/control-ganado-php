<?php 
 class Mysql extends Conexion{

 	private $conexion;
 	private $strquery;
 	private $arrValues;

 	function __construct()
 	{
 		$this->conexion = new Conexion();
 		$this->conexion =$this->conexion->conect();
 	}
 	//insertar un registro::INSERTAR
 	public function insert(string $query, array $arrValues)
 	{
 		$this->strquery = $query;
 		$this->arrValues = $arrValues;

 		$insert = $this->conexion->prepare($this->strquery);
 		$resInsert = $insert->execute($this->arrValues);
 		if ($resInsert)
 		 {
 		 	$lastInsert = $this->conexion->lastInsertid();
			
 		}else {
 			$lastInsert = 0;
 		}
 		return $lastInsert;
 	}

 	//buscar un registro especifico::BUSCAR-ESPECIFICO
 public function select(string $query){
  $this->strquery = $query;
  $result = $this->conexion->prepare($this->strquery);
  $result->execute();
  $data = $result->fetch(PDO::FETCH_ASSOC);
  return $data;
 }
 	//busca todos los registro del array::BUSCAR COMPLETA
 	public function select_all(string $query)
  {
 		$this->strquery =$query;
 		$result = $this->conexion->prepare($this->strquery);
 		$result->execute();
 		$data = $result->fetchall(PDO::FETCH_ASSOC);
 		return $data;
 	}

 	//Acutualizar registros:: ACTUALIZAR
     public function update (string $query, array $arrValues)
     {
     	$this->strquery = $query;
     	$this->arrValues = $arrValues;
     	$update = $this->conexion->prepare($this->strquery);
     	$resExecute = $update->execute($this->arrValues);
     	return $resExecute;
     }
     //eliminar registro:: ELIMINAR
      
      public function delete(string $query){
      	$this->strquery = $query;
      	$result = $this->conexion->prepare($this->strquery);
      	$del=$result->execute();
      	return $del;
      }
  }
 
 ?>