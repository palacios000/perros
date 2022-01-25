<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<!-- intro banner -->
	<div class="bg-ossi-pattern">
	  <div class="container mx-auto py-6 px-4 lg:grid lg:grid-cols-2 lg:gap-x-8">
	    <div>
	      <h1 class="font-bold font-oswald text-6xl"><?php echo $page->titleH1 ?></h1>
		      <p class="mt-6 text-2ll text-perros-green font-oswald font-light bg-white"><?php echo $page->subtitleH1 ?></p>
	    </div>
	    <div>
	      <dl class="space-y-5 sm:space-y-0 sm:grid sm:grid-cols-1 sm:grid-rows-3 sm:grid-flow-col sm:gap-x-6 sm:gap-y-4 lg:gap-x-8">
	  			<?php foreach ($page->description_list as $list): ?>
	        <div class="relative bg-white">
	          <dt>
	            <!-- Heroicon name: outline/check -->
	            <svg class="absolute h-6 w-6 text-perros-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
	              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
	            </svg>
	            <p class="ml-9 text-lg leading-6 font-medium text-gray-900 font-oswald"><?php echo $list->title ?></p>
	          </dt>
	          <dd class="mt-2 ml-9 text-gray-500 ">
	          	<?php echo $list->infotext ?>
	          </dd>
	        </div>
	  			<?php endforeach ?>
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
	$item = $page->children->first
	?>
	<section id="products" class="container mx-auto">
	<div class="flex flex-row">
		<div class="w-4/5">
			<!-- prodotto start -->
			<div class="flex flex-row my-12">
				<div class="w-1/3">
					<!-- img + colori -->
					<a href="<?php echo $item->url ?>">
					<img src="<?php echo $item->snipcart_item_image->first->url ?>" alt="">
					<?php echo $dots ?>
					</a>
				</div>
				<div class="w-full mx-5">
					<h3 class="font-oswald font-bold text-4xl mb-6"><?php echo $item->title ?></h3>
					  <div>
					  	<!-- lista -->
					    <dl class="space-y-1 grid grid-cols-1 gap-x-6 ">
								<?php foreach ($item->description_list as $list): ?>
					      <div class="relative">
					        <dt>
					          <!-- Heroicon name: outline/check -->
					          <svg class="absolute h-6 w-6 text-perros-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
					            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
					          </svg>
					          <p class="ml-9 text-lg leading-6 font-medium text-perros-green font-oswald"><?php echo $list->title ?></p>
					        </dt>
					      </div>
								<?php endforeach ?>
					    </dl>
					    <!-- prezzo -->
					    <div class="w-full flex flex-row-reverse">
					    	<div class="w-28 flex flex-col text-center font-oswald">
					    		<div class="prezzo text-2ll text-perros-brown">da &euro; 24,90</div>
					    		<a href="" class="button block">Visualizza</a>
					    	</div>
					    </div>
					  </div>
				</div>
			</div>
			<!-- prodotto end -->
			<hr class="bigDottedLine">
		</div>

		<div class="w-1/5">
			<div class="bg-perros-brown p-5 my-12 text-white font-oswald">
				<h2>Prodotti</h2>
				<ul>
					<li>Pettorine</li>
					<li>Guinzagli</li>
				</ul>
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

 -->