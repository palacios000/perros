<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<div id="content"> <!-- The content element holds your product detail view. -->
	<?php

	// Immagine
		if ($image = $page->snipcart_item_image->first()->width(640)) {
			$imageDesc = $image->description ? $image->description : $page->title;
		} else { $image = ""; $imageDesc = "";}

	// Range Prezzo


	// Get the formatted product price.
	// The getProductPriceFormatted method is provided by MarkupSnipWire module and can be called 
	// via custom API variable: $snipwire->getProductPriceFormatted()
	$priceFormatted = wire('snipwire')->getProductPriceFormatted(page());




	if (!$input->get->taglia) { 
		### PRODUCT DETAILS inizio ?>
		<main class="max-w-7xl mx-auto sm:pt-16 sm:px-6 lg:px-8">
			<div class="max-w-2xl mx-auto lg:max-w-none">
				<!-- Product -->
				<div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
					<!-- Image gallery -->
					<div class="flex flex-col-reverse">
						<!-- Image selector -->
						<div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
							<div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
								<!-- More images...  BUTTONs	-->
								<button id="tabs-2-tab-1" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer" aria-controls="tabs-2-panel-1" role="tab" type="button">
									<span class="absolute inset-0 rounded-md overflow-hidden">
										<img src="<?php echo $image->url ?>" alt="<?php echo $imageDesc ?>" class="w-full h-full object-center object-cover">
									</span>
									<!-- Selected: "ring-indigo-500", Not Selected: "ring-transparent" -->
									<span class="ring-transparent absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
								</button>
							</div>
						</div>

						<div class="w-full aspect-w-1 aspect-h-1">
							<div id="tabs-2-panel-1" aria-labelledby="tabs-2-tab-1" role="tabpanel" tabindex="0">
								<img src="<?php echo $image->url ?>" alt="<?php echo $imageDesc ?>" class="w-full h-full object-center object-cover sm:rounded-lg">
							</div>
						</div>
					</div>

					<!-- Product info -->
					<div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
						<h1 class="text-3xl font-extrabold tracking-tight"><?php echo $page->title ?></h1>

						<div class="mt-3">
							<h2 class="sr-only">Prezzo prodotto</h2>
							<p class="text-3xl text-gray-900">$140</p>
						</div>

						<!-- Reviews -->
							<div class="mt-3">
								<h3 class="sr-only">Reviews</h3>
								<div class="flex items-center">
									<div class="flex items-center">
										<!-- 
											Heroicon name: solid/star
											Active: "text-indigo-500", Inactive: "text-gray-300"
										-->
										<svg class="h-5 w-5 flex-shrink-0 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
										</svg>
									</div>
									<p class="sr-only">4 out of 5 stars</p>
								</div>
							</div>

						<div class="mt-6">
							<h3 class="sr-only">Description</h3>
							<div class="text-base text-gray-700 space-y-6"><?php echo $page->snipcart_item_description ?></div>
						</div>

						<form class="mt-6">
							<!-- Colors -->
							<div>
								<h3 class="text-sm text-gray-600">Colori disponibili</h3>

								<fieldset id="colordots" class="mt-2">
									<div class="flex items-center space-x-3">
										<!-- versione minimal -->
											<!-- 
												<p class="sr-only">Washed Black</p> 
											<span aria-hidden="true" class="h-8 w-8 bg-gray-700 border border-black border-opacity-10 rounded-full"></span>
											-->

										<!--
											Active and Checked: "ring ring-offset-1"
											Not Active and Checked: "ring-2"
										-->
										<?php foreach ($colorspage->children as $colordot) { ?>
											<label class="-m-0.5 relative rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
												<input type="radio" name="color-choice" value="White" class="sr-only" aria-labelledby="color-choice-1-label">
												<p id="color-choice-1-label" class="sr-only"><?php echo $colordot->title ?></p>
												<span aria-hidden="true" class="h-6 w-6 bg-<?php echo $colordot->codice ?> border border-black border-opacity-10 rounded-full"></span>
											</label>
										<?php } ?>

										
									</div>
								</fieldset>
							</div>

							<div x-data="{ open: false }">
								<div class="mt-10 flex sm:flex-col1">
									<button x-on:click="open = true" type="button" class="max-w-xs flex-1 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">Scegli la Taglia</button>

								</div>

								<!-- Modal TAGLIA #### (da capire dov'e' finito x-trap... -->
									<div
										x-cloak
										x-show="open"
										x-on:keydown.escape.prevent.stop="open = false"
										role="dialog"
										aria-modal="true"
										x-id="['modal-title']"
										:aria-labelledby="$id('modal-title')"
										class="fixed inset-0 overflow-y-auto"
									>
										<!-- Overlay -->
										<div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

										<!-- Panel -->
										<div
											x-show="open" x-transition
											x-on:click="open = false"
											class="relative min-h-screen flex items-center justify-center p-4"
										>
											<div
												x-on:click.stop
												x-trap.noscroll.inert="open"
												class="relative max-w-2xl w-full bg-white border border-black p-8 overflow-y-auto"
											>
												<!-- Title -->
												<h2 class="text-3xl font-medium" :id="$id('modal-title')">Taglie</h2>
												<!-- Content -->
												<p class="mt-2 text-gray-600">Foto + testo ecc.</p>
												<!-- Buttons -->
												<div class="mt-8 ">
													<form action="" method="get" x-data="{ active: 1 }">

														<?php 
														$nItem = 1;
														foreach ($page->snipcart_item_variations as $itm) { ?>
<!-- 															/*echo "
															  <input type='radio' id='$variation->id' name='server-size' value='{$variation->product_variations->code}'>
															  <label for='$variation->id'>{$variation->product_variations->code}</label><br>
															";*/
 -->															


														<!-- TW radio buttons -->
														<fieldset>
														  
														  <div class="space-y-4"
														    x-data="{ 
														    	id: <?php echo $nItem ?>,
														    	get expanded(){
														    		return this.checked === this.id
														    	},
														    	set expanded(value){
														    		this.checked = value ? this.id : null
														    	},
														    }"
														  >
														   
														    <label 
														    :class="expanded ? 'border-transparent' : 'border-gray-300' "
														    class="relative block bg-white border rounded-lg shadow-sm px-6 py-4 cursor-pointer sm:flex sm:justify-between focus:outline-none"
														    id="taglia-<?php echo $nItem ?>">
														      <input
														      @click="expanded = !expanded"
														       id="taglia-<?php echo $nItem ?>"
														       
														       type="radio" name="taglia" value="<?php echo $itm->product_variations->code ?>" class="sr-only">
														      <div class="flex items-center">
														        <div class="text-sm">
														          <p class="font-medium text-gray-900"><?php echo $itm->product_variations->code ?></p>
														          <div class="text-gray-500">
														            <p class="sm:inline">8GB / 4 CPUs</p>
														            <p class="sm:inline">160 GB SSD disk</p>
														          </div>
														        </div>
														      </div>
														      <div class="mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
														        <div class="font-medium text-gray-900">$40</div>
														        <div class="ml-1 text-gray-500 sm:ml-0">/mo</div>
														      </div>
	
														      <div 
														      :class="expanded ? 'border-indigo-500' : 'border-transparent' "
														      class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
														    </label>

														  </div>
														</fieldset>
														<!-- TW buttons END -->


														<?php 
 															$nItem++;
														} ?>







														<button type="submit" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
															Confirm
														</button>
														<button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
															Cancel
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
						</form>

					</div>
				</div>

			</div>
		</main>


	<?php
		### PRODUCT DETAILS fine
	}else{
		echo "";
	}
	?>



</div>

<!-- questi mi servono a taildind per generare il codice colore nel css , altrimenti non si attivano tramite php  -->
<!-- <span class="h-8 w-8 bg-orange-500 "></span>
<span class="h-8 w-8 bg-perros-brown-100 "></span>
<span class="h-8 w-8 bg-blue-500 "></span>
<span class="h-8 w-8 bg-yellow-800 "></span>
<span class="h-8 w-8 bg-gray-800 "></span>
<span class="h-8 w-8 bg-rose-400 "></span>
<span class="h-8 w-8 bg-red-500 "></span>
<span class="h-8 w-8 bg-green-600 "></span>
<span class="h-8 w-8 bg-purple-600 "></span>
 -->
</body>
</html>


<!-- 
table template & fields

VARIAZIONE PRODOTTI
|====================|=======|==================================================|
| product_options    | combo | colours,price_extra                              |
| product_variations | combo | code,price,nastro,circ_toracica,circ_addome,peso |

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