<?php
    class mdlUsuarios extends CI_Model
    {
        public function Verificar($usuario= "", $password = "")
        {
            $this->db->select("IDUsuario");
            $this->db->where("Usuario", $usuario); 
            $this->db->where("Password", $password);
            $this->db->limit(1);
            
            $res = $this->db->get("Usuarios");

            if($res->num_rows())
            {
                $temp = $res->row_array();
                $this->ActualizarUltLogin($temp["IDUsuario"]);

                return $temp["IDUsuario"];
            }else
            {
                return false;
            }
        }

        public function Obtener($idUsuario = "")
        {
            $this->db->where("IDUsuario", $idUsuario);
            $this->db->where("Baja", 0);
            $this->db->limit(1);
            $res = $this->db->get("Usuarios");
            return $res->row_array();
        }

        public function ActualizarUltLogin($idUsuario = "")
        {
            $this->db->where("IDUsuario", $idUsuario);
            $this->db->set("UltLogin", "NOW()", false);
            $this->db->update("Usuarios");
        }

        public function Baja($idUsuario = "")
        {
            $this->db->where("IDUsuario", $idUsuario);
            $this->db->set("Baja", 1);
            $this->db->update("Usuarios");

            return $this->db->affected_rows();
        }

        public function CambiarPass($idUsuario = "", $nueva = "")
        {
            //file_put_contents("log.txt", $idUsuario.$nueva);
            $this->db->where("IDUsuario", $idUsuario);
            $this->db->set("Password", $nueva);
            $this->db->update("Usuarios");

            return $this->db->affected_rows();
        }
    }
?>