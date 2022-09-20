
<?php 


 class InventarioModel extends Mysql
 {   
     private $intIdGanado;            
     private $intCodigo;      
     private $strNombre;
     private $intStock;               
     private $strCategoria; 
     private $strStatus;
     private $strDescripcion; 
     private $strFoto;
     
     public function __construct()
     {
       parent:: __construct();
     }


  public function insertGanado( int $codigo, string $nombre, int $stock, string $categoria, string $status, string $descripcion, string $foto){
    
   
      $this->intCodigo = $codigo;
      $this->strNombre = $nombre;
      $this->intStock = $stock;
      $this->strCategoria = $categoria;
      $this->strStatus = $status;
      $this->strDescripcion = $descripcion;
      $this->strFoto = $foto;
      

      $return = 0;

      $sql = "SELECT * FROM inventario WHERE codigo = '{$this->intCodigo}' ";
      $request = $this->select_all($sql);     

      if(empty($request))
      {
        $query_insert = "INSERT INTO inventario(codigo, nombre, stock, categoria, status, descripcion, foto) VALUES(?,?,?,?,?,?,?)";
       
        $arrData = array(
                         $this->intCodigo, 
                         $this->strNombre,
                         $this->intStock,
                         $this->strCategoria,
                         $this->strStatus,
                         $this->strDescripcion,
                         $this->strFoto
                         );
       
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exist";

      }
      return $return;

   }

   
   public function selectGanados(){

       $sql = "SELECT idganado, codigo, nombre, stock, categoria, status, descripcion, foto
          FROM inventario 
         
          WHERE status !=0";
          $request = $this->select_all($sql);
          return $request;
     } 

     public function selectGanado(int $idganado)
     {
        //buscar usuario +
      $this->intIdGanado = $idganado;
      $sql = "SELECT idganado, codigo, nombre, stock, categoria, status, descripcion, foto,
          DATE_FORMAT(datecreated, '%d-%m-%Y')AS fechaRegistro
          FROM inventario 
          WHERE idganado =$this->intIdGanado";
          $request = $this->select($sql);
         return $request;


     }

     public function updateGanado(int $idUsuario, int $codigo, string $nombre, int $stock, string $categoria, string $status, string $descripcion, string $foto){
         
          $this->intIdGanado = $idUsuario;
          $this->intCodigo = $codigo;
          $this->strNombre = $nombre;
          $this->intStock = $stock;
          $this->strCategoria = $categoria;
          $this->strStatus = $status;
          $this->strDescripcion = $descripcion;
          $this->strFoto = $foto;
             
           $sql = "SELECT * FROM inventario WHERE  codigo = $this->intCodigo AND idganado != $this->intIdGanado";
         
          $request = $this->select_all($sql);

          if (empty($request))
           {  

                $sql = "UPDATE inventario SET codigo =?, nombre =?, stock =?, categoria =?, status =?, descripcion =?, foto=? WHERE idganado = $this->intIdGanado";

                    $arrData = array(
                                     $this->intCodigo, 
                                     $this->strNombre,
                                     $this->intStock,
                                     $this->strCategoria,
                                     $this->strStatus,
                                     $this->strDescripcion,
                                     $this->strFoto);

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
        $sql = "UPDATE inventario SET status = ? WHERE idganado = $this->intIdGanado";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        return $request;
    }

   
 }



