#!/usr/bin/env php
<?php

// Utilize este arquivo para testar rapidamente a classe pela linha de comando
// executar assim: php console.php 112.10

require_once 'Troco.php';

$reais = $argv[1] ?: 0;
//$arrayNotas = $argv[2] ?: null;

$arrayNotas=null;
/*$arrayNotas = [
		'100' => 0,
		'0.5' => 0,
		'0.25' => 0,
		'0.1' => 0,
		'0.01' => 0,
];*/

$troco = new Troco();

$notas = $troco->getQtdeNotas($reais, $arrayNotas);

print_r($notas);
