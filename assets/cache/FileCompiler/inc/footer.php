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
		        <dd class="mt-2 text-xl text-gray-500 text-center font-oswald">'.$icons->infotext.'

		        </dd>
		      </div>';

			  } ?>


		    </dl>
		  </div>
		</div>


	<!-- menu -->
	<div class="bg-perros-brown">
		<div class="container mx-auto py-16 text-white text-xm font-oswald">
			<div class="grid cols-4 gap-4">
				<div class="">
					<img src="<?php echo $config->urls->templates ?>styles/images/PERROSLIFE_logo-2.svg" alt="Logo Perros Life">
					<p class="mt-6 font-sans">
						PERROSLIFE <br>
						Via Credaro18 <br>
						23017Morbegno(SO)
					</p>
					<p class="mt-6">
						+39 345 139 43 80 <br>
						info@perroslife.com
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- closing line -->
	<div class="bg-neutral-300">
		<div class="container mx-auto">
			<div class="grid grid-cols-2 text-xxs py-4">
				<p><?php echo date('Y') ?> |PERROS LIFE — P.IVA /VAT 00888080140 |MORBEGNO, ITALIA</p>
				<p class="text-right">Design by the Morbegnos</p>
			</div>
		</div>
	</div>
	
</footer>