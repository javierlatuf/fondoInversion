<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ctrUsuarios extends CI_Controller
    {
        //private $transporte = array();

        public function __construct()
        {
            parent::__construct();

            if(!$this->session->userdata("uID"))
                redirect("ctrLogin");

            $this->load->model("mdlUsuarios");
        }

        public function index()
        {
            redirect("ctrUsuarios/Principal");
        }

        public function Principal()
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('actual', 'Contraseña Actual', 'required');
            $this->form_validation->set_rules('nueva', 'Nueva Contraseña', 'required');
            $this->form_validation->set_rules('confirmacion', 'Confirmación Nueva Contraseña', 'required');

            if($this->form_validation->run() == TRUE)
            {
                $usuario = $this->session->userdata("usuario");
                $password = set_value("actual");
                $password2 = set_value("nueva");
                $password3 = set_value("confirmacion");
                //file_put_contents("log.txt", $usuario.$password.$password2.$password3);

                if($idUsuario = $this->mdlUsuarios->Verificar($usuario, $password) and ($password2 == $password3))
                {
                    $u = $this->mdlUsuarios->obtener($idUsuario);

                    $this->mdlUsuarios->CambiarPass($idUsuario, $password3);

                    redirect("ctrUsuarios/Principal"); 
                }
            }

            $this->load->view('vwUsuario');
        }

        public function Baja()
        {
            $this->mdlUsuarios->Baja($this->session->userdata["uID"]);
            redirect("ctrLogin");
        }

        public function Salir()
        {
            $this->session->sess_destroy();
            redirect("ctrLogin");
        }
    }
?>