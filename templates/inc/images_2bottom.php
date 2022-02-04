<?php 
if (count($page->images_footer)>=1) {
echo "
<section id='immagini' class='flex flex-row container mx-auto'>
	<div>
		<img src='{$page->images_footer->eq(0)->size(1055,614)->url}' alt='{$page->images_footer->eq(0)->description}'>
	</div>
	<!-- 2 -->
	<div>
		<div class='relative'>
		<img src='{$page->images_footer->eq(1)->size(633,614)->url}' alt='{$page->images_footer->eq(1)->description}'>
			<img class='absolute top-0 left-0' src='{$config->urls->templates}styles/images/linguetta-perros.png' alt='etichetta Perros Life'>
		</div>
	</div>    
</section>
";
}
?>