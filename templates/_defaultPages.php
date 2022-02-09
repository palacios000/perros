<?php 
$homepage = $pages->get('/');
$colorspage = $pages->findOne('name=colori, template=variabili');
$qualitapage = $homepage->child;