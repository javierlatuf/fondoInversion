<?php
    class mdlEstadisticas extends CI_Model
    {
        /*function Listar()
        {
            $this->db->order_by("Fecha", "ASC");

            return $this->db->get("Montos")->result_array();
        }*/

        function ObtenerFechas()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select("Fecha");
            $this->db->order_by("Fecha", "ASC");

            return $this->db->get("Montos")->result_array();
        }

        function ObtenerMontos()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select("Monto");
            $this->db->order_by("Fecha", "ASC");

            return $this->db->get("Montos")->result_array();
        }

        function ObtenerMayorMonto()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("Monto", "DESC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMenorMonto()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("Monto", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMayorDif()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select("Fecha, ABS(Diferencia) as Diferencia");
            $this->db->where("Diferencia is not null");
            $this->db->order_by("Diferencia", "DESC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMenorDif()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select("Fecha, ABS(Diferencia) as Diferencia");
            $this->db->where("Diferencia is not null");
            $this->db->order_by("Diferencia", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMayorAlza()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->where("Diferencia is not null");
            $this->db->where("Diferencia > 0");
            $this->db->order_by("Diferencia", "DESC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMenorAlza()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->where("Diferencia is not null");
            $this->db->where("Diferencia > 0");
            $this->db->order_by("Diferencia", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMayorBaja()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->where("Diferencia is not null");
            $this->db->where("Diferencia < 0");
            $this->db->order_by("Diferencia", "DESC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function ObtenerMenorBaja()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->where("Diferencia is not null");
            $this->db->where("Diferencia < 0");
            $this->db->order_by("Diferencia", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
        }

        function CalcularPromedioMontos()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select_sum("Monto");

            $query = $this->db->get("Montos");
            $res = $query->result();
            $total = $res[0]->Monto;

            //file_put_contents("log.txt", $total);
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $cantidad = $this->db->get("Montos");

            if($cantidad->num_rows() == 0)
                return null;
            else
                return $total / $cantidad->num_rows();
        }

        function CalcularPromedioDif()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->select_sum("ABS(Diferencia)", "Diferencia");
            //$this->db->select_sum("Diferencia");

            $query = $this->db->get("Montos");
            $res = $query->result();
            $total = $res[0]->Diferencia;

            $this->db->where("Diferencia is not null");
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $cantidad = $this->db->get("Montos");

            if($cantidad->num_rows() == 0)
                return null;
            else
                return $total / $cantidad->num_rows();
        }

        function ObtenerPrimero()
        {
            $this->db->where("IDUsuario", $this->session->userdata("uID"));
            $this->db->order_by("IDMonto", "ASC");
            $this->db->limit(1);

            return $this->db->get("Montos")->row_array();
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

        /*function ObtenerEstadisticas()
        {
            $transporte = array();

            $transporte["mayorMonto"] = $this->ObtenerMayorMonto();
            $transporte["menorMonto"] = $this->ObtenerMenorMonto();
            $transporte["mayorDif"] = $this->ObtenerMayorDif();
            $transporte["menorDif"] = $this->ObtenerMenorDif();
            $transporte["promedioMontos"] = $this->CalcularPromedioMontos();
            $transporte["promedioDif"] = $this->CalcularPromedioDif();

            return $transporte->row_array();
        }*/
    }
?>