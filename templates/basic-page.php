<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<!-- intro banner -->
	<div class="h-81 relative">
		<div class="h-81 absolute inset-0 z-0">
			<img class="h-full w-full object-cover" src="<?php echo $page->images_bg->first->url ?>" alt="">
		</div>
	  <div class="h-81 relative container mx-auto py-6 px-4 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:py-12 text-white">
	    <div>
	      <h1 class="font-bold font-oswald text-6xl"><?php echo $page->titleH1 ?></h1>
	    </div>
	    <div>
	    </div>
	  </div>
	</div>

<!-- info boxes -->
  <section id="info">
    <?php 
    $tile = '';
    foreach ($page->homebox as $box) { 

    $tile .= '
    <div class="">
      <div class="container mx-auto px-4 grid justyfy-between grid-cols-2 gap-y-16 pt-24 pb-36">

        <!-- COLONNA testo -->
        <div class="homebox">
          
          <p class="font-oswald text-2xl leading-tight text-perros-green">'. $box->subtitleH1 .'</p>

          <!-- body -->
          <div class="mt-20 ">
            '. $box->body .'
          </div>
        </div>

        <!-- COLONNA immagine -->
        <div>
          <div class="flex flex-row-reverse">
            <div class=" w-96 bg-white bg-ossi-pattern rounded-full relative">
              <!-- 1st image circle-->
              <img class="w-96" src="'. $box->images->first->url .'" alt="'.$box->images->first->description.'" >
              

              <!-- testo -->
              <div class="colonnina text-center mx-4">
                <h3 class="mt-16 mb-12 text-4ll font-oswald text-perros-green leading-tight ">'. $box->homebox_aside->title .'</h3>
                <div class="text-2xl pb-24 font-oswald font-light">'.  $box->homebox_aside->body .'</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
    } 
    echo $tile; 
    ?>
    <p class="hidden bg-neutral-200 text-black text-white text-red-700">TW directivese</p>
  </section>

<!-- accordion esempi -->
	<section id="accordion" class="bg-gray-200">
		<div class="container mx-auto">
			<h2 class="text-3ll font-oswald font-bold pt-16 pb-8"><?php echo $page->description_list->first->title ?></h2>

			<!-- acordion -->
			<div x-data="{ active: 1 }" class="boder border-t border-gray-500 pb-24">

				<?php 
				$counter = 0;
				foreach ($page->description_list as $faq) { 
					$counter++;
					if($counter == 1) continue;
					?>
				
				<div x-data="{ 
						id: <?php echo $counter ?>,
						get expanded(){
							return this.active === this.id
						},
						set expanded(value){
							this.active = value ? this.id : null
						},
					}" role="region" class="py-1 boder border-b border-gray-500">
					<div class="container mx-auto ">
						<h3 class="">
							
						<button 
							@click="expanded = !expanded"
							class="flex items-center justify-between w-full text-perros-green" 
							:aria-expanded="expanded">
							
							<span class="text-xxl  font-oswald"><?php echo $faq->title ?></span>
							<span x-show="!expanded" aria-hidden="true" class="font-light text-4xl transform rotate-90">&gt;</span>
							<span x-show="expanded"  aria-hidden="true" class="font-light text-4xl transform rotate-90">&lt;</span>

						</button>
						</h3>
					</div>

					<div x-show="expanded" x-collapse>
						<div class="container prose pt-4 pb-8">
							<?php echo $faq->infotext ?>
						</div>
					</div>

				</div>

				<?php } ?>

			</div>

		</div>
	</section>

<!-- pallini spiegazione prodotti -->
	<section id="informazioni" class="container mx-auto">
		<div class="pt-32 pb-20 text-center">
			<h2 class="text-3ll font-oswald font-bold pb-8"><?php echo $page->slider->first->title ?></h2>
			<p class="font-oswald font-light text-perros-green text-2xl leading-tight"><?php echo $page->slider->first->subtitle ?></p>
		</div>
		<?php 
		$nTipo = 0;
		foreach ($page->slider as $tipo) {
			$nTipo++;
			if ($nTipo == 1) continue;
			$tipoUrl = $pages->get($tipo->codice)->url;
		?>
		<div class="flex flex-row">
			<div class="w-65">
				<?php echo "<img class='' src='{$tipo->images->first->url}' alt='$tipo->images->first->description'>"; ?>
			</div>
			<div class="w-auto ml-16">
				<?php 
				echo "
				<h3 class='font-oswald text-3ll pb-2'>$tipo->title</h3>
				<p class='font-oswald font-light text-perros-green text-2xl leading-tight pb-4'>$tipo->subtitle</p>
				$tipo->body
				<a class='bottone-green-neg w-28' href='$tipoUrl'>$tipo->titleH1</a>";
				?>
			</div>
		</div>
		<hr class="dottedLineBig my-12">
		<?php } ?>
	</section>

<!-- pre-footer con bottone -->
	<section id="prefooter" class="container mx-auto">
		<p class="font-oswald text-2xl leading-tight text-perros-brown text-center px-28 my-20"><?php echo $page->extra_titles->titolo ?></p>

		<div class="relative pb-12">
		  <div class="relative py-24 px-8 overflow-hidden lg:px-16 lg:grid grid-cols-1 lg:gap-x-8">
		    <div class="absolute inset-0 opacity-50">
		      <img src="<?php echo $page->images_bg->last->url ?>" alt="" class="w-full h-full object-cover">
		    </div>
		    <div class="relative col-span-1">
		    	<div class="flex flex-column justify-center align-middle">
		    		<?php 
		    		$bottonUrl = $pages->get($page->extra_titles->id_pagina)->url;
		    		echo "
		    		<a class='bottone-green rounded-none w-auto' href='$bottonUrl'>
			    		<div class='flex flex-col justify-center text-center text-2xl mx-9'>
			    			<div class='uppercase font-bold'>{$page->extra_titles->sottotitolo}</div>
			    			<div class='font-oswald font-light'>{$page->extra_titles->bottone}</div>
			    		</div>
		    		</a>";
		    		?>
		    	</div>
		    </div>
		  </div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>

</body>
</html>


<!-- 
table template & fields
		
IMMAGINI
|==================|==========|=================|
| description_list | repeater | title, infotext |
|                  |          |                 |

MINUTERIA
|==========|
| title    |
| images   |
| infotext |
|          |

VARIABILI - colori
|========|
| title  |
| codice |
|        |


HOME
|============|==========|====================================================================|
| slider     | repeater | title, subtitle, images, body, titleH1 (bottone), codice (id pagina bottone) |
| titleH1    | text     |                                                                    |
| subtitleH1 | text     |                                                                    |
| homebox    | repeater | vedi sotto                                                         |


 -->

<?php 

/**
	 * fields

# extra_titles - COMBO
titolo
sottotitolo
footer
bottone
id_pagina

	 */	
 ?>