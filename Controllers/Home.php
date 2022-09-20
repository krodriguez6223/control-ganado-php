<?php 

class home extends Controllers{
	public function __construct()
	{
       parent:: __construct();
	}
	public function home($parems){


		$data['page_id'] =1;
		$data['tag_page'] = "Home";
		$data['page_title'] = "Pagina principal";
		$data['page_content'] ="lorem fs  gldgdl dgldhh lhlf";
		$this->views->getView($this,"home",$data);
	}
		
	
}


 