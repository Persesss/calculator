<?php

const KASSA = array(50, 20, 10, 5, 2, 1);
const CENT = array(50, 20, 10, 5);

if (count($argv) <= 1) {
    echo "Geen wisselgeld";
    exit();
}

$geldinput = $argv[1];



function nummeric($geldinput) 
{
    if (!is_numeric($geldinput)) {
        throw new Exception("Geen wisselgeld meegegeven.");
    }

    return $geldinput;
}

function euro($geldinput) 
{
    if ($geldinput < 0) {
        throw new Exception('Input moet een positief getal zijn');
    } if ($geldinput == "0") {
        throw new Exception("Geen wisselgeld.");
    }

    $eenheden = explode(".", $geldinput);      
    $euro = intval($eenheden[0]);
    $euro = round($euro);
    foreach (KASSA as $geld) {
        $check = floor($euro / $geld);
        if ($check >= 1) {
            $bedrag = $check * $geld;
            $euro = $euro - $bedrag;
            echo "$check x $geld euro" . PHP_EOL;
        }
    }
}

function centen($geldinput) 
{
    $eenheden = explode(".", $geldinput);
    if (count($eenheden) == 1) {
        return; 
    }
    $centen = intval($eenheden[1]);
    $dec = round($centen / 5) * 5;

    foreach (CENT as $geld) {
        $check = floor($dec / $geld);
        if ($check >= 1) {
            $bedrag2 = $check * $geld;
            $dec = $dec - $bedrag2;
            echo "$check x $geld cent" . PHP_EOL;
        }
    }
}


try {
    nummeric($geldinput);
    euro($geldinput);
    centen($geldinput);
} catch (Exception $e) {
    echo $e->getMessage();
}


?>