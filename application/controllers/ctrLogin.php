<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ctrLogin extends CI_Controller
    {
        public function index()
        {
            redirect("ctrLogin/Login");
        }
        
        public function Login()
        {
            $transporte = array();

            $this->load->library('form_validation');

            $this->form_validation->set_rules('usuario', 'Usuario', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() == FALSE)
            {
                if($this->input->post())
                {
                    $transporte["OP"]="MAL";
                }
            }
            else
            {
                $this->load->model("mdlUsuarios");
                
                $usuario = set_value("usuario");
                $password = set_value("password");

                if($idUsuario = $this->mdlUsuarios->Verificar($usuario, $password))
                {
                    $u = $this->mdlUsuarios->obtener($idUsuario);

                    $this->session->set_userdata("uID", $u["IDUsuario"]);
                    $this->session->set_userdata("usuario", $u["Usuario"]);

                    redirect("ctrMontos/Principal"); 
                }
                else
                {
                    $transporte["OP"]="INCORRECTO";
                }               
            }

            $this->load->view('vwLogin', $transporte);
        }

        public function Salir()
        {
            $this->session->sess_destroy();
            redirect("ctrLogin");
        }
    }
?>