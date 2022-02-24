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

    <script type="module">
      import swell from 'https://cdn.skypack.dev/swell-js';
      import Alpine from 'https://cdn.skypack.dev/alpinejs';
       

      window.swell = swell;

      swell.init('perros', 'pk_ZdR0rU8LGHdbvfs80ZZAT9u4RCeGbUE1', {
        useCamelCase: false,
        url: 'https://perros.swell.store/',
      });

      window.addToSwellCart = function addToSwellCart() {
      	swell.cart.addItem({
      	  product_id: '<?= $pettorina->codice ?>',
      	  quantity: 1,
      	});
      };

      const myCart = await swell.cart.get();
      console.log(myCart);
      var totale = myCart.sub_total;

      console.log(myCart.item_quantity);
      console.log(totale);
      console.log(myCart.id);

      window.Alpine = Alpine;
      
      window.alpineStore = function alpineStore(){
        return{
          myCart,
          fetchCart(){
            swell.cart.get().then(cart => {
              myCart = cart
            })
          }
        }
      }
       
      Alpine.start()
      //
    </script>
  </head>
  <body>
    		
    	<button onclick="addToSwellCart()">add <?= $pettorina->title ?></button>

    	<!-- copy from nuxt -->
        <div x-data="alpineStore()" >
          <template x-if="myCart">
              <template x-for="item in myCart.items">
                <span x-text="item.quantity"></span>
                </template>
              </template>
        </div>

    	<!-- copy end -->
  </body>
</html>
