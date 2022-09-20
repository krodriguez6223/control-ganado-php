<?php

class NotificacionTrata extends Controllers{
	
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
	
	public function NotificacionTrata ($parems){
 

		$data['page_tage'] = "Notificacion";
		$data['page_name'] = "notificacion";
		$data['page_title'] ="Notificacion de reces a tratar ";
		$data['page_function_js'] ="functions_notifiTrata.js";

		$data['cantReTratarActualBaño'] = $this->model->cantTraBaño();
	    $data['cantReTratarActualDespa'] = $this->model->cantTraDesparacitacion();
	    $data['cantReTratarActualVacuna'] = $this->model->cantTraVacunacion();

		/*===============================================================
		=   MUESTRA EN LA TABLA RECES A TRATAR HOY  =
		=================================================================*/

	    $data['TratarActualBañoHOY'] = $this->model->TraBañoHOY();
	    $data['TratarActualDespaHOY'] = $this->model->TraDesparacitacionHOY();
	    $data['TratarActualVacunaHOY'] = $this->model->TraVacunacionHOY();


		/*===============================================================
		=   MUESTRA EN LA TABLA RECES A TRATAR EN LOS PROXIMOS 5 DIAS  =
		=================================================================*/
	   
	    $data['cantTratarProxCincoBaño'] = $this->model->cantTraBañoCincoDays();
	    $data['cantTratarProxCincoDespa'] = $this->model->cantTraDesparacitacionCincoDays();
	    $data['cantTratarProxCincoVacuna'] = $this->model->cantTraVacunacionCincoDays();

	    /*===============================================================
		=   MUESTRA EN LA TABLA LA CANT. A TRATAR EN LOS PROXIMOS 5 DIAS  =
		=================================================================*/
	   
	    $data['TrataBañoProxCinco'] = $this->model->TraBañoCincoDays();
	    $data['TrataDespaProxCinco'] = $this->model->TraDesparacitacionCincoDays();
	    $data['TrataVacuProxCinco'] = $this->model->TraVacunacionCincoDays();

	    /*===============================================================
		=   MUESTRA EN LA TABLA TODAS LAS RECES A TRATAR  =
		=================================================================*/

	    $data['TrataBañoTodos'] = $this->model->TraBañoTodos();
	    $data['TrataDespaTodos'] = $this->model->TraDesparacitacionTodos();
	    $data['TrataVacuTodos'] = $this->model->TraVacunacionTodos();
	    
	    /*===============================================================
		=   MUESTRA EN LA TABLA LA CANT. A TRATAR DE TODAS      =
		=================================================================*/
	   
	    $data['cantTrataBañoTodos'] = $this->model->cantTraBañoTodos();
	    $data['cantTrataDespaTodos'] = $this->model->cantTraDesparacitacionTodos();
	    $data['cantTrataVacuTodos'] = $this->model->cantTraVacunacionTodos();

	    /*===============================================================
		=   MUESTRA EN LA TABLA RECES ATRASADOS A TRATAR  =
		=================================================================*/

	    $data['TrataBañoAtrasa'] = $this->model->TraBañoAtrasa();
	    $data['TrataDespaAtrasa'] = $this->model->TraDesparacitacionAtrasa();
	    $data['TrataVacuAtrasa'] = $this->model->TraVacunacionAtrasa();
	    
	    /*===============================================================
		=   MUESTRA EN LA TABLA LA CANT. DE TRATA. ATRASADOS		 =
		=================================================================*/

	    $data['cantTrataBañoAtrasa'] = $this->model->cantTraBañoAtrasa();
	    $data['cantTrataDespaAtrasa'] = $this->model->cantTraDesparacitacionAtrasa();
	    $data['cantTrataVacuAtrasa'] = $this->model->cantTraVacunacionAtrasa();


		$this->views->getView($this,"notificacionTrata",$data);
	
	}
		
	
}


 ?>


