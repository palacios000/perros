<?php 
//prendi la pagina pettorina PROVA
$pettorina = $pages->get(1068);

require_once("../swell-php/lib/Swell.php");

$swell = new Swell\Client('perros', 'LA4gxiC6yKMBXp4xM9mOtsWX5nWVeDDf');

$products = $swell->get('/products', [
	'id' => "$pettorina->codice",
]);

// print_r($products);
?>

<?php include 'inc/head.php'; ?>

    <script type="module">
      import swell from 'https://cdn.skypack.dev/swell-js';

      window.swell = swell;

      swell.init('perros', 'pk_ZdR0rU8LGHdbvfs80ZZAT9u4RCeGbUE1', {
        useCamelCase: true,
        url: 'https://perros.swell.store/',
      });

      window.addToSwellCart = function addToSwellCart() {
      	swell.cart.addItem({
      	  product_id: '<?= $pettorina->codice ?>',
      	  quantity: 1,
      	  options: {
      	    Taglia: 'EP25-m',
      	    Colore: 'rosso'
      	  }
      	});
      	// console.log('ciao');
      }

      // swell.products
      //   .list({
      //     limit: 1,
      //   })
      //   .then((response) => {
      //     const el = document.getElementById('products');
      //     el.innerHTML = JSON.stringify(response.results, null, '  ');
      //   });
    </script>
  </head>
  <body>
    <pre id="products">Getting products...</pre>
    <div class="">
    	<button onclick="addToSwellCart()">add <?= $pettorina->title ?></button>
    </div>
  </body>
</html>
