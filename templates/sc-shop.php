<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<!-- intro banner -->
	<div class="relative">
		<div class="absolute inset-0 z-0">
			<img class="h-full w-full object-cover" src="<?php echo $page->images_bg->first->url ?>" alt="">
		</div>
	  <div class="relative container mx-auto py-6 px-4 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:py-12 text-white">
	    <div>
	      <h1 class="font-bold font-oswald text-4xl md:text-5xl xl:text-6xl"><?= $page->titleH1 ?></h1>
		      <p class="mt-6 text-xl md:text-xxl xl:text-2ll  font-oswald font-light leading-tight"><?php echo $page->subtitleH1 ?></p>
	    </div>
	    <div>
	      <dl class="space-y-5 sm:space-y-0 sm:grid sm:grid-cols-1 sm:grid-rows-3 sm:grid-flow-col sm:gap-x-6 sm:gap-y-4 lg:gap-x-8 mt-8 lg:mt-0">
	  			<?php 
	  			$circle = 1;
	  			foreach ($page->description_list as $list){ ?>
	        <div class="relative hidden md:block">
	          <dt>
	            <!-- Heroicon name: outline/check -->
	            <span class="absolute top-1 flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 rounded-full">
					<span class="text-xl"><?php echo $circle ?></span>
				</span>
	            <!-- <p class="ml-9 text-lg leading-6 font-medium font-oswald"><?php echo $list->title ?></p> -->
	          </dt>
	          <dd class="ml-14 font-oswald font-light leading-tight text-base xl:text-lg">
	          	<?php echo $list->infotext ?>
	          </dd>
	        </div>
	  			<?php 
	  			$circle++;
	  		} ?>
	      </dl>
	    </div>

	  </div>
	</div>

<!-- prodotti -->
<?php 
	$dots = '
	<div class="mt-2 p-2">
		<div class="flex items-center space-x-2">';
			foreach ($colorspage->children as $colordot) {
				$dots .= '
				<span aria-hidden="true" class="h-5 w-5 bg-'.$colordot->codice.' border border-black border-opacity-10 rounded-full"></span>';
			}
			$dots .= '
		</div>
	</div>';
	?>

	<section id="products" class="container mx-auto pb-12">
		<div class="flex flex-row gap-x-4">
			<!-- colonna prodotti -->
			<div class="w-auto">
				<!-- prodotto start -->
				<?php foreach ($page->children as $item): ?>
				<div class="flex flex-row my-12 group rounded hover:shadow-lg">
					<div class="w-1/3">
						<!-- img + colori -->
						<a href="<?php echo $item->url ?>">
						<?php if (count($item->snipcart_item_image)) echo "<img class='brightness-95' src='{$item->snipcart_item_image->first->url}' alt='$item->title'>";
						echo $dots ?>
						</a>
					</div>
					<div class="w-full mx-5">
						<a class="" href="<?php echo $item->url ?>">
						<h3 class="font-oswald font-bold text-2xl md:text-3xl xl:text-4xl"><?php echo "$item->title" ?></h3>
						<p class="mt-2 mb-6 text-perros-green text-xl font-oswald leading-tight"><?php echo $item->subtitleH1 ?></p>
						  <div>
						  	<!-- lista -->
						    <dl class="space-y-1 grid grid-cols-1 gap-x-6 max-w-lg">
									<?php foreach ($item->description_list as $list): ?>
						      <div class="relative">
						        <dt>
						          <!-- Heroicon name: outline/check -->
						          <svg class="absolute h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
						            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
						          </svg>
						          <p class="ml-9 text-lg leading-5 font-medium font-oswald"><?php echo $list->title ?></p>
						        </dt>
						      </div>
									<?php endforeach ?>
						    </dl>
						    <!-- prezzo -->
						    <div class="w-full mt-12 mb-4">
						    	<div class="flex flex-row justify-between text-center font-oswald">
						    		<div class="prezzo text-2ll text-perros-brown">da &euro; <?= (number_format($item->product_options->price_min, 2, ',', '')) ?></div>
						    		<a href="<?php echo $item->url ?>" class="button block max-w-xs bottone-green uppercase">Visualizza</a>
						    	</div>
						    </div>
						  </div>
						</a>
					</div>
				</div>
				<hr class="dottedLineBig">
				<?php endforeach ?>
				<!-- prodotto end -->

			</div>


			<!-- colonna info sinistra -->
			<div class="w-58 flex-none">

				<!-- menu prodotti -->
				<div class="bg-perros-brown p-5 my-12 text-white font-oswald w-full text-center uppercase">
					<h2 class="text-3ll my-2">Prodotti</h2>
					<ul class="text-2xl font-light">
						<?php 
						$sibC = 1;
						foreach ($page->siblings("template=sc-shop, id!=$page->id") as $sibling) {
							$dottedLine = ($sibC != 1) ? 'dottedLineSmall' : '';
							echo "<li class='py-2 $dottedLine'><a class='hover:underline' href='$sibling->url'>$sibling->title</a></li>";
							$sibC++;
						} ?>
						
					</ul>
				</div>

				<!-- tutto (cane) -->
				<div>
				  <div class="flex ">
				    <div class="w-58 bg-perros-green bg-ossi-pattern mix-blend-multiply mt-36 relative">
				      <!-- 1st image circle-->
				      <img class="w-58 absolute -top-28" src="<?php echo $page->images_bg->last->url ?>" alt="" >
				      <!-- etichetta -->
				      <img class="absolute top-0 -right-8" src="<?php echo $config->urls->templates ?>styles/images/linguetta-perros.png" alt="etichetta Perros Life">

				      <!-- testo //   -->
				      <div class="colonnina mx-4 text-white pb-8">
				        <h3 class="mt-36 mb-6 text-4xl font-oswald "><?php echo $qualitapage->title ?></h3>
				        <ul>
				        	<?php foreach ($qualitapage->children->find("title%^=tutto") as $tutto){
				        		echo "<li><a class='uppercase font-oswald font-light text-xl hover:underline' href='$tutto->url'>&gt; $tutto->title</a></li>";	
				        	} ?>
				        </ul>
				      </div>

				    </div>
				  </div>
				</div>
			</div>
		</div>
	</section>


	<!-- images footer -->
<?php include 'inc/images_2bottom.php'  ?>

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

 -->