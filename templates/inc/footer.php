<footer>
	<!-- icone -->
		<div class="py-12 bg-neutral-300">
		  <div class="max-w-xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
		    <dl class="space-y-10 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-9">

		    <?php foreach ($pages->findOne("template=variabili, name=icons")->children as $icons) { 
		    	
		    echo '
		      <div>
		        <dt class="">
		          <div class="flex flex-col items-center justify-center w-full ">
			            <img class="h-24 w-24" src="'.$icons->images->first->url.'" alt="">
		          </div>
		          <p class="mt-5 text-2xl leading-6 font-medium font-oswald font-bold uppercase text-center">'.$icons->title.'</p>
		        </dt>
		        <dd class="mt-2 mx-8 text-lg text-gray-500 text-center font-oswald">'.$icons->infotext.'

		        </dd>
		      </div>';

			  } ?>


		    </dl>
		  </div>
		</div>


	<!-- menu -->
	<div class="bg-perros-brown">
		<div class="container mx-4 lg:mx-auto py-16 text-white text-xm font-oswald">
			<img class="w-full md:w-1/6 pb-4 pr-8" src="<?php echo $config->urls->templates ?>styles/images/PERROSLIFE_logo-2.svg" alt="Logo Perros Life">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
				<div>
					<p class="font-sans">
						PERROSLIFE <br>
						Via Credaro18 <br>
						23017Morbegno(SO)
					</p>
					<p class="mt-6">
						+39 345 139 43 80 <br>
						info@perroslife.com
					</p>
				</div>

				<div class="border-t border-white lg:border-0 pt-4 lg:pt-0">
					<ul class="uppercase">
						<?php foreach ($qualitapage->children("title~=perros|chi") as $chi){
							echo "<li class='pb-1'><a href='$chi->url'>$chi->title</a></li>";
						} ?>
					</ul>
					<ul class="mt-4">
						<li class="text-white relative inline-block w-12">
							<a target="_blank" href="https://www.facebook.com/perroslife"><svg class="h-16 w-16 text-white relative sm:absolute top-0 left-0" fill="white" viewBox="0 0 64 64" aria-hidden="true">
				              <path d="M39.77,19.95A19.8,19.8,0,1,0,16.43,39.42V24.57c0-.14,0-.14-.14-.14H13.24c-.13,0-.14,0-.14-.14V18.95c0-.13,0-.14.14-.14H16.3c.13,0,.13,0,.13-.13,0-1.21,0-2.42,0-3.62A9.31,9.31,0,0,1,17,12a5.21,5.21,0,0,1,1.66-2.37,5.9,5.9,0,0,1,2.14-1,8.13,8.13,0,0,1,1.61-.28c.47,0,.94-.06,1.41-.06h4.15c.2,0,.2,0,.2.2v5.28c0,.14,0,.14-.14.14H25a3.14,3.14,0,0,0-1,.15A1.22,1.22,0,0,0,23.19,15a6,6,0,0,0-.06.78c0,1,0,1.91,0,2.87,0,.13,0,.13.13.13h4.81c.07,0,.09,0,.08.09,0,.33-.07.66-.11,1s-.08.77-.13,1.15-.06.64-.1,1-.07.65-.1,1l-.08.78c0,.19,0,.39-.06.58,0,0,0,.06-.08.07a.27.27,0,0,1-.1,0H23.27c-.14,0-.14,0-.14.14V39.46h0A19.79,19.79,0,0,0,39.77,19.95"></path>
				            </svg>
				            </a>
						</li>
						<li class="text-white relative inline-block w-12">
							<a href="https://www.instagram.com/perros.life/" target="_blank">
							<svg class="h-16 w-16 text-white relative sm:absolute top-0 left-0" fill="white" viewBox="0 0 64 64" aria-hidden="true">
				              <path d="M23.91,20A3.9,3.9,0,1,0,20,23.89,3.91,3.91,0,0,0,23.91,20m3.76-6.32a1.41,1.41,0,1,1-1.45-1.36,1.41,1.41,0,0,1,1.45,1.36M26,20a6,6,0,1,1-6-6,6,6,0,0,1,6,6m3.56,3.49c0-2.06,0-4.12,0-6.17a17.42,17.42,0,0,0-.2-3.35,3.93,3.93,0,0,0-3-3.28,11.34,11.34,0,0,0-2.85-.27q-3.52,0-7,0a11.83,11.83,0,0,0-2.67.23,3.91,3.91,0,0,0-2.91,2.45,6.58,6.58,0,0,0-.4,2.3c0,1.53-.05,3.06-.08,4.59h0c0,1,0,1.94,0,2.91a16.73,16.73,0,0,0,.2,3.11,4,4,0,0,0,3.19,3.32,12.54,12.54,0,0,0,2.77.23c2,0,4,0,6,0A17.71,17.71,0,0,0,26,29.37a3.93,3.93,0,0,0,3.28-3,11.48,11.48,0,0,0,.27-2.85M31.71,20h0c0,1.35,0,2.69,0,4a10.52,10.52,0,0,1-.43,3.2,6,6,0,0,1-4.73,4.18,14.26,14.26,0,0,1-3,.25c-2.55,0-5.11,0-7.66,0a9.83,9.83,0,0,1-3.14-.44A6,6,0,0,1,8.6,26.69a10.74,10.74,0,0,1-.27-2.51q0-4.19,0-8.37a9.65,9.65,0,0,1,.48-3.25,6,6,0,0,1,4.48-4,11,11,0,0,1,2.59-.27q4.09,0,8.19,0a10,10,0,0,1,3.27.46,6,6,0,0,1,4.09,4.7,19.28,19.28,0,0,1,.26,3.72c0,.94,0,1.87,0,2.81m8.17,0A19.88,19.88,0,1,0,20,39.88,19.88,19.88,0,0,0,39.88,20"></path>
				            </svg>
				            </a>
						</li>
					</ul>
				</div>

				<div class="border-t border-white lg:border-0 pt-4 lg:pt-0">
					<ul class="uppercase">
						<?php foreach ($termspage->children as $terms){
							echo "<li class='pb-1'><a href='$terms->url'>$terms->title</a></li>";
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- closing line -->
	<div class="bg-neutral-300 px-4">
		<div class="container mx-auto">
			<div class="grid grid-cols-1 lg:grid-cols-2 text-xxs py-4">
				<p><?php echo date('Y') ?> |PERROS LIFE — P.IVA 00888080140 <br>MORBEGNO, ITALIA</p>
				<p class="lg:text-right">Design by LB&GM</p>
			</div>
		</div>
	</div>
	
</footer>