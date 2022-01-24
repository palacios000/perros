<?php include 'inc/head.php'; ?>
<body>

<?php include 'inc/menu.php' ?>

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