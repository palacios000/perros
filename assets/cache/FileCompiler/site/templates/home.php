<?php include(\ProcessWire\wire('files')->compile('inc/head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>
<body>

<?php include(\ProcessWire\wire('files')->compile('inc/menu.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)))?>

<!-- banner intro -->
  <div class="h-720 relative overflow-hidden">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php foreach ($page->slider as $slider1): ?>
        <div class="bg-ossi-pattern bg-repeat lg:overflow-hidden swiper-slide">
          <div class="mx-auto max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
              <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center">
                <div class="lg:py-24">
                  <a href="#" class="inline-flex items-center text-white bg-zinc-700 rounded-full p-1 pr-2 sm:text-base lg:text-sm xl:text-base hover:text-gray-200">
                    <span class="px-3 py-0.5 text-white text-xs font-semibold leading-5 uppercase tracking-wide bg-perros-green rounded-full">Spedizione Gratis</span>
                    <span class="ml-4 text-sm">Per gli ordine superiori a &euro; 45 </span>
                  </a>
                  <p class="mt-4 text-5xl tracking-tight font-bold text-black font-oswald sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl">
                    <?php echo $slider1->title ?>
                  </p>
                  <div class="mt-3 text-2xl font-light text-neutral-700 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl bg-white">
                    <?php echo $slider1->body ?>
                  </div>
                  <div class="mt-10 sm:mt-12">
                    
                    <button type="submit" class="block w-1/2 py-3 px-4 rounded-md shadow bg-perros-brown text-white font-medium hover:bg-perros-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:ring-offset-gray-900">Bottone</button>
                  </div>
                </div>
              </div>
              <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0 lg:relative">
                <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0">
                  <img class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none" src="<?php echo  $slider1->images->first->url ?>" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>

      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>

<!-- info boxes -->
  <section id="info">
    <?php 
    $tile = '';
    $colorCategory = 'text-red-700';
    $colorP = 'text-black';
    foreach ($page->homebox as $box) { 
      if ($box->codice == '') { // ho sfondo bianco e incolonna sulla sinistra
        $pari = false;
        $colOsso = '';
        $etichetta = '-left-8';
      }else{
        $pari = true;
        $colOsso = 'flex-row-reverse';
        $etichetta = '-right-8';
        if ($box->codice == 'bg-perros-green') {
          $colorCategory = 'text-white';
          $colorP = 'text-white';
        }
      }

    $tile .= '
    <div class="'. $box->codice .'">
      <div class="container mx-auto px-4 grid justyfy-between grid-cols-2 gap-y-16 pt-24 pb-36">';

        //<!-- testo -->
        $colonnaTesto = '
        <div class="homebox">
          <p class="uppercase '.$colorCategory.' font-oswald text-2ll mb-11 ">'. $box->titleH1 .'</p>
          <h2 class="font-oswald text-5xl font-bold leading-tight mb-12">'. $box->title .'</h2>
          <p class="font-oswald text-2xl leading-tight '.$colorP.'">'. $box->subtitleH1 .'</p>

          <!-- body -->
          <div class="mt-20  '.$colorP.'">
            '. $box->body .'
          </div>
        </div>';

        // <!-- immagine -->
        $colonnaImmagine = '
        <div>
          <div class="h-full flex '.$colOsso.'">
            <div class="h-full w-96 bg-white bg-ossi-pattern rounded-full mt-8 relative">
              <!-- 1st image circle-->
              <img class="w-96" src="'. $box->images->first->url .'" alt="'.$box->images->first->description.'" >
              <!-- etichetta -->
              <img class="absolute top-48 '.$etichetta.'" src="'. $config->urls->templates .'styles/images/linguetta-perros.png" alt="etichetta Perros Life">

              <!-- testo -->
              <div class="colonnina text-center mx-4">
                <h3 class="mt-16 mb-12 text-4xl font-oswald ">'. $box->homebox_aside->title .'</h3>
                <p class="">'. $box->homebox_aside->title_extra .'</p>
                '.  $box->homebox_aside->body .'
              </div>

              <!-- 2nd image circle-->';
              if (count($box->images) > 1) {
                $colonnaImmagine .= '<img class="w-96 absolute bottom-0" src="'. $box->images->last->url .'" alt="'.$box->images->last->description.'" >';  
               }
               $colonnaImmagine .= '
            </div>
          </div>
        </div>
        ';

        // ordina le 2 colonne in base IF
        $tile .= ($pari) ? $colonnaTesto.$colonnaImmagine : $colonnaImmagine.$colonnaTesto;

        $tile .='
      </div>
    </div>';
    } 
    echo $tile; 
    ?>
    <p class="hidden bg-neutral-200 text-black text-white text-red-700">TW directivese</p>
  </section>

<!-- images -->
  <section id="immagini" class="grid grid-cols-4 container mx-auto">
    <!-- 1 -->
    <?php 
    echo "
    <div>
      <img src='{$page->images->eq(0)->size(422,614)->url}' alt='{$page->images->eq(0)->description}'>
    </div>
    <!-- 2 -->
    <div>
      <img src='{$page->images->eq(1)->size(422,307)->url}' alt='{$page->images->eq(1)->description}'>
      <img src='{$page->images->eq(2)->size(422,307)->url}' alt='{$page->images->eq(2)->description}'>
    </div>
    <!-- 3 -->
    <div>
      <img src='{$page->images->eq(3)->size(422,614)->url}' alt='{$page->images->eq(3)->description}'>
    </div>
    <!-- 4 -->
    <div>
      <img src='{$page->images->eq(4)->size(422,307)->url}' alt='{$page->images->eq(4)->description}'>
      <div class='relative'>
        <img src='{$page->images->eq(5)->size(422,307)->url}' alt='{$page->images->eq(5)->description}'>
        <img class='absolute top-0 left-0' src='{$config->urls->templates}styles/images/linguetta-perros.png' alt='etichetta Perros Life'>
      </div>
    </div>    
    ";
     ?>
  </section>

<!-- pre footer -->

<!-- #2 quote -->
  <?php $quote = $pages->findOne("template=variabili, name=quotes")->children->getRandom();  ?>
  <div id="citazione">
    <div class="relative">
      <div class="relative py-24 px-8 bg-perros-100 overflow-hidden lg:px-16 lg:grid grid-cols-1 lg:gap-x-8">
        <div class="absolute inset-0 opacity-50">
          <img src="<?php echo $quote->images->first->url ?>" alt="" class="w-full h-full object-cover">
        </div>
        <div class="relative col-span-1">
          <blockquote class="mt-6 mx-60 text-black font-oswald text-4xl relative">
            <svg class="h-16 w-16 text-black absolute top-0 -left-24" fill="black" viewBox="0 0 32 32" aria-hidden="true">
              <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
            </svg>
            <p class=""><?php echo $quote->infotext ?></p>
            <footer class="mt-6">
              <p class="uppercase text-2xl text-white">
                <span><?php echo $quote->title ?></span>
              </p>
            </footer>
          </blockquote>
        </div>
      </div>
    </div>
  </div>

<?php include(\ProcessWire\wire('files')->compile('inc/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)))?>


<!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        loop: true,
        // autoplay: {
        //   delay: 5000,
        // },
      });
    </script>

</body>
</html>


<?php

/*
table template & fields

HOME
|============|==========|=====================|
| slider     | repeater | title, images, body |
| titleH1    | text     |                     |
| subtitleH1 | text     |                     |
| homebox    | repeater | vedi sotto          |



homebox, repeater
|===============|=======|==============================|
| title         | text  | titolo                       |
| titleH1       | text  | categoria                    |
| subtitleH1    | text  | sottotitolo                  |
| codice        | text  | colore sfondo                |
| images        |       | immagini rotonde per colonna |
| homebox_aside | combo | title, body, title_extra     |
|               |       |                              |


*/