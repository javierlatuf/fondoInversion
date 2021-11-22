<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ctrMontos extends CI_Controller 
	{
		private $transporte = array();

		public function __construct()
		{
			parent::__construct();

			if(!$this->session->userdata("uID"))
				redirect("ctrLogin");
	
			$this->transporte["user"]=$this->session->userdata("usuario");
			$this->transporte["uID"]=$this->session->userdata("uID");

			$this->load->model("mdlMontos");
		}

		public function index()
		{
			redirect("ctrMontos/Principal");
		}

		public function Principal()
		{
			$this->load->library("form_validation");

			if(set_value('fecha') != null or set_value('monto') != null)
			{
				$this->form_validation->set_rules("monto", "Monto", "trim|required|numeric");
				$this->form_validation->set_rules("fecha", "Fecha", "trim|required");
			}

			if(set_value('editFecha') != null or set_value('editMonto') != null)
			{
				$this->form_validation->set_rules("editMonto", "Monto", "trim|required|numeric");
				$this->form_validation->set_rules("editFecha", "Fecha", "trim|required");
				file_put_contents("log.txt", "aaa");
			}

			if($this->form_validation->run() == TRUE)
			{
				//Si deja la fecha incompleta pueden quedar d, m, o a del placeholder
				if(set_value('fecha') != null)
				{
					$fecha = str_replace('d', '', set_value("fecha"));
					//file_put_contents("log.txt", "bbb");
				}

				if(set_value('editFecha') != null)
				{
					$fecha = str_replace('d', '', set_value("editFecha"));
					file_put_contents("log.txt", "ccc");
				}	
				
				$fecha = str_replace('m', '', $fecha);
				$fecha = str_replace('a', '', $fecha);

				//Si quedaron menos de 10 caracteres es porque la ingresó incompleta
				if(strlen($fecha) == 10)
				{
					//file_put_contents("log.txt", $fecha);			   
					$fecha = date("Y-m-d", strtotime(str_replace("/", "-", $fecha)));
					
					//if($this->mdlMontos->MayorQueUltimaFecha($fecha))
					//{
						if(set_value('fecha') != null)
						$this->mdlMontos->Agregar(set_value("monto"), $fecha);

						if(set_value('editFecha') != null)
						{
							$this->mdlMontos->Editar(set_value("editID"), set_value("editMonto"), $fecha);
							file_put_contents("log.txt", set_value("editID").set_value("editMonto").$fecha);
						}
						//$this->transporte["fechaIncompleta"] = "";
					//}
				}
				else
				{
					$this->transporte["fechaIncompleta"] = "Fecha incompleta.";	
					//file_put_contents("log.txt", "ccc");		   
				}

				redirect("ctrMontos");
			}

			$this->transporte["montos"] = $this->mdlMontos->Listar();
			$this->transporte["acumulado"] = $this->mdlMontos->CalcularAcumulado();

			$this->load->view('vwMontos', $this->transporte);
		}

		public function Agregar()
		{

		}

		public function Editar()
		{

		}

		public function Listar()
		{

		}

		public function Borrar($idMonto = "")
		{
			$this->mdlMontos->Borrar($idMonto);
			redirect("ctrMontos");
		}
	}
?>