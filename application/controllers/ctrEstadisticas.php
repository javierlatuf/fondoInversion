<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ctrEstadisticas extends CI_Controller 
	{
		private $transporte = array();

		public function __construct()
		{
			parent::__construct();

			if(!$this->session->userdata("uID"))
				redirect("ctrLogin");

			$this->load->model("mdlEstadisticas");
		}

		public function index()
		{
            redirect("ctrEstadisticas/Cargar");
		}

        public function Cargar()
        {
			$this->transporte["acumulado"] = $this->mdlEstadisticas->CalcularAcumulado();
            $this->transporte["mayorMonto"] = $this->mdlEstadisticas->ObtenerMayorMonto();
			$this->transporte["menorMonto"] = $this->mdlEstadisticas->ObtenerMenorMonto();
            $this->transporte["mayorDif"] = $this->mdlEstadisticas->ObtenerMayorDif();
            $this->transporte["menorDif"] = $this->mdlEstadisticas->ObtenerMenorDif();
            $this->transporte["promedioMontos"] = $this->mdlEstadisticas->CalcularPromedioMontos();
            $this->transporte["promedioDif"] = $this->mdlEstadisticas->CalcularPromedioDif();

			$this->transporte["mayorAlza"] = $this->mdlEstadisticas->ObtenerMayorAlza();
			$this->transporte["menorAlza"] = $this->mdlEstadisticas->ObtenerMenorAlza();
			$this->transporte["mayorBaja"] = $this->mdlEstadisticas->ObtenerMayorBaja();
			$this->transporte["menorBaja"] = $this->mdlEstadisticas->ObtenerMenorBaja();

			//$this->transporte["datos"] = $this->mdlEstadisticas->Listar();

			$this->transporte["fechas"] = $this->mdlEstadisticas->ObtenerFechas();
			$this->transporte["montos"] = $this->mdlEstadisticas->ObtenerMontos();

            /*$this->transporte[0] = $this->mdlEstadisticas->ObtenerMayorMonto();
			$this->transporte[1] = $this->mdlEstadisticas->ObtenerMenorMonto();
            $this->transporte[2] = $this->mdlEstadisticas->ObtenerMayorDif();
            $this->transporte[3] = $this->mdlEstadisticas->ObtenerMenorDif();
            $this->transporte[4] = $this->mdlEstadisticas->CalcularPromedioMontos();
            $this->transporte[5] = $this->mdlEstadisticas->CalcularPromedioDif();*/

            //$this->transporte["estadisticas"] = $this->mdlEstadisticas->ObtenerEstadisticas();

			$this->load->view('vwEstadisticas', $this->transporte);
        }
	}
?>