<?php

require('./dao/InserirApontFert2DAO.class.php');
require('./dao/InserirDadosDAO.class.php');

$inserirApontDAO = new InserirApontFert2DAO();
$inserirDadosDAO = new InserirDadosDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $dados = $info['dado'];
    $inserirDadosDAO->salvarDados($dados, "inserirbolpneu");
    $pos1 = strpos($dados, "_") + 1;
    $pos2 = strpos($dados, "|") + 1;
    
    $bolpneu = substr($dados, 0, ($pos1 - 1));
    $itemmedpneu = substr($dados, $pos1, (($pos2 - 1) - $pos1));
    $itemmanutpneu = substr($dados, $pos2);
    
    $jsonObjBolPneu = json_decode($bolpneu);
    $jsonObjItemMedPneu = json_decode($itemmedpneu);
    $jsonObjItemManutPneu = json_decode($itemmanutpneu);
    $dadosBolPneu = $jsonObjBolPneu->bolpneu;
    $dadosItemMedPneu = $jsonObjItemMedPneu->itemmedpneu;
    $dadosItemManutPneu = $jsonObjItemManutPneu->itemmanutpneu;

    $inserirApontDAO->salvarDados($dadosBolPneu, $dadosBolPneu, $dadosItemPneu);

    echo 'GRAVOUPNEU';
    
endif;