<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
require_once ('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of BoletimPneu
 *
 * @author anderson
 */
class BoletimPneuDAO extends Conn {

    //put your code here

    public function verifBoletimPneu($bolPneu, $tipoAplic) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PMP_BOLETIM "
                . " WHERE "
                . " FUNC_MATRIC = " . $bolPneu->funcBolPneu
                . " AND "
                . " EQUIP_ID = " . $bolPneu->equipBolPneu
                . " AND "
                . " TIPO_APLIC = " . $tipoAplic
                . " AND "
                . " DTHR_CEL = TO_DATE('" . $bolPneu->dthrBolPneu . "','DD/MM/YYYY HH24:MI') ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idBoletimPneu($bolPneu, $tipoAplic) {

        $select = " SELECT "
                . " ID AS IDBOLPNEU "
                . " FROM "
                . " PMP_BOLETIM "
                . " WHERE "
                . " FUNC_MATRIC = " . $bolPneu->funcBolPneu
                . " AND "
                . " EQUIP_ID = " . $bolPneu->equipBolPneu
                . " AND "
                . " TIPO_APLIC = " . $tipoAplic
                . " AND "
                . " DTHR_CEL = TO_DATE('" . $bolPneu->dthrBolPneu . "','DD/MM/YYYY HH24:MI') ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['IDBOLPNEU'];
        }

        return $id;
    }

    public function insBoletimPneu($bolPneu, $tipoAplic) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PMP_BOLETIM ("
                . " FUNC_MATRIC "
                . " , EQUIP_ID "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " , TIPO_APLIC "
                . " ) "
                . " VALUES ("
                . " " . $bolPneu->funcBolPneu
                . " , " . $bolPneu->equipBolPneu
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($bolPneu->dthrBolPneu)
                . " , TO_DATE('" . $bolPneu->dthrBolPneu . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $tipoAplic
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
