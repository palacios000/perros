<?php 
// the test product page ("pettorina Easy Play") to get the vars from
$pettorina = $pages->findOne("template=sc-product, name=pettorina-easy-play");

// vars to send to SwellJs ('site/templates/scripts/swell-alpine.js')
$swellProductId = $pettorina->codice;
$tagliaOK = "EP20";
$coloreOK = "rosso";
$sceltaMinuteria = "acciaio";
?>

<?php include 'inc/head.php'; ?>

<body>
  <?php include 'inc/menu.php'; ?>


  <div id="content" class="relative" x-data="{ cartReady: true }">

    	<button @click="cartReady = !cartReady" onclick="addToSwellCart()"> add <?= $pettorina->title ?></button>

    	<!-- Alpine test script-->
        <div x-data="alpineStore()" >
          <template x-if="myCart">
              <template x-for="item in myCart.items">
                <span x-text="item.product.name"></span>
              </template>
          </template>
        </div>


      <?php include 'inc/cart.php' ?>

    </div>
  </body>
</html>
