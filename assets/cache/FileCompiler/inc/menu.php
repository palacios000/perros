
<div hidden id="snipcart" data-api-key="ZGMzZTk0YmItMmU2OC00OGRjLTg3OTItYWY5ODBhZjRkNDM4NjM3Nzc0MDE2OTE4MzA0NzA2" data-config-modal-style="side"></div>

<div id="navigation" class="w-full bg-white shadow-md">
	<div class="container mx-auto">
		<div class="relative bg-white">
			<div class="flex justify-between py-6 px-4 md:px-0 md:justify-start">
				<div id="logo" class="w-1/3">
					<a href="<?php echo $homepage->url ?>" class="flex">
						<span class="sr-only">Perros Life - Tecnica Cinofila al guinzaglio</span>
						<img class="w-60" src="<?php echo $config->urls->templates ?>styles/images/PERROSLIFE_logo-1.svg" alt="Perros Life - Tecnica Cinofila al guinzaglio">
					</a>
				</div>
				<div id="menus" class="w-2/3">
					<div class="grid justify-items-end content-between h-full">

						<!-- icone + carrello -->
						<div class="flex items-center lg:ml-6 snipcart-summary">


							<!-- lingua select --start -->
							<div class="mr-6">
							  <div
							  x-data="{
							          open: false,
							          toggle() {
							              if (this.open) {
							                  return this.close()
							              }
							   
							              this.open = true
							          },
							          close(focusAfter) {
							              this.open = false
							   
							              focusAfter && focusAfter.focus()
							          }
							      }"
							      x-on:keydown.escape.prevent.stop="close($refs.button)"
							      x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
							      x-id="['language-button']"

							  class="mt-1 relative">
							    <button 
					    		x-ref="button"
					            x-on:click="toggle()"
					            :aria-expanded="open"
					            :aria-controls="$id('language-button')"
					            :class= "open ? 'text-perros-brown' : ''"

					            type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-perros-green focus:border-perros-green text-xxs" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
							      <span class="block">
							        Italiano S
							      </span>
							      <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
							        <!-- Heroicon name: solid/selector -->
							        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							          <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
							        </svg>
							      </span>
							    </button>

							    <!-- Select popover, show/hide based on select state. -->
							    <ul 
					    		x-ref="panel"
					            x-show="open"
					            x-transition:enter="transition ease-out duration-200"
					            x-transition:enter-start="opacity-0 translate-y-1"
					            x-transition:enter-end="opacity-100 translate-y-0"
					            x-transition:leave="transition ease-in duration-300"
					            x-transition:leave-start="opacity-100 translate-y-0"
					            x-transition:leave-end="opacity-0 translate-y-1"
					            x-on:click.outside="close($refs.button)"
					            :id="$id('language-button')"
					            style="display: none;"

							    class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
							      <!--
							        Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

							        Highlighted: "text-white bg-indigo-600", Not Highlighted: "text-gray-900"
							      -->
							      <li class="text-gray-900 cursor-default select-none relative py-1 pl-3 pr-9 text-xs" id="listbox-option-0" role="option">
							        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
							        <a href="" class="font-normal block hover:text-perros-green">
							          Italiano
							        </a>
							      </li>

							      <li class="text-gray-900 cursor-default select-none relative py-1 pl-3 pr-9 text-xs" id="listbox-option-0" role="option">
							        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
							        <a href="" class="font-normal block hover:text-perros-green">
							          Spagnolo
							        </a>
							      </li>

							    </ul>
							  </div>
							</div>
							<!-- lingua select --end  -->

							<div class="flex space-x-6">
								<div class="flex">
									<a href="#" class="snipcart-customer-signin -m-2 p-2 text-gray-400 hover:text-gray-500"> <span class="sr-only">Account</span>
										<svg class="h-5 w-5" x-description="Heroicon name: outline/user" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 33" stroke="currentColor" aria-hidden="true">
											<path d="m23.17 22.83-3.63-1.33a5.4 5.4 0 0 1 -6.47 0l-3.64 1.33a6.5 6.5 0 0 0 -4.26 6.11v.66a.23.23 0 0 0 .23.23h21.81a.23.23 0 0 0 .23-.23v-.66a6.5 6.5 0 0 0 -4.27-6.11zm-13.47-12.4a7.08 7.08 0 0 0 3.37-2.83.09.09 0 0 1 .13 0 18.48 18.48 0 0 0 9.71 2.37m-3.34 11.53v-2.33a1.55 1.55 0 0 1 .5-1.17 9.75 9.75 0 0 0 2.88-7.21c0-4.83-3-6.86-6.62-6.86s-6.63 2.07-6.63 6.88a9.75 9.75 0 0 0 2.87 7.19 1.55 1.55 0 0 1 .49 1.15v2.35" fill="none" stroke="#8e7d6d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1.34"></path>
										</svg>
									</a>
								</div>
							</div> 
							<span class="mx-4 h-6 w-px bg-gray-200 lg:mx-6" aria-hidden="true"></span>
							<div class="flow-root">
								<a href="#" class="snipcart-checkout group -m-2 p-2 flex items-center">
									<svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" x-description="Heroicon name: outline/shopping-cart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 33 33" stroke="currentColor" aria-hidden="true">
										<path d="M8.41,14.28H29.72m-18-6.06,2.15,12.12m3.09-12,.51,12.12M22.11,8.32,21.06,20.44M26.91,8.32,24.58,20.44m3.78,8.26a2.16,2.16,0,1,1-2.16-2.16A2.16,2.16,0,0,1,28.36,28.7ZM15,28.7a2.16,2.16,0,1,1-2.16-2.16A2.16,2.16,0,0,1,15,28.7Zm-4.73-8.26H27.15a.84.84,0,0,0,.79-.56L31.77,9.19a.63.63,0,0,0-.58-.84L6.78,8.12m21.65,16.3H12.09A1.13,1.13,0,0,1,11,23.6L6,5.7a1.11,1.11,0,0,0-.86-.8l-4.1-.8"></path>
									</svg> 
									<span class="snipcart-items-count ml-2 text-sm font-medium text-perros-green group-hover:text-gray-800"></span> 
									<span class="sr-only">Carrello</span> </a>
							</div>
						</div>




						<nav class="flex space-x-9 ">


							<?php if($page->editable()){
								echo "<a class='font-oswald' href='$page->editURL'>Modifica Pagina</a>";
							} 
							foreach ($homepage->children("template=sc-shop") as $menu) {
								echo "<a class='font-oswald uppercase text-xxl' href='$menu->url'>$menu->title</a>";
							}
							//la pagina Perros la chiamo a parte
							$perrosMenu = $homepage->children->first();
							?>

							<!-- flyout menu -->
							<div
							x-data="{
							        open: false,
							        toggle() {
							            if (this.open) {
							                return this.close()
							            }
							 
							            this.open = true
							        },
							        close(focusAfter) {
							            this.open = false
							 
							            focusAfter && focusAfter.focus()
							        }
							    }"
							    x-on:keydown.escape.prevent.stop="close($refs.button)"
							    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
							    x-id="['dropdown-button']"

							 class="relative flex justify-center">
								<!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
								<button
								x-ref="button"
						        x-on:click="toggle()"
						        :aria-expanded="open"
						        :aria-controls="$id('dropdown-button')"
						        :class= "open ? 'text-perros-brown' : ''"
								type="button" class="font-oswald text-xxl uppercase group bg-white rounded-md inline-flex items-center text-base hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-perros-green-300" aria-expanded="false">
									<span><?php echo $perrosMenu->title ?></span>
									<svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
									</svg>
								</button>

								<!-- fly out sub menu START -->
									<div
									x-ref="panel"
							        x-show="open"
							        x-transition:enter="transition ease-out duration-200"
							        x-transition:enter-start="opacity-0 translate-y-1"
							        x-transition:enter-end="opacity-100 translate-y-0"
							        x-transition:leave="transition ease-in duration-300"
							        x-transition:leave-start="opacity-100 translate-y-0"
							        x-transition:leave-end="opacity-0 translate-y-1"
							        x-on:click.outside="close($refs.button)"
							        :id="$id('dropdown-button')"
							        style="display: none;"

							         class="absolute z-50 left-1/2 top-11 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-xs sm:px-0">
										<div class="shadow-lg overflow-hidden text-center">
											<div class="relative grid gap-6 bg-gray-200 px-5 py-6 sm:gap-8 sm:p-8">
												<?php 
												$nMenu = 1;
												foreach ($perrosMenu->children as $subMenu) {
												echo '
												<a href="'.$subMenu->url.'" class="-m-3 p-1 block hover:bg-gray-50">
													<p class="text-base font-oswald uppercase text-gray-900">'.$subMenu->title.'</p>
													<p class="mt-1 text-sm text-gray-700">'.$subMenu->subtitle.'
													</p>
												</a>';
												if($nMenu < count($perrosMenu->children)) echo '<hr class="dottedLineSmall my-0">';
												$nMenu++;
												} ?>
												
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
</div>

