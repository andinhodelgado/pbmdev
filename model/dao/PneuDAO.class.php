<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./dbutil/Conn.class.php');
/**
 * Description of PneuDAO
 *
 * @author anderson
 */
class PneuDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($pneu) {

        $select = " SELECT "
                . " EQUIPCOMPO_ID AS \"idPneu\" "
                . " , CD AS \"codPneu\" "
                . " FROM "
                . " VMB_PNEU "
                . " WHERE "
                . " CD LIKE '" . $pneu . "'";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}