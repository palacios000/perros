<?php 

// SeoMaestro ### 
// Add the brand name after the title. 
// https://github.com/wanze/SeoMaestro#___renderseodatavalue
$wire->addHookAfter('SeoMaestro::renderSeoDataValue', function (HookEvent $event) {
	$sanitizer = $this->wire('sanitizer');

    $group = $event->arguments(0);
    $name = $event->arguments(1);
    $value = $event->arguments(2);
    
    if ($group === 'meta' && $name === 'description') {
        $description = $sanitizer->truncate($value, [
            'type' => 'sentence',
            'maxLength' => 300,
            'visible' => true,
            'convertEntities' => true
        ]) ;
        $event->return = $sanitizer->text($description) ;
    }
    if ($group === 'opengraph' && $name === 'description') {
        $description = $sanitizer->truncate($value, [
	        'type' => 'sentence',
	        'maxLength' => 500,
          	'visible' => true,
            'convertEntities' => true,
            'keepFormatTags' => false
          ]) ;
        $event->return = $sanitizer->text($description) ;
    }
});


/**
  * 
  * Soluzione per creare file json con tutti le varianti prodotto 
  * 
*/   
    $wire->addHookAfter('Pages::saved', function($event) {

      $page = $event->arguments(0);
      $config = wire('config');
      $pages  = wire('pages');

      if ($page->template == "sc-product") {
      // if ($page->template == "cambia-questo") {

        // imposta file sul server
        $jsonName = "snipcart.json";
        $filePath = $config->paths->assets . "files/" . $page->id . "/" . $jsonName;
        $httpPath = $config->paths->httpAssets . "files/" . $page->id . "/" . $jsonName;

        // imposta json
        $json = array();
        $jsonItem = array();
        $taglie = array();
        $colori = $pages->findOne("name=colori, template=variabili");
        $minuteria = array('acciaio', 'bronzo' ); // acciaio bronzo, senza star li' a cercare le pagine
        foreach ($page->snipcart_item_variations as $item) {
            $prezzo = floatval(number_format($item->product_variations->price, 2, '.', ''));
            $jsonItem['id'] = $item->product_variations->code;
            $jsonItem['price'] = $prezzo;
            $jsonItem['url'] = $httpPath;
            $json[] = $jsonItem;

            // aggiungi tutte le taglie
            if ($page->product_options->colours) {
                $taglieColori = array();
                foreach ($colori->children as $colore) {
                    $taglieColori['id'] = $item->product_variations->code . "_" . substr($colore->name, 0, 4);
                    $taglieColori['price'] = $prezzo;
                    $taglieColori['url'] = $httpPath;
                    $json[] = $taglieColori;

                    // aggiungi minuteria
                    if ($page->product_options->minuteria) {
                        $taglieMinuteria = array();
                        $prezzoExtra = $prezzo + floatval($page->product_options->price_extra);
                        foreach ($minuteria as $key => $value) {
                            $taglieMinuteria['id'] = $taglieColori['id'] . "-" . $value;
                            $taglieMinuteria['price'] = $prezzoExtra;
                            $taglieMinuteria['url'] = $httpPath;
                            $json[] = $taglieMinuteria;
                        }
                    }
                }
            }
        }

        //crea tutte le varianti colore
        $json = json_encode($json);

        //create file
        $snipCartJson = fopen("$filePath", "w");
        fwrite($snipCartJson, $json);
        fclose($snipCartJson);

        // 2 scrivi sul log
        // wire('log')->save('notifiche', "$page->title : salvata!");

        // 3 spara un messaggio di notifica sulla pagina
        throw new WireException("Aggiornato JSon per Snipcart $filePath");
      }

    });