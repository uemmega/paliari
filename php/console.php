#!/usr/bin/env php
<?php

// Utilize este arquivo para testar rapidamente a classe pela linha de comando
// executar assim: php console.php 112.10

require_once 'Troco.php';

$reais = $argv[1] ?: 0;
$arrayNotas = $argv[2] ?: null;

$troco = new Troco();

$notas = $troco->getQtdeNotas($reais, $arrayNotas);

print_r($notas);
