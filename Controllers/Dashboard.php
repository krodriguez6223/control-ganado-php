<?php 

class Dashboard extends Controllers{
	
	public function __construct()
	{   
		parent:: __construct();
		session_start();
		if (empty($_SESSION['login'])) 
		{
			header('Location: '.base_url().'/login');
		}
		getPermisos(1);
	}
	public function Dashboard ($parems){
 
		$data['page_tage'] = "Dashboard"; 
		$data['page_name'] = "dashboard";
		$data['page_title'] ="Panel de control ";
		$data['page_function_js'] ="functions_dashboard.js";

       //widgets de dashboard
	    $data['ganado'] = $this->model->cantGanado();
	    $data['empleados'] = $this->model->cantEmpleados();
	    $data['ventas'] = $this->model->cantVentas();
	    $data['tratamiento'] = $this->model->cantTratamiento();
	    $data['lastOrders'] = $this->model->lastOrders();

	    //graficos produccion de leche
	    $anio = date('Y');
	    $mes = date('m');
	    $dia =date('d');

	    $data['gProduccionLeche']   = $this->model->producMensual($mes, $anio);
	    $data['gProduccionMesDia']  = $this->model->selectProMesDia($anio, $mes); 
	    $data['gProduccionAnioMes'] = $this->model->selectProduAnioMes($anio);
	    $data['produTotalAnio'] 	= $this->model->selectTotalProduAnio($anio);
	    $data['producTotalmesMañana'] = $this->model->producTotalmesMañana($mes, $anio);
	    $data['producTotalmesTarde'] = $this->model->producTotalmesTarde($mes, $anio);

	    $data['proDiaria'] = $this->model->producDiaria();

		$this->views->getView($this,"dashboard",$data);
		$this->views->getView($this,"graficosProduccion",$data);


	}
  }

 ?>
 