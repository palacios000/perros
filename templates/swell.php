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
      	  options: {
      	    Taglia: 'EP25-m',
      	    Colore: 'rosso'
      	  }
      	});
      	// console.log('ciao');
      };

      const myCart = await swell.cart.get();
      var totale = myCart.sub_total;

      console.log(myCart.item_quantity);
      console.log(totale);
      console.log(myCart.id);

      // await swell.cart.get()
      //   .then((response) => {
      //     const el = document.getElementById('products');
      //     el.innerHTML = JSON.stringify(response.results, null, '  ');
      //   });

      window.Alpine = Alpine;
      
      Alpine.alpineStore({
      	return{
	      	alpTotal: totale,
      	)}
      };
       
      Alpine.start()
      //
    </script>
  </head>
  <body>
    <pre id="products">Getting products...</pre>
    <div class="grid grid-cols-2">
    	<div class="">
    		
    		<button onclick="addToSwellCart()">add <?= $pettorina->title ?></button>
    	</div>

    	<!-- copy from nuxt -->
    	<div class="panel h-full  max-w-112" >
    	    <div class="h-full w-full overflow-y-scroll bg-primary-lightest" >
    	        <div class="container relative border-b border-primary-med py-5" >
    	            <div class="flex items-center justify-between" >
    	                <h3>
    	                    Cart<span x-data="alpineStore()" x-text="alpineStore.alpTotal"></span></h3> <button ><div class="h-7 w-7"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="vertical-align: -0.125em;-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify icon:uil:multiply h-7 w-7" data-icon="uil:multiply"><path fill="currentColor" d="m13.41 12l6.3-6.29a1 1 0 1 0-1.42-1.42L12 10.59l-6.29-6.3a1 1 0 0 0-1.42 1.42l6.3 6.29l-6.3 6.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l6.29-6.3l6.29 6.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42Z"></path></svg></div></button></div>
    	            <div class="mt-4 text-sm" ></div>
    	        </div>
    	        <div >
    	            <div  class="container overflow-hidden">
    	                <div class="flex py-6">
    	                    <a href="/products/test-collare/" class="block w-24 flex-shrink-0">
    	                        <div class="overflow-hidden rounded relative bg-primary-lighter w-full pb-full overflow-hidden" style="padding-bottom: 100%;"><img src="https://cdn.schema.io/perros/621358b40b8e4601324c5a1e/038795bc1659e755b0c9866ed2b47574?width=1000&amp;fm=jpg&amp;q=80" srcset="https://cdn.schema.io/perros/621358b40b8e4601324c5a1e/038795bc1659e755b0c9866ed2b47574?width=96&amp;fm=jpg&amp;q=80 96w,https://cdn.schema.io/perros/621358b40b8e4601324c5a1e/038795bc1659e755b0c9866ed2b47574?width=192&amp;fm=jpg&amp;q=80 192w" sizes="96px" alt="" loading="lazy" class="absolute inset-0 w-full h-full object-cover" style="object-fit: cover;" width="1600" height="1600"></div>
    	                    </a>
    	                    <div class="ml-6 flex w-full flex-col justify-between">
    	                        <div>
    	                            <a href="/products/test-collare/" class="inline-block">
    	                                <h4>Pettorina antifuga e antitorsione Bushka -- no</h4>
    	                            </a>
    	                            <div class="mt-1 text-sm"><span>size:&nbsp;</span> <span>m</span></div>
    	                            <!---->
    	                        </div>
    	                        <div class="clearfix label-sm-bold mt-3 leading-none">
    	                            <div class="-mb-1 inline-block py-1"><span>4 × </span> <span>22,50&nbsp;€</span>
    	                                <!---->
    	                            </div> <button type="button" class="float-right -mb-1 -mr-1 p-1">
    	          Edit
    	        </button></div>
    	                    </div>
    	                </div>
    	                <div >
    	                    <div class="flex items-center pb-4 text-sm"><button type="button" class="mr-3 flex items-center pr-1"><div class="h-6 w-6 base mr-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="vertical-align: -0.125em;-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify icon:uil:trash-alt h-6 w-6 base" data-icon="uil:trash-alt"><path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z"></path></svg></div> <span class="-mb-px">Remove</span></button>
    	                        <div class="ml-auto flex">
    	                            <div class="mr-4 flex items-center"><button type="button" class="relative mr-1 inline-block h-6 w-6 rounded-full bg-primary-darkest"><div class="h-5 w-5 center-xy absolute text-primary-lightest"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="vertical-align: -0.125em;-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify icon:uil:minus h-5 w-5" data-icon="uil:minus"><path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"></path></svg></div></button> <input type="number" min="1" max="100" class="w-8 p-1 text-center text-xl md:w-10 md:p-2 md:text-2xl"> <button type="button" class="relative ml-1 inline-block h-6 w-6 rounded-full bg-primary-darkest"><div class="h-5 w-5 center-xy absolute text-primary-lightest"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="vertical-align: -0.125em;-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify icon:uil:plus h-5 w-5" data-icon="uil:plus"><path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"></path></svg></div></button></div>
    	                        </div>
    	                    </div>
    	                    <!---->
    	                </div>
    	            </div>
    	        </div>
    	        <div class="border-t border-primary-med bg-primary-lighter" >
    	            
    	            <div  class="container border-b border-primary-med py-6">
    	                <div  class="mb-1 flex justify-between"><span >Subtotal</span> <span >90,00&nbsp;€</span></div>
    	                <div  class="mb-1 flex justify-between"><span >Shipping</span> <span >0,00&nbsp;€</span></div>
    	                <div  class="mb-1 flex justify-between"><span >Discounts</span> <span >–9,00&nbsp;€</span></div>
    	                <div  class="mb-1 flex justify-between" style="display: none;"><span >Taxes</span> <span >0,00&nbsp;€</span></div>
    	                <h3  class="mt-3 flex justify-between text-xl font-semibold"><span >Total</span> <span >81,00&nbsp;€</span></h3>
    	                <!----><a  title="" href="https://perros.swell.store/checkout/810ed762430cdf43e3f8e871a115eb21" target="_self" rel="noopener" class="mt-4 mb-1 block"><button type="button" aria-label="" class="relative w-full btn btn--lg"><div class="center-xy absolute"><div class="spinner" style="display: none;"></div></div> <span class="center-xy absolute"><!----> 
    	        Checkout
    	      </span></button></a></div>
    	        </div>
    	    </div>
    	</div>
    	<!-- copy end -->
    </div>
  </body>
</html>
