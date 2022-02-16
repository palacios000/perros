<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>

<div id="content">
	<?php

	// Get values
		$tagliaOK = ($input->get->taglia) ? $sanitizer->name($input->get->taglia) : '';
		$coloreOK = ($input->get->colore) ? $sanitizer->name($input->get->colore) : '';
		$minuteriaOK = ($input->get->minuteria) ? $sanitizer->name($input->get->minuteria) : '';
		// mi serve? $checkoutOK = ($input->get->minuteria);

		// taglia selezionata
		if ($tagliaOK) {
			$itemOK = $page->snipcart_item_variations->findOne("product_variations.code=$tagliaOK");
		}

	// Immagine
		if (!$coloreOK) {
			if (count($page->snipcart_item_image)) {
				$image = $page->snipcart_item_image->getrandom()->width(640);
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
			//prezzo giusto
			$prezzo = $itemOK->product_variations->price;
			if ($minuteriaOK) {
				if ($minuteriaOK != "tradizionale") {
					$prezzo = $prezzo + $page->product_options->price_extra;
				}
			}
			$totale = $prezzo;
			$prezzo = '&euro;'. (number_format($prezzo, 2, ',', ''));
		}else{
			//prezzo range
			$minmaxPrice = array();
			foreach ($page->snipcart_item_variations as $findPrice) {
				$minmaxPrice[] = $findPrice->product_variations->price;
			}
			$priceMin = min($minmaxPrice);
			$priceMax = max($minmaxPrice);
			$prezzo = '&euro;'. number_format($priceMin, 2, ',', ''). ' - &euro;'. number_format($priceMax, 2, ',', '');
		}
		?>

	<!-- ### PRODUCT DETAILS inizio  -->
		<main class="max-w-7xl mx-auto sm:pt-16 sm:px-6 lg:px-8 z-10" x-data="{imageUrl: '<?php echo $image->url ?>'}">
			<div class="max-w-2xl mx-auto lg:max-w-none">
				<!-- Product -->
				<div class="lg:grid lg:grid-cols-3 lg:gap-x-8 lg:items-start">
					<!-- Image gallery -->
						<div class="flex flex-col-reverse">
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
							<!-- Image selector -->
							<div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
								<div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">

									<!-- Immagini info | galleria  BUTTONs	-->
									<?php if (count($page->images)){
										foreach ($page->images->find("limit=4") as $infoImg) { ?>
											<button id="tabs-2-tab-1" class="relative h-24 bg-white flex items-center justify-center text-sm font-medium text-gray-900 cursor-pointer" aria-controls="tabs-2-panel-1" role="tab" type="button">
												<span class="absolute inset-0 overflow-hidden">
													<a @click="imageUrl = '<?php echo $infoImg->url ?>'" >
														
													<img src="<?php echo $infoImg->size(120,120)->url ?>" alt="<?php echo $imageDesc ?>" class=" object-center object-cover  brightness-95">
													</a>
												</span>
												<span class="ring-transparent absolute ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
											</button>
									<?php 										
										}
									} ?>

								</div>
							</div>

							<div class="w-full aspect-w-1 aspect-h-1">
								<div id="tabs-2-panel-1" aria-labelledby="tabs-2-tab-1" role="tabpanel" tabindex="0">
									<img :src="imageUrl"  alt="<?php echo $imageDesc ?>" class="w-full h-full object-center object-cover brightness-95">
								</div>
							</div>
						</div>



					<!-- Product info -->
					<div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0 col-span-2">
						<h1 class="text-3xl font-bold tracking-tight font-oswald leading-tight">
							<?php echo $page->title; if ($tagliaOK) echo " - " . $tagliaOK ?>
						</h1>

						
						<!-- Descrizione -->
							<div class="mt-6">
								<h3 class="sr-only">Descrizione</h3>
								<div class="text-base text-perros-green space-y-6"><?php echo $page->snipcart_item_description ?></div>
							</div>

						<!-- Colors -->
							<?php if (!$tagliaOK){ ?>
							<div class="mt-3">
								<h3 class="text-sm text-gray-600">Colori disponibili</h3>

								<fieldset id="colordots" class="mt-2">
									<div class="flex items-center space-x-3">
										<?php foreach ($colorspage->children as $colordot) { 
											$swapImage =  $page->filesUrl() . substr($colordot->name, 0, 4). substr($image->name, 4);
											?>
											<label class="-m-0.5 relative rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
												<input 
												@click="imageUrl = '<?php echo $swapImage ?>'"
												type="radio" name="color-choice" value="" class="sr-only">
												<p id="" class="sr-only"><?php echo $colordot->title ?></p>
												<span aria-hidden="true" class="h-6 w-6 bg-<?php echo $colordot->codice ?> border border-black border-opacity-10 rounded-full"></span>
											</label>
										<?php } ?>
									</div>
								</fieldset>
							</div>
							<?php } ?>

						<!-- inizio finestra CheckOut -->
						<div class="bg-ossi-pattern p-5 mt-8 mb-12">
							<div class="bg-white p-7">
								<div class="flex justify-between">
									<div>
									<h3 class="text-3xl font-bold tracking-tight font-oswald leading-none text-perros-green pb-7">Scegli il tuo prodotto su misura <br><!-- <span class="text-lg text-black font-normal">in tre semplici passaggi</span> --></h3>
									</div>
									<div>
										<p class="text-2xl text-gray-900 font-oswald"><?= $prezzo ?></p>
									</div>
									
								</div>

								<?php if (!$tagliaOK) { ?>
								<!-- ### 01 selezione Taglia -->
								<div class="treFasi">
									<div class="fase1 border border-perros-green-700 rounded rounded-2xl border-2 relative pl-16 pr-4">
										<!-- cerchiolino 1 -->
											<div class="absolute top-2 left-2">
											<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600"><span>1</span></span>
											</div>

										<div x-data="{ open: false }">

										<!-- blocco 3 steps - 1/3 -->
											<div class="my-3">
												<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Scegli la taglia</h4>
												<button x-on:click="open = true" type="button" class="bottone-green w-1/2">
													<span class="ml-2">Scegli la taglia</span>
													<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center ">
														<img src="<?= $config->urls->templates ?>styles/images/popup.svg" alt="pop-up icon">
													</span>
												</button>
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
												class="fixed inset-0 overflow-y-auto z-50"
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

													<div :id="$id('modal-title')" class="bg-white p-4 border-4 border-white rounded-2xl">

														<div class="grid grid-cols-3 gap-5">
															<?php if ($page->body_extra) { ?>
															<div>
																<?php if (count($page->images_details)){
																	echo "
																	<img src='{$page->images_details->first->url}' alt='Come misurare il cane'>
																	<p class='text-xs text-gray-500 mt-4 mx-10 text-center'>{$page->images_details->first->description}</p>";
																} ?>
																
																<div id="istruzioniTaglia" class="py-6">
																	<?php echo $page->body_extra ?>
																</div>
															</div>
															<?php } ?>

															<!-- Table -->
																<div class="col-span-2">
																	<h3 class="mt-8 mb-16 text-3xl font-bold tracking-tight font-oswald">Seleziona la taglia</h3>
																	<form action="" method="get" >

																		<!-- column title -->
																		<div class="px-6 my-1 flex justify-between focus:outline-none">
																			<div class="w-1/6"><!--empty--></div>
																			<?php 
																			if ($page->product_options->titolo1) echo tableTitle($page->product_options->titolo1, 'text-perros-brown-500');
																			if ($page->product_options->titolo2) echo tableTitle($page->product_options->titolo2, 'text-terra');
																			if ($page->product_options->titolo3) echo tableTitle($page->product_options->titolo3, 'text-acqua');
																			if ($page->product_options->titolo4) echo tableTitle($page->product_options->titolo4, 'text-neutral-600');
																			?>
																			<div class="w-1/6 ml-2"><!--empty--></div>
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
																				class="relative block bg-white border px-6 my-1 cursor-pointer flex justify-between font-oswald focus:outline-none hover:boder-1 hover:border-perros-green hover:opacity-95"
																				id="taglia-<?php echo $nItem ?>">
																					<input
																					@click="expanded = !expanded"
																					id="taglia-<?php echo $nItem ?>" type="radio" name="taglia" value="<?php echo $itm->product_variations->code ?>" class="text-perros-green absolute top-2 left-2 mr-3" required>
																					<!-- codice -->
																					<div class="w-1/6 flex items-center">
																						<div>
																							<p class="text-lg text-gray-900 uppercase ml-4"><?php echo $itm->product_variations->code ?></p>
																							<p class="text-sm text-gray-500 ml-4"><?php echo $itm->product_variations->nastro ?></p>
																						</div>
																					</div>

																					<?php 
																					if ($page->product_options->titolo1) echo tableCell($itm->product_variations->torace, 'text-perros-brown-500', 'cm'); 
																					if ($page->product_options->titolo2) echo tableCell($itm->product_variations->addome, 'text-terra', 'cm'); 
																					if ($page->product_options->titolo3) echo tableCell($itm->product_variations->gabbia, 'text-acqua', 'cm'); 
																					if ($page->product_options->titolo4) echo tableCell($itm->product_variations->peso, 'text-neutral-600', 'kg'); 
																					?>

																					<!-- prezzo -->
																					<div class="w-1/6 flex text-sm sm:mt-0 sm:block sm:ml-2 text-right">
																						<div class="text-xl text-gray-900 mt-2">&euro; <?php echo (number_format($itm->product_variations->price, 2, ',', '')) ?></div>
																					</div>
					
																					<div 
																					:class="expanded ? 'border-perros-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-perros-green-500' : 'border-transparent' "
																					class="absolute -inset-px border-2 ring-offset-2 pointer-events-none " aria-hidden="true"></div>
																				</label>

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
										</div>
										
									</div>

									<div class="fase2 border border-neutral-400 border-dotted rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
										<!-- cerchiolino 2 -->
											<div class="absolute top-2 left-2">
											<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600"><span>2</span></span>
											</div>

											<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Colore & Minuteria</h4>
									</div>

									<div class="fase3 border border-neutral-400 border-dotted rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
										<!-- cerchiolino 3 -->
											<div class="absolute top-2 left-2">
											<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600"><span>3</span></span>
											</div>

											<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Riepilogo</h4>
									</div>







								<!-- ### 02 Riepilogo e ##################################### -->
								<!-- ### 03 selezione Opzioni ##################################### -->
								<?php }else{ ?>
									<!-- TW Riepilogo TAGLIA (ovvero mostro taglia selezionata) -->
									<div class="fase1 border border-perros-green-700 rounded rounded-2xl border-2 relative pl-16 pr-4">
											<!-- cerchiolino 11 -->
												<div class="absolute top-2 left-2">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600">
													<!-- checked -->
													<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-perros-green rounded-full">
														<svg class="w-6 h-6 text-white " x-description="Heroicon name: solid/check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
													</svg>
													</span>
												</span>
												</div>
										
										<div class="">

											<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Taglia OK</h4>
										 
											<div class=" border px-6 mb-4 cursor-pointer flex justify-between font-oswald focus:outline-none"
											>
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
												if ($page->product_options->titolo1) echo tableCell($itemOK->product_variations->torace, 'text-perros-brown-500', 'cm', $page->product_options->titolo1); 
												if ($page->product_options->titolo2) echo tableCell($itemOK->product_variations->addome, 'text-terra', 'cm', $page->product_options->titolo2); 
												if ($page->product_options->titolo3) echo tableCell($itemOK->product_variations->gabbia, 'text-acqua', 'cm', $page->product_options->titolo3); 
												if ($page->product_options->titolo4) echo tableCell($itemOK->product_variations->peso, 'text-neutral-600', 'kg', $page->product_options->titolo4); 
												?>

											</div>

										</div>

									</div>
									<!-- TW Riepilogo TAGLIA END -->


									<!-- opzioni colore & minuteria -->
									<?php if ($page->product_options->colours && !$coloreOK) { ?>
									<div class="fase2 border border-perros-green-700 rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
										<!-- cerchiolino 22 -->
											<div class="absolute top-2 left-2">
											<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600"><span>2</span></span>
											</div>

											<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Scelta Colore</h4>
										
										<form action="" method="get">

											<input type="hidden" name="taglia" value="<?php echo $tagliaOK ?>">
											<input type="hidden" name="checkout" value="go">

											<!-- Colors -->
												<div>
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
															}"
															x-id="['selezioneColori']">
																<label 
																:class="expanded ? 'ring-2' : '' "
																:id="$id('selezioneColori')"
																class="-m-0.5 relative rounded-full ring-offset-2 flex items-center justify-center cursor-pointer focus:outline-none ring-<?php echo $colordot->codice ?>">
																	<input
																	@click="expanded = !expanded; imageUrl = '<?php echo $swapImage ?>'"

																	id="colore-<?php echo $nColors ?>"
																	 type="radio" name="colore" value="<?php echo $colordot->name ?>" class="sr-only"  aria-labelledby="<?php echo $colordot->name ?>" required>
																	<p id="<?php echo $colordot->name ?>" class="sr-only"><?php echo $colordot->title ?></p>
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
											<hr class="dottedLineSmall mt-8 mr-12">
												<div>
													<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Scelta Minuteria</h4>

													<?php 
													$nItem = $nColors + 1;
													$minuSelector = "sort=-name";
													if ($page->product_options->solo_bronzo) {
														$minuSelector .= ", name!=acciaio";
													}
													foreach ($pages->findOne("template=variabili, name=minuteria")->children($minuSelector) as $itm) { 
														//calcola prezzo minuteria
														$prezzoMinu = ($itm->name == "tradizionale") ? "incluso" : '+ &euro; ' . (number_format($page->product_options->price_extra, 2, ',', ''));
														?>

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
															class="relative block bg-white px-2 my-1 cursor-pointer flex justify-between font-oswald py-2 focus:outline-none hover:bg-gray-50"
															id="minuteria-<?php echo $nItem ?>">
																<input
																@click="expa = !expa"
																id="minuteria-<?php echo $nItem ?>"
																type="radio" name="minuteria" value="<?php echo $itm->name ?>" class="text-perros-green mt-4" required>
																
																<!-- testo -->
																<div class="pl-4 flex items-center">
																	<div class="pr-12">
																		<h3 class="text-xl mb-2"><?= $itm->title ?><span class="text-neutral-600 pl-4"> <?= $prezzoMinu ?></span></h3>
																		<p class="text-neutral-600"><?= $itm->infotext ?></p>
																	</div>
																</div>
																											
															</label>

														</div>
													</fieldset>
													<!-- TW buttons END -->

													<?php 
														$nItem++;
													} ?>
												</div>
											<?php } ?>

												<div class="my-8">
													<button type="submit" class="bottone-green py-2 w-2/5 ">
														Conferma colore e minuteria
													</button>
												</div>
										</form>



									</div>

									<div class="fase3 border border-neutral-400 border-dotted rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
									<!-- cerchiolino 33 -->
										<div class="absolute top-2 left-2">
										<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600"><span>3</span></span>
										</div>

										<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Riepilogo</h4>
									</div>

									<?php }else{ 
									/* Ho la taglia + scelta opzioni #################################
										fase 3/3 - SnipCart
									*/

										$checkoutTitolo = $page->title;
										if ($coloreOK) {
											$checkoutTitolo .= ' | Colore: ' . $coloreOK;
											$tagliaOK .= '_' . $colo; // colore a 4 cifre
										}
										if ($minuteriaOK) {
											$checkoutTitolo .= ' | Minuteria: ' . $minuteriaOK;
											if ($minuteriaOK != 'tradizionale') {
												$tagliaOK .= '-' . $minuteriaOK;
											}
										}


										//SnipCart button
										$snipJson = $config->urls->httpAssets . "files/" . $page->id . "/snipcart.json";
										$snipDescrizione = $sanitizer->truncate($sanitizer->markupToLine($page->subtitleH1), 130);
										$snipButton = "
											data-item-id='$tagliaOK'
											data-item-price='$totale'
											data-item-url='$snipJson'
											data-item-description='$snipDescrizione'
											data-item-image='$image->url'
											data-item-name='$checkoutTitolo'
											data-item-has-taxes-included='true'";
											?>


											<div class="fase2 border border-perros-green-700 rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
												<!-- cerchiolino 222 -->
													<div class="absolute top-2 left-2">
													<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600">
														<!-- checked -->
														<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-perros-green rounded-full">
															<svg class="w-6 h-6 text-white " x-description="Heroicon name: solid/check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
														</svg>
														</span>
													</span>
													</div>

													<h4 class="text-perros-green font-oswald font-bold text-xxl my-3 ">Scelta Colore</h4>


													<!-- Colors (selezionato) -->
													<?php $colordotSelected = $colorspage->children->findOne("name=$coloreOK") ?>
														<div>
															<fieldset id="colordots" class="my-2" >
																<div class="flex items-center space-x-3">
																	<div>
																		<label 
																		class="-m-0.5 relative rounded-full ring-offset-2 flex items-center justify-center cursor-pointer focus:outline-none ring-<?php echo $colordot->codice ?>">
																			<span aria-hidden="true" class="h-6 w-6 bg-<?php echo $colordotSelected->codice ?> border border-black border-opacity-10 rounded-full"></span>
																			<p id="<?php echo $colordot->name ?>" class="pl-2 uppercase"> <?php echo $coloreOK ?></p>
																		</label>
																	</div>
																	
																</div>
															</fieldset>
														</div>

													<?php if ($page->product_options->minuteria) { ?>
													<!-- Minuteria -->
													<hr class="dottedLineSmall my-6 mr-12">
														<div>
															<h4 class="text-perros-green font-oswald font-bold text-xxl mb-2 ">Scelta Minuteria</h4>

															<?php 
															$selectedMinu = $pages->findOne("template=variabili, name=minuteria")->children->findOne("name=$minuteriaOK"); 
																//calcola prezzo minuteria
																$prezzoMinuSel = ($minuteriaOK == "tradizionale") ? "incluso" : '+ &euro; ' . (number_format($page->product_options->price_extra, 2, ',', ''));
																?>

															<!-- TW radio buttons -->
															<fieldset >
																
																<div>
																	<div class="relative block bg-white px-2 my-1 flex justify-between font-oswald">
																		
																		<!-- testo -->
																		<div class="flex items-center">
																			<div class="pr-12">
																				<h3 class="text-xl mb-2"><?= $selectedMinu->title ?><span class="text-neutral-600 pl-4"> <?= $prezzoMinuSel ?></span></h3>
																			</div>
																		</div>
																													
																	</div>

																</div>
															</fieldset>
															<!-- TW buttons END -->

														</div>
													<?php } ?>



											</div>

											<div x-data="{ added2cart: false }" class="fase3 border border-perros-green-700 rounded rounded-2xl border-2 relative pl-16 pr-4 mt-4">
											<!-- cerchiolino 333 -->
												<!-- un-clicked -->
												<div class="absolute top-2 left-2">
													<span x-show="!added2cart" class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2  rounded-full font-oswald font-light text-neutral-600">
														<span>3</span>
													</span>
												<!-- clicked -->
													<span x-show="added2cart" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-perros-green rounded-full">
														<svg class="w-6 h-6 text-white " x-description="Heroicon name: solid/check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
													</svg>
													</span>
												</div>

												<!-- SNIPCART BUTTON ==================================================== -->
													<button
													@click="added2cart = !added2cart"
													 type="button" class="bottone-green ring-2 ring-offset-2 ring-offset-gray-50 ring-perros-green-500 snipcart-add-item w-1/2 my-8 mx-auto" <?= $snipButton ?> >
														<!-- icona carrella -->
														<svg class="flex-shrink-0 h-5 w-5 text-white group-hover:text-gray-500" x-description="Heroicon name: outline/shopping-cart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 33" stroke="currentColor" aria-hidden="true">
															<path d="M8.41,14.28H29.72m-18-6.06,2.15,12.12m3.09-12,.51,12.12M22.11,8.32,21.06,20.44M26.91,8.32,24.58,20.44m3.78,8.26a2.16,2.16,0,1,1-2.16-2.16A2.16,2.16,0,0,1,28.36,28.7ZM15,28.7a2.16,2.16,0,1,1-2.16-2.16A2.16,2.16,0,0,1,15,28.7Zm-4.73-8.26H27.15a.84.84,0,0,0,.79-.56L31.77,9.19a.63.63,0,0,0-.58-.84L6.78,8.12m21.65,16.3H12.09A1.13,1.13,0,0,1,11,23.6L6,5.7a1.11,1.11,0,0,0-.86-.8l-4.1-.8"></path>
														</svg>
														<span class="ml-2">Aggiungi al carrello -  <?php echo $prezzo ?></span>
													</button>
												</div>

									<?php 
									} 
								} 

								if ($tagliaOK){
								echo "<a class='underline pt-4 block text-sm text-perros-brown' href='$page->url'>Ri-seleziona taglia";
								echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>';
								echo "</a>";
								};

								?>



								

							</div>
						</div>
						<!-- fine finestra CheckOut -->



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

			<!-- recensioni -->
			<div class="container mx-auto">
			<hr class="dottedLineBig my-8">
				<div class="container mx-auto py-12">
					<h3 class="font-oswald font-bold text-4xl text-center">Recensioni</h3>
				</div>
			<hr class="dottedLineBig my-8">
			</div>
		</section>


		<!-- 2 images bottom -->
			<?php include 'inc/images_2bottom.php' ?>

</div>

<!-- questi mi servono a taildind per generare il codice colore nel css , altrimenti non si attivano tramite php  -->
<div class="hidden">
<span class="text-perros-brown-500 "></span>
<span class="text-neutral-600 "></span>
<span class="text-acqua "></span>
<span class="text-terra "></span>

<span class="bg-gray-200 "></span>
<span class="bg-orange-500 "></span>
<span class="bg-perros-brown-400 "></span>
<span class="bg-blue-500 "></span>
<span class="bg-yellow-800 "></span>
<span class="bg-stone-700 "></span>
<span class="bg-pink-200 "></span>
<span class="bg-red-500 "></span>
<span class="bg-lime-500 "></span>
<span class="bg-violet-500 "></span>

<span class="ring-orange-500 "></span>
<span class="ring-perros-brown-400 "></span>
<span class="ring-blue-500 "></span>
<span class="ring-yellow-800 "></span>
<span class="ring-stone-700 "></span>
<span class="ring-pink-200 "></span>
<span class="ring-red-500 "></span>
<span class="ring-lime-500 "></span>
<span class="ring-violet-500 "></span>
</div>

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
|====================|=======|===============================================================================|
| product_options    | combo | colours,minuteria, price_min, price_extra, titolo1, titolo2, titolo3, titolo4 |
| product_variations | combo | code,price,nastro,torace,addome,gabbia,peso                                   |
|                    |       |                                                                               |

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
