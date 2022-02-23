<?php 

require_once("../swell-php/lib/Swell.php");

$swell = new Swell\Client('perros', 'LA4gxiC6yKMBXp4xM9mOtsWX5nWVeDDf');


/**
 * esporta i prodotti
 */

$products = $pages->find("template=sc-product, codice='', limit=1");
// $products = "";

$colori = array();
foreach ($colorspage->children as $colordot) {
	$colori[] = array('name' => $colordot->name);
}

$minuteria = array('tradizionale', 'bronzo', 'acciaio');
foreach ($products as $product) {

	$taglie = array();
	foreach ($product->snipcart_item_variations as $variant) {
		$taglie[] = array('name' => $variant->product_variations->code );
	}
	$opzioni = array();
	foreach ($minuteria as $key => $value) {
		$opzioni[] = array('name' => $value);
	}

	$nome = $sanitizer->markupToLine($product->title);

	$addItem = $swell->post('/products', [
	  'name' => $nome,
	  'active' => true,
	  'description' => $product->snipcart_item_description,
	  'options' => [
	    [
	      'name' => 'Colore',
	      'values' => $colori,
	    ],
	    [
	    	'name'=> 'Taglia',
	    	'values' => $taglie,
	    ],
	    [
	    	'name'=> 'Minuteria',
	    	'values' => $opzioni,
	    ]
      
	  ],
	]);


	$product->of(false);
	$product->codice = $addItem['id'];
	$product->save();

	$productOut = $product->title . " " . $addItem['id'];
	$productOut .= "format nome" . $nome;

}

/**
 * esporta le varianti di ogni singolo prodotto
 */

$productsReady = $pages->find("template=sc-product, codice!='', swell_imported=0, limit=1");

foreach ($productsReady as $productOK) {

	foreach ($productOK->snipcart_item_variations as $variant) {
		if ($productOK->product_options->minuteria) {
			
			$prezzo = $variant->product_variations->price + $productOK->product_options->price_extra;	

			//bronzo
			if ($productOK->product_options->solo_bronzo) {
				$swell->post('/products:variants', [
				  'parent_id' => $productOK->codice,
				  'name' => "{$variant->product_variations->code}, bronzo",
				  'active' => true,
				  'price' => $prezzo,
				]);

			}else{
				// ho due opzioni bronzo/acciaio
				$minuteria = array('bronzo' , 'acciaio' );
				foreach ($minuteria as $key => $value) {
					$swell->post('/products:variants', [
					  'parent_id' => $productOK->codice,
					  'name' => "{$variant->product_variations->code}, $value",
					  'active' => true,
					  'price' => $prezzo,
					]);
					
				}
			}
			//tradizionale
			$swell->post('/products:variants', [
			  'parent_id' => $productOK->codice,
			  'name' => "{$variant->product_variations->code}, tradizionale",
			  'active' => true,
			  'price' => $variant->product_variations->price,
			]);
		}else{
			// non ho minuteria
			$swell->post('/products:variants', [
			  'parent_id' => $productOK->codice,
			  'name' => $variant->product_variations->code,
			  'active' => true,
			  'price' => $variant->product_variations->price,
			]);

		}
	};

	//segnala il prodotto come esprotato
	$productOK->of(false);
	$productOK->swell_imported = 1;
	$productOK->save();

	$productOut .= " - variation:" . $productOK->title;
}


 ?>
<html>
	<?php echo $productOut; ?>
	
</html>