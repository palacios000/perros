<?php 
//prendi la pagina pettorina PROVA
$pettorina = $pages->get(1068);

require_once("../swell-php/lib/Swell.php");

$swell = new Swell\Client('perros', 'LA4gxiC6yKMBXp4xM9mOtsWX5nWVeDDf');

$products = $swell->get('/products', [
	'id' => "$pettorina->codice",
]);


?>

<?php include 'inc/head.php'; ?>


  <body>
    		
    	<button onclick="addToSwellCart()">add <?= $pettorina->title ?></button>

    	<!-- copy from nuxt -->
        <div x-data="alpineStore()" >
          <template x-if="myCart">
              <template x-for="item in myCart.items">
                <span x-text="item.product.name"></span>
                </template>
              </template>
        </div>

    	<!-- copy end -->
  </body>
</html>
