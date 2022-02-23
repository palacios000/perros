<html>
<?php include 'inc/head.php'; ?>

    <script type="module">
      import swell from 'https://cdn.skypack.dev/swell-js';
      import Alpine from 'https://cdn.skypack.dev/alpinejs';
       
      //Swell
      window.swell = swell;

      swell.init('perros', 'pk_publicKey', {
        useCamelCase: false,
        url: 'https://perros.swell.store/',
      });

      // questo funziona...
      window.addToSwellCart = function addToSwellCart() {
      	swell.cart.addItem({
      	  product_id: '6214e4357bfc61013dd4ff7c',
      	  quantity: 1,
      	});
      };

      const myCart = await swell.cart.get();
      var totale = myCart.sub_total;

      console.log(totale); // funziona

      // Alpine
      window.Alpine = Alpine;
      
      // Dovrei prendere le variabili
      // che mi passa Swell e portarle dentro Alpine, in modo che possa poi
      // cambiare i pezzi di html della pagina (fare un output dei valori Swell nella pagina html)
      function alpineStore(){
        return{
          alpTotal: totale,
        }
      } // ovviamente non funziona

      Alpine.start()
    </script>
  </head>
  <body>
    <div class="grid grid-cols-2">
    	<div class="">
    		<!-- ok funziona -->
    		<button onclick="addToSwellCart()">add Product</button>
    	</div>

    	<div class="" >
    		<!-- Qui in Alpine come si fa? -->
        	<h3>Cart <span x-data="alpineStore()" x-text="alpineStore.alpTotal"></span></h3>
        </div>
    </div>
  </body>
</html>
