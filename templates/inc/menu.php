
<div hidden id="snipcart" data-api-key="ZGMzZTk0YmItMmU2OC00OGRjLTg3OTItYWY5ODBhZjRkNDM4NjM3Nzc0MDE2OTE4MzA0NzA2"></div>

<div class="container mx-auto">
	<div class="relative bg-white con">
		<div class="flex justify-between  px-4 py-6 sm:px-6 md:justify-start md:space-x-10">
			<div id="logo" class="w-1/6">
				<a href="#" class="flex">
					<span class="sr-only">Perros Life - Tecnica Cinofila al guinzaglio</span>
					<img class="h-8 w-auto sm:h-10" src="<?php echo $config->urls->templates ?>styles/images/logo.png" alt="Perros Life - Tecnica Cinofila al guinzaglio">
				</a>
			</div>
			<div id="menus" class="w-5/6">
				<div class="grid justify-items-end">

					<div class="snipcart-summary" >
							<a href="#" class="snipcart-checkout" aria-label="Shopping cart">
									<span class="snipcart-total-items" aria-label="Items in cart"></span>
									<span class="snipcart-total-price" aria-label="Total"></span>
							</a>
							<button class="snipcart-user-profile" type="button">
									<span class="snipcart-user-email">My Account</span>
							</button>
							<div class="snipcart-user-logout">
									<button class="snipcart-edit-profile" type="button">Edit Profile</button>
							</div>
					</div>

					<nav class="flex space-x-10">


						<?php if($page->editable()){
							echo "<a class='' href='$page->editURL'>Modifica Pagina</a>";
						} 
						foreach ($homepage->children as $menu) {
							echo "<a href='$menu->url' class=''>$menu->title</a>";
						}?>

						<div class="relative">
							<!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
							<button type="button" class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">
								<span>More</span>
								<!--
									Heroicon name: solid/chevron-down

									Item active: "text-gray-600", Item inactive: "text-gray-400"
								-->
								<svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
								</svg>
							</button>

							<!--
								'More' flyout menu, show/hide based on flyout menu state.

								Entering: "transition ease-out duration-200"
									From: "opacity-0 translate-y-1"
									To: "opacity-100 translate-y-0"
								Leaving: "transition ease-in duration-150"
									From: "opacity-100 translate-y-0"
									To: "opacity-0 translate-y-1"
							-->
							<!-- fly out sub menu START # ho aggiunto hidden class-->
								<div class="hidden absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-xs sm:px-0">
									<div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
										<div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
											<a href="#" class="-m-3 p-3 block rounded-md hover:bg-gray-50">
												<p class="text-base font-medium text-gray-900">
													Help Center
												</p>
												<p class="mt-1 text-sm text-gray-500">
													Get all of your questions answered in our forums or contact support.
												</p>
											</a>

											<a href="#" class="-m-3 p-3 block rounded-md hover:bg-gray-50">
												<p class="text-base font-medium text-gray-900">
													Guides
												</p>
												<p class="mt-1 text-sm text-gray-500">
													Learn how to maximize our platform to get the most out of it.
												</p>
											</a>

											<a href="#" class="-m-3 p-3 block rounded-md hover:bg-gray-50">
												<p class="text-base font-medium text-gray-900">
													Events
												</p>
												<p class="mt-1 text-sm text-gray-500">
													See what meet-ups and other events we might be planning near you.
												</p>
											</a>

											<a href="#" class="-m-3 p-3 block rounded-md hover:bg-gray-50">
												<p class="text-base font-medium text-gray-900">
													Security
												</p>
												<p class="mt-1 text-sm text-gray-500">
													Understand how we take your privacy seriously.
												</p>
											</a>
										</div>
									</div>
								</div>
							<!-- fly out sub menu END-->

						</div>
					</nav>
					
				</div>
			</div>

		</div>

		<!--
			Mobile menu, show/hide based on mobile menu state.

			Entering: "duration-200 ease-out"
				From: "opacity-0 scale-95"
				To: "opacity-100 scale-100"
			Leaving: "duration-100 ease-in"
				From: "opacity-100 scale-100"
				To: "opacity-0 scale-95"
		-->
		<!--
		####################### l'ho segato, e incollato in un altro file menu-mobile.php
		 -->


		 <!-- qui c'e' l'hamburge menu ################### 
		<div class="-mr-2 -my-2 md:hidden">
				<button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
					<span class="sr-only">Open menu</span>
					<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
			</div>





		 -->
	</div>
</div>

