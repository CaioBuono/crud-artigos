<?php
use Tema\TemaLayout;

$variaveisSistema['titleHead'] = $tituloCabecalho;

echo TemaLayout::getLayout($variaveisSistema, 'estrutura', 'estrutura-header.html');