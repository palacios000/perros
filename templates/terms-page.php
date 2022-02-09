<?php include 'inc/head.php'; ?>
<body>
	
<?php include 'inc/menu.php'; ?>



	<section id="" class="container mx-auto">
		<div class="flex flex-row gap-x-4">
			<!-- colonna prodotti -->
			<div class="w-auto pr-12">
			<div class="prose max-w-none my-16 ">
				<?= $page->body ?>
			</div>
			</div>


			<!-- colonna info sinistra -->
			<div class="w-58 flex-none">

				<!-- menu prodotti -->
				<div class="bg-perros-brown p-5 my-12 text-white font-oswald w-full text-center uppercase">
					<h2 class="text-3ll my-2">Prodotti</h2>
					<ul class="text-2xl font-light">
						<?php 
						$sibC = 1;
						foreach ($pages->find("template=sc-shop") as $sibling) {
							$dottedLine = ($sibC != 1) ? 'dottedLineSmall' : '';
							echo "<li class='py-2 $dottedLine'><a href='$sibling->url'>$sibling->title</a></li>";
							$sibC++;
						} ?>
						
					</ul>
				</div>

				<!-- tutto (cane) -->
				<div>
				  <div class="flex ">
				    <div class="w-58 bg-perros-green bg-ossi-pattern mix-blend-multiply mt-36 relative">
				      <!-- 1st image circle-->
				      <img class="w-58 absolute -top-28" src="<?php echo $homepage->homebox->first->images->first->url ?>" alt="" >
				      <!-- etichetta -->
				      <img class="absolute top-0 -right-8" src="<?php echo $config->urls->templates ?>styles/images/linguetta-perros.png" alt="etichetta Perros Life">

				      <!-- testo //   -->
				      <div class="colonnina mx-4 text-white pb-8">
				        <h3 class="mt-36 mb-6 text-4xl font-oswald "><?php echo $qualitapage->title ?></h3>
				        <ul>
				        	<?php foreach ($qualitapage->children->find("title%^=tutto") as $tutto){
				        		echo "<li><a class='uppercase font-oswald font-light text-xl' href='$tutto->url'>&gt; $tutto->title</a></li>";	
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
<?php //include 'inc/images_2bottom.php'  ?>

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