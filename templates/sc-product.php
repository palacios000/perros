<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<div id="content"> <!-- The content element holds your product detail view. -->
	<?php

	// Get values
	$tagliaOK = ($input->get->taglia) ? $sanitizer->name($input->get->taglia) : '';
	$coloreOK = ($input->get->colore) ? $sanitizer->name($input->get->colore) : '';
	$minuteriaOK = ($input->get->minuteria) ? $sanitizer->name($input->get->minuteria) : '';
	$checkoutOK = ($input->get->minuteria);

	// taglia selezionata
	if ($tagliaOK) {
		$itemOK = $page->snipcart_item_variations->findOne("product_variations.code=$tagliaOK");
	}

	// Immagine
		if (!$coloreOK) {
			if ($image = $page->snipcart_item_image->getrandom()->width(640)) {
				$imageDesc = $image->description ? $image->description : $page->title;
				if (count($page->snipcart_item_image)) {
					//devo ritagliare le immagini via API altrimenti il JS prende quelle grandi
					//qui dovrei controllare se l'immagine ha la variazione corretta, come ho fatto per siamoalpi
					foreach($page->snipcart_item_image as $colorImage){
						$colorImage->width(640); // same as above 4 lines up
					}
				}
			} else { 
				$image = ""; $imageDesc = "";
			}
		}else{
			$colo = substr($coloreOK, 0, 4); // ovvero la regola dei primi 4 caratteri del colore
			$image = $page->snipcart_item_image->findOne("name%^=$colo"); // %^= starts like
		}

	// Range Prezzo
		if ($tagliaOK) {
			$prezzo = $itemOK->product_variations->price;
			if ($minuteriaOK) {
				if ($minuteriaOK != "tradizionale") {
					$prezzo = $prezzo + $page->product_options->price_extra;
				}
			}
			$totale = $prezzo;
			$prezzo = '&euro;'. $prezzo;
		}else{
			$minmaxPrice = array();
			foreach ($page->snipcart_item_variations as $findPrice) {
				$minmaxPrice[] = $findPrice->product_variations->price;
			}
			$priceMin = min($minmaxPrice);
			$priceMax = max($minmaxPrice);
			$prezzo = '&euro;'.$priceMin. ' - &euro;'.$priceMax;
		}


	// funzioni 

		//tabella
		function tableTitle($titolo, $colore){
			$th = "
			<div class='w-1/5 text-center font-oswald uppercase font-bold $colore'>
				$titolo
			</div>";
			return $th;
		}

		function tableCell($titolo, $colore, $unita, $tableTitle = ''){
			$testo = ($tableTitle) ? "<p class='text-sm'>$tableTitle<p>" : "";
			// un po' di calcoli per min. max.
			if ( strstr($titolo, '/')) {
				$minmax = explode('/', $titolo);
				$testo .= $minmax[0] . " &#187; " . $minmax[1] . " $unita";
			}else{
				$testo .= $titolo . $unita;
			}

			$td = "
			<div class='w-1/5 flex items-center $colore'>
			  <div class='text-sm text-center font-medium text-gray-900 w-full'>
			    $testo
			  </div>
			</div>
			";
			return $td;
		}
		?>

		<!-- ### PRODUCT DETAILS inizio  -->
		<main class="max-w-7xl mx-auto sm:pt-16 sm:px-6 lg:px-8" x-data="{imageUrl: '<?php echo $image->url ?>'}">
			<div class="max-w-2xl mx-auto lg:max-w-none">
				<!-- Product -->
				<div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
					<!-- Image gallery -->
					<div class="flex flex-col-reverse">
						<!-- Image selector -->
						<div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
							<div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">

								<!-- Immagini info | galleria  BUTTONs	-->
								<?php if (count($page->images)){
									foreach ($page->images->find("limit=4") as $infoImg) { ?>
										<button id="tabs-2-tab-1" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer" aria-controls="tabs-2-panel-1" role="tab" type="button">
											<span class="absolute inset-0 rounded-md overflow-hidden">
												<img src="<?php echo $infoImg->url ?>" alt="<?php echo $imageDesc ?>" class="w-full h-full object-center object-cover">
											</span>
											<!-- Selected: "ring-indigo-500", Not Selected: "ring-transparent" -->
											<span class="ring-transparent absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
										</button>
								<?php 										
									}
								} ?>

							</div>
						</div>

						<div class="w-full aspect-w-1 aspect-h-1">
							<div id="tabs-2-panel-1" aria-labelledby="tabs-2-tab-1" role="tabpanel" tabindex="0">
								<img :src="imageUrl"  alt="<?php echo $imageDesc ?>" class="w-full h-full object-center object-cover sm:rounded-lg">
							</div>
						</div>
					</div>

					<!-- Product info -->
					<div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
						<h1 class="text-3xl font-bold tracking-tight font-oswald text-4ll leading-tight">
							<?php echo $page->title; if ($tagliaOK) echo " - " . $tagliaOK ?>
						</h1>

						<div class="mt-3">
							<h2 class="sr-only">Prezzo prodotto</h2>
							<p class="text-3xl text-gray-900"><?php echo $prezzo ?></p>
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
							<h3 class="sr-only">Descrizione</h3>
							<div class="text-base text-perros-green space-y-6"><?php echo $page->snipcart_item_description ?></div>
						</div>

						<?php if (!$tagliaOK) { ?>
						<!-- ### 01 selezione Taglia -->
						<div class="mt-6">
							<!-- Colors -->
							<div>
								<h3 class="text-sm text-gray-600">Colori disponibili</h3>

								<fieldset id="colordots" class="mt-2">
									<div class="flex items-center space-x-3">
										<?php foreach ($colorspage->children as $colordot) { 
											$swapImage =  $page->filesUrl() . substr($colordot->name, 0, 4). substr($image->name, 4);
											?>
											<label class="-m-0.5 relative rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
												<input 
												@click="imageUrl = '<?php echo $swapImage ?>'"
												type="radio" name="color-choice" value="White" class="sr-only" aria-labelledby="color-choice-1-label" required>
												<p id="color-choice-1-label" class="sr-only"><?php echo $colordot->title ?></p>
												<span aria-hidden="true" class="h-6 w-6 bg-<?php echo $colordot->codice ?> border border-black border-opacity-10 rounded-full"></span>
											</label>
										<?php } ?>
									</div>
								</fieldset>
							</div>

							<div x-data="{ open: false }">
							<!-- <div x-data="{ open: true }"> DEV -->
								<div class="mt-10 flex sm:flex-col1">
									<button x-on:click="open = true" type="button" class="max-w-xs flex-1 bottone-green">Scegli la Taglia</button>

								</div>

								<!-- Modal TAGLIA #### -->
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
												class="relative max-w-6xl w-full bg-perros-green border border-perros-green rounded-2xl p-4 overflow-y-auto"
											>
											<!-- bottoncino crocetta chiudi -->
											<a href="#" x-on:click="open = false">
											<img class="absolute top-1 right-1 h-10 w-10" src="<?php echo $config->urls->templates ?>styles/images/crocetta-verde.svg" alt="chiudi finestra">
											</a>

											<div id="modalTaglia" class="bg-white p-4 border-4 border-white rounded-2xl">

												<div class="grid grid-cols-2">
													<div>
														<img src="<?php echo $page->images_details->first->url ?>" alt="Come misurare il cane">
														<p class="text-xs text-gray-500 mt-4 mx-10 text-center"><?php echo $page->images_details->first->description  ?></p>
													</div>
													<div :id="$id('modal-title')" class="px-3">
														<?php echo $page->body_extra ?>
														<!-- Title 
														<h2 class="text-3xl font-bold font-oswald" >Taglie</h2>
														
														<p class="mt-2 text-gray-600">Foto + testo ecc.</p>
														-->
													</div>
												</div>

												<!-- Table -->
												<div class="mt-12 ">
													<form action="" method="get" x-data="{ active: 1 }">

														<!-- column title -->
														<div class="px-6 my-1 flex justify-between focus:outline-none">
															<div class="w-1/5"><!--empty--></div>
															<?php 
															if ($page->product_options->titolo1) echo tableTitle($page->product_options->titolo1, 'text-perros-green');
															if ($page->product_options->titolo2) echo tableTitle($page->product_options->titolo2, 'text-perros-brown');
															if ($page->product_options->titolo3) echo tableTitle($page->product_options->titolo3, 'text-gray-500');
															if ($page->product_options->titolo4) echo tableTitle($page->product_options->titolo4, 'text-red-300');
															?>
															<div class="w-1/5 text-right"><!--empty--></div>
														</div>

														<?php 
														$nItem = 1;
														foreach ($page->snipcart_item_variations as $itm) { ?>

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
														    :class="expanded ? '' : 'border-gray-300' "
														    class="relative block bg-white border shadow-sm px-6 my-1 cursor-pointer flex justify-between font-oswald focus:outline-none hover:boder-1 hover:border-perros-green hover:opacity-95"
														    id="taglia-<?php echo $nItem ?>">
														      <input
														      @click="expanded = !expanded"
														      id="taglia-<?php echo $nItem ?>"
														      type="radio" name="taglia" value="<?php echo $itm->product_variations->code ?>" class="sr-only" required>
														      <!-- codice -->
														      <div class="w-1/5 flex items-center">
														        <div>
														          <p class="text-lg text-gray-900 uppercase"><?php echo $itm->product_variations->code ?></p>
														          <div class="text-gray-500">
														            <p class="text-sm"><?php echo $itm->product_variations->nastro ?></p>
														          </div>
														        </div>
														      </div>

															  <!-- titolo 1 - circ toracica/collo
														      <div class="w-1/5 flex items-center bg-perros-green-100">
														        <div class="text-sm text-center font-medium text-gray-900 uppercase w-full">
														          valori
														        </div>
														      </div>
																	 -->

														      <?php 
														      if ($page->product_options->titolo1) echo tableCell($itm->product_variations->torace, 'bg-perros-green-100', 'cm'); 
														      if ($page->product_options->titolo2) echo tableCell($itm->product_variations->addome, 'bg-perros-brown-100', 'cm'); 
														      if ($page->product_options->titolo3) echo tableCell($itm->product_variations->gabbia, 'bg-gray-200', 'cm'); 
														      if ($page->product_options->titolo4) echo tableCell($itm->product_variations->peso, 'bg-red-100', 'kg'); 
														      ?>

																	<!-- prezzo -->
														      <div class="w-1/5 mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
														        <div class="text-xl text-gray-900">&euro; <?php echo $itm->product_variations->price ?></div>
														      </div>
	
														      <div 
														      :class="expanded ? 'border-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-perros-green-500' : 'border-transparent' "
														      class="absolute -inset-px border-2 ring-offset-2 pointer-events-none " aria-hidden="true"></div>
														    </label>
														    <!-- focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-perros-green-500 -->

														  </div>
														</fieldset>
														<!-- TW buttons END -->

														<?php 
 															$nItem++;
														} ?>


														<button type="submit" class="bottone-green max-w-xs mt-8">
															Seleziona & Conferma
														</button>
														
													</form>
												</div>
											</div>
											</div>


										</div>
									</div>
						</div>

















						<!-- ### 02 Riepilogo e ##################################### -->
						<!-- ### 03 selezione Opzioni ##################################### -->
						<?php }else{ ?>
							<!-- TW Riepilogo TAGLIA (ovvero mostro taglia selezionata) -->
							<fieldset>
							  
							  <div class="space-y-4">
							   
							    <label 
							    class="relative block bg-white border shadow-sm px-6 my-1  cursor-pointer flex justify-between font-oswald focus:outline-none"
							    >
							      <input
							      type="radio" name="taglia" value="" class="sr-only" required>
							      <!-- codice -->
							      <div class="w-1/5 flex items-center">
							        <div class="text-sm">
							          <p class="font-medium text-gray-900 uppercase"><?php echo $itemOK->product_variations->code ?></p>
							          <div class="text-gray-500">
							            <p class=""><?php echo $itemOK->product_variations->nastro ?></p>
							          </div>
							        </div>
							      </div>

							      <?php 
							      if ($page->product_options->titolo1) echo tableCell($itemOK->product_variations->torace, 'bg-perros-green-100', 'cm', $page->product_options->titolo1); 
							      if ($page->product_options->titolo2) echo tableCell($itemOK->product_variations->addome, 'bg-perros-brown-100', 'cm', $page->product_options->titolo2); 
							      if ($page->product_options->titolo3) echo tableCell($itemOK->product_variations->gabbia, 'bg-gray-200', 'cm', $page->product_options->titolo3); 
							      if ($page->product_options->titolo4) echo tableCell($itemOK->product_variations->peso, 'bg-red-100', 'kg', $page->product_options->titolo4); 
							      ?>

							      <div 
							      :class="expanded ? 'border-indigo-500' : 'border-transparent' "
							      class="absolute -inset-px border-2 pointer-events-none" aria-hidden="true"></div>
							    </label>

							  </div>
							</fieldset>
							<!-- TW Riepilogo TAGLIA END -->


							<!-- opzioni colore & minuteria -->
							<?php if ($page->product_options->colours && !$checkoutOK) { ?>

								<form action="" method="get">

									<input type="hidden" name="taglia" value="<?php echo $tagliaOK ?>">
									<input type="hidden" name="checkout" value="go">

									<!-- Colors -->
										<div>
											<h3 class="font-oswald font-bold text-3xl mt-10 mb-5">Scegli il colore</h3>
											<fieldset id="colordots" class="mt-2" >
												<div class="flex items-center space-x-3">
													<!--
														Active and Checked: "ring ring-offset-1"
														Not Active and Checked: "ring-2"
													-->
													<?php 
													$nColors = 1;
													foreach ($colorspage->children as $colordot) { 
														// $swapImage = $config->httpHost -- forse aggiungere
														$swapImage =  $page->filesUrl() . substr($colordot->name, 0, 4). substr($image->name, 4);
														?>
													<div
													x-data="{ 
														id: <?php echo $nColors ?>,
														get expanded(){
															return this.checked === this.id
														},
														set expanded(value){
															this.checked = value ? this.id : null
														},
													}">
														<label 
														:class="expanded ? 'ring-2' : '' "
														class="-m-0.5 relative rounded-full ring-offset-2 flex items-center justify-center cursor-pointer focus:outline-none ring-<?php echo $colordot->codice ?>">
															<input
															@click="expanded = !expanded; imageUrl = '<?php echo $swapImage ?>'"
															id="colore-<?php echo $nColors ?>"
															 type="radio" name="colore" value="<?php echo $colordot->name ?>" class="sr-only" required>
															<p id="color-choice-1-label" class="sr-only"><?php echo $colordot->title ?></p>
															<span aria-hidden="true" class="h-6 w-6 bg-<?php echo $colordot->codice ?> border border-black border-opacity-10 rounded-full"></span>
														</label>
													</div>
													<?php 
													$nColors++;
													} ?>
													
												</div>
											</fieldset>
										</div>

									<?php if ($page->product_options->minuteria) { ?>
									<!-- Minuteria -->
										<div>
											<h3 class="font-oswald font-bold text-3xl mt-10 mb-5">Scegli la minuteria</h3>

											<?php 
											$nItem = $nColors + 1;
											foreach ($pages->findOne("template=variabili, name=minuteria")->children("sort=-name") as $itm) { ?>

											<!-- TW radio buttons -->
											<fieldset >
											  
											  <div class="space-y-4"
											    x-data="{ 
											    	id: <?php echo $nItem ?>,
											    	get expa(){
											    		return this.checked === this.id
											    	},
											    	set expa(value){
											    		this.checked = value ? this.id : null
											    	},
											    }"
											  >
											   
											    <label 
											    :class="expa ? 'border-transparent' : 'border-gray-300' "
											    class="relative block bg-white border shadow-sm px-6 my-1 cursor-pointer flex justify-between font-oswald py-3 focus:outline-none hover:border-perros-green"
											    id="minuteria-<?php echo $nItem ?>">
											      <input
											      @click="expa = !expa"
											      id="minuteria-<?php echo $nItem ?>"
											      type="radio" name="minuteria" value="<?php echo $itm->name ?>" class="text-red-500" required>

														<!-- titolo  -->
											      <div class="w-1/6 flex items-center ">
											        <div class="text-sm text-center font-medium text-gray-900 uppercase w-full">
											        	<h3><?php echo $itm->title ?></h3>
											          <img src="<?php echo $itm->images->first->url ?>" alt="">
											        </div>
											      </div>
														
											      <!-- testo -->
											      <div class="w-2/3 flex items-center">
											        <div class="text-sm">
											          <p class=""><?php echo $itm->infotext ?></p>
											        </div>
											      </div>
											      
														<!-- prezzo -->
											      <div class="w-1/6 mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
											        <div class="text-3xl text-gray-900"><?php echo ($itm->name == "tradizionale") ? "incluso" : '+ &euro; ' . $page->product_options->price_extra ?></div>
											      </div>

											      <div 
											      :class="expa ? 'border-red-500' : 'border-transparent' "
											      class="absolute -inset-px border-2 pointer-events-none" aria-hidden="true"></div>
											    </label>

											  </div>
											</fieldset>
											<!-- TW buttons END -->

											<?php 
												$nItem++;
											} ?>
										</div>
									<?php } ?>

										<button type="submit" class="max-w-xs bottone-green my-8">
											Seleziona e riepilogo
										</button>

								</form>
							<?php }else{ 
							// Ho la taglia + scelta opzioni
								echo "<div class='pt-6 pb-8'>";

								echo "<h3 class='font-oswald font-bold text-2xl'>Colore: $coloreOK </h3>";
								echo "<h3 class='font-oswald font-bold text-2xl'>minuteria: $minuteriaOK </h3>";
								echo "</div>";

								$checkoutTitolo = $page->snipcart_item_description;
								if ($coloreOK) $checkoutTitolo .= ' | Colore: ' . $coloreOK;
								if ($minuteriaOK) $checkoutTitolo .= ' | Minuteria: ' . $minuteriaOK;


								//SnipCart button
								echo "
								<button class='snipcart-add-item max-w-xs bottone-green'
								  data-item-id='$tagliaOK'
								  data-item-price='$totale'
								  data-item-url='$page->url'
								  data-item-description='$page->snipcart_item_description'
								  data-item-image='$image->url'
								  data-item-name='$checkoutTitolo'
								  >
								  Aggiungi al carrello
								</button>";

								echo "<p class='mt-3 text-sm text-perros-brown'><a href='$page->url'>Cancella selezione</a></p>";


							} ?>


						<?php } ?>

					</div>
				</div>

			</div>
		</main>
		<!-- ### PRODUCT DETAILS fine -->














		<section id="info">
			<!-- list -->
			<div class="container mx-auto">
				<hr class="dottedLineBig my-8">
				<div class="flex flex-center">
					<div class="mx-auto py-6">
					    <dl class="space-y-2">
								<?php foreach ($page->description_list as $list): ?>
					      <div class="relative bg-white">
					        <dt>
					          <!-- Heroicon name: outline/check -->
					          <svg class="absolute h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
					            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
					          </svg>
					          <p class="ml-9 text-lg leading-6 font-medium text-gray-900 font-oswald"><?php echo $list->title ?></p>
					        </dt>
					        <dd class="mt-2 ml-9 text-gray-400 ">
					        	<?php echo $list->infotext ?>
					        </dd>
					      </div>
								<?php endforeach ?>
					    </dl>
					</div>
				</div>
				<hr class="dottedLineBig my-8">
			</div>

			<!-- body -->
			<main class="lg:relative">
			  <div class="mx-auto max-w-7xl w-full pt-16 pb-20 text-center lg:py-48 lg:text-left">
			    <div id="caratteristicheText" class="px-4 lg:w-1/2 sm:px-8 xl:pr-16">
			      <?php echo $page->body ?>
			    </div>
			  </div>
			  <div class="relative w-full h-64 sm:h-72 md:h-96 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:h-full">
			    <img class="absolute w-full h-full object-cover" src="<?php echo $page->images_bg->first->url ?>" alt="">
			  </div>
			</main>
		</section>

</div>

<!-- questi mi servono a taildind per generare il codice colore nel css , altrimenti non si attivano tramite php  -->
<!-- 
<span class="h-8 w-8 bg-gray-200 "></span>
<span class="h-8 w-8 bg-orange-500 "></span>
<span class="h-8 w-8 bg-perros-brown-400 "></span>
<span class="h-8 w-8 bg-blue-500 "></span>
<span class="h-8 w-8 bg-yellow-800 "></span>
<span class="h-8 w-8 bg-stone-700 "></span>
<span class="h-8 w-8 bg-pink-200 "></span>
<span class="h-8 w-8 bg-red-500 "></span>
<span class="h-8 w-8 bg-lime-500 "></span>
<span class="h-8 w-8 bg-violet-500 "></span>

<span class="h-8 w-8 ring-orange-500 "></span>
<span class="h-8 w-8 ring-perros-brown-400 "></span>
<span class="h-8 w-8 ring-blue-500 "></span>
<span class="h-8 w-8 ring-yellow-800 "></span>
<span class="h-8 w-8 ring-stone-700 "></span>
<span class="h-8 w-8 ring-pink-200 "></span>
<span class="h-8 w-8 ring-red-500 "></span>
<span class="h-8 w-8 ring-lime-500 "></span>
<span class="h-8 w-8 ring-violet-500 "></span>
 -->

<?php include 'inc/footer.php' ?>

</body>
</html>


<!-- 
table template & fields
|============|=======================|
| body_extra | info misurazione cane |
|            |                       |
		
IMMAGINI
|================|===============================|===================================|
| images         | immagini inerenti prodotto    |                                   |
| images_bg      | immagini sfondo & riempimento | 1a next to body, others on bottom |
| images_details | immagine misurazione cane     |                                   |
|                |                               |                                   |


VARIAZIONE PRODOTTI
|====================|=======|====================================================================|
| product_options    | combo | colours,minuteria,	price_extra, titolo1, titolo2, titolo3, titolo4 |
| product_variations | combo | code,price,nastro,torace,addome,gabbia,peso                        |
|                    |       |                                                                    |

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
