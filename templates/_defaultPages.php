<?php 
$homepage = $pages->get('/');
$colorspage = $pages->findOne('name=colori, template=variabili');
$qualitapage = $homepage->child; // mi raccomando, QUALITA' PERROS deve restare la prima pagina child
$termspage = $pages->findOne('name=termini-condizioni, template=terms-page');