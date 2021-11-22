<?php
    class mdlMontos extends CI_Model
    {
        function Listar($orden = "DESC")
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("Fecha, IDMonto", $orden);

            return $this->db->get("Montos")->result_array();
        }

        function ObtenerPrimero()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("IDMonto", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerPrimero1()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("IDMonto", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos");
        }

        function ObtenerUltimo()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("IDMonto", "DESC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function CalcularAcumulado()
        {
            $primero = $this->ObtenerPrimero();
            $ultimo = $this->ObtenerUltimo();

            if($primero and $ultimo)
            {
                if($primero["IDMonto"] == $ultimo["IDMonto"])
                    return 0;
                else
                    return $ultimo["Monto"] - $primero["Monto"];
            }
            else
                return 0;
        }

        function Agregar($monto = 0, $fecha = "")
        {
            $ultimo = $this->ObtenerUltimo();
            if($ultimo)
                $this->db->set("Diferencia", $monto - $ultimo["Monto"]);
            else
                $this->db->set("Diferencia", 'NULL', false);

            $this->db->set("Fecha", $fecha);
            $this->db->set("Monto", $monto);
            $this->db->set("IDUsuario", $this->session->userdata("uID"));

            $this->db->insert("Montos");
        }

        function Borrar($idMonto = 0)
        {
            $this->CorregirDiferencia_Borrar($idMonto);

            $this->db->where("IDMonto", $idMonto);
            $this->db->limit(1);

            $this->db->delete("Montos");

            return $this->db->affected_rows();
        }

        function Editar($idMonto = 0, $monto = 0, $fecha = "")
        {
            $this->CorregirDiferencia_Editar($idMonto, $monto);

            $this->db->set("Fecha", $fecha);
            $this->db->set("Monto", $monto);
            $this->db->where("IDMonto", $idMonto);
            $this->db->limit(1);

            $this->db->update("Montos");

            return $this->db->affected_rows();
        }

        /*function MayorQueUltimaFecha($fecha = "")
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("Fecha", "DESC");
            $this->db->limit(1);

            $query = $this->db->get("Montos");
            $res = $query->row();

            $fecha = date("Y-m-d");
        }*/

        function CorregirDiferencia_Editar($idMonto = 0, $monto = 0)
        {
            $query = $this->ObtenerPrimero1();
            $res = $query->row();
            $primero = $res->IDMonto;

            if($primero <> $idMonto)//Edito la diferencia si no elegi el primero. El primero no tiene diferencia
            {
                //Traer el monto anterior al que edite para recalcular diferencia
                $this->db->select("Monto");
                $this->db->where("IDUsuario", $this->session->userdata("uID"));
                $this->db->where("IDMonto <".$idMonto);//cambiar por fechaa!!!!!
                $this->db->order_by("IDMonto", "DESC");
                $this->db->limit(1);

                $query2 = $this->db->get("Montos");
                $res2 = $query2->row();
                $montoAnt = $res2->Monto;

                //Corregir el que edite
                $nuevaDif = $monto - $montoAnt;
                $this->db->set("Diferencia", $nuevaDif);
                $this->db->where("IDMonto", $idMonto);
                $this->db->limit(1);

                $this->db->update("Montos");
            }

            //Corregir el siguiente
            $this->db->select("IDMonto, Monto");
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->where("IDMonto >".$idMonto);//cambiar por fechaa!!!!!
            $this->db->order_by("IDMonto", "ASC");
            $this->db->limit(1);

            $query2 = $this->db->get("Montos");
            $res2 = $query2->row();
            $idCorregir = $res2->IDMonto;
            $montoSig = $res2->Monto;

            $nuevaDif = $montoSig - $monto;
            $this->db->set("Diferencia", $nuevaDif);
            $this->db->where("IDMonto", $idCorregir);
            $this->db->limit(1);

            $this->db->update("Montos");
        }

        function CorregirDiferencia_Borrar($idMonto = 0)
        {
            //Chequear si borré el primero
            $query = $this->ObtenerPrimero1();
            $res = $query->row();
            $primero = $res->IDMonto;

            //file_put_contents("log.txt", $primero." ".$idMonto);

            if($primero == $idMonto)
            {
                //Traigo dif a corregir
                //file_put_contents("log.txt", "fdgf");
                $this->db->select("IDMonto");
                $this->db->where("IDUsuario", $this->session->userdata("uID"));
                $this->db->where("IDMonto >".$idMonto);//cambiar por fechaa!!!!!
                $this->db->order_by("IDMonto", "ASC");
                $this->db->limit(1);

                $query2 = $this->db->get("Montos");
                $res2 = $query2->row();
                $idCorregir = $res2->IDMonto;

                $this->db->set("Diferencia", "null");
                $this->db->where("IDMonto", $idCorregir);
                $this->db->limit(1);

                $this->db->update("Montos");
            }
            else //es otro
            {
                //Traigo diferencia del monto que borraré
                $this->db->select("Diferencia");
                $this->db->where("IDMonto", $idMonto);
                $this->db->limit(1);

                $query = $this->db->get("Montos");
                $res = $query->row();
                $dif = $res->Diferencia;
                //file_put_contents("log.txt", $idMonto." ".$dif);

                //Traigo dif a corregir
                $this->db->select("IDMonto, Diferencia");
                $this->db->where("IDUsuario", $this->session->userdata("uID"));
                $this->db->where("IDMonto >".$idMonto);//cambiar por fechaa!!!!!
                $this->db->order_by("IDMonto", "ASC");
                $this->db->limit(1);

                $query2 = $this->db->get("Montos");

                if($query2->num_rows() > 0)
                {
                    $res2 = $query2->row();
                    $idCorregir = $res2->IDMonto;
                    $dif2 = $res2->Diferencia;
                    //file_put_contents("log.txt", " aaa ".$idCorregir." ".$dif2, FILE_APPEND);

                    $nuevaDif = $dif + $dif2;

                    $this->db->set("Diferencia", $nuevaDif);
                    $this->db->where("IDMonto", $idCorregir);
                    $this->db->limit(1);
        
                    $this->db->update("Montos");
                }
            }
        }
    }
?>