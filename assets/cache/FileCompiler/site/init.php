<?php 
// funzioni pagina prodotto

	//tabella
	function tableTitle($titolo, $colore){
		$th = "
		<div class='w-1/6 text-center font-oswald uppercase font-bold $colore'>
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
			if (is_numeric($titolo)) {
				$testo .= "&gt; " . $titolo . " " .$unita;
			}else{
				$testo .= $titolo;
			}
		}

		$td = "
		<div class='w-1/6 flex items-center '>
			<div class='text-sm text-center font-medium $colore w-full'>
				$testo
			</div>
		</div>
		";
		return $td;
	}


//h1 title
function getH1($page){
	$h1 = ($page->titleH1) ? $page->titleH1 : $page->title;
	return $h1;
}

/* immagini srcset ecc*/
function mainPicture($page){
	$image = (count($page->images)) ? $page->images->first : $page->parent->images->first;
	return $image;
}

function renderImageResponsive($img, $breakpointSizes, $cover = false) {
	/**
	 // thanks https://processwire.com/talk/topic/19964-building-a-reusable-function-to-generate-responsive-images/?do=findComment&comment=174576
	 * Builds responsive img tag with srcset and sizes attributes
	 * @param \Processwire\Pageimage $img
	 * @param array $breakpointsizes array of associative arrays that describe media min breakpoints and width/height of images from the respective
	 * breakpoint to the next
	 * Example:
	 * $breakpointSizes = [
	 *   ['bp' => 320, 'sz' => [500, 0]],
	 *   ['bp' => 576, 'sz' => [992, 0]],
	 *   ['bp' => 992, 'sz' => [690, 0]]
	 *   ['bp' => 1200, 'sz' => [835, 0]]
	 * ];
	 * @return string 
	 */

	$imgSrc = $img->url; // use original image as fallback src
	$alt = ($img->description) ? $img->description : $img->page->title; // if no description use page title 

	// construct sizes attribute
	$sizes = array();
	foreach(array_reverse($breakpointSizes) as $bs) {
		$sizes[] = "(min-width:{$bs['bp']}px) {$bs['sz'][0]}px";
	}
	$sizes = implode(', ', $sizes) . ', 100vw';

	// construct srcset attribute
	$srcSet = array();
	foreach($breakpointSizes as $bs) {
		$srcSet[] = $img->size($bs['sz'][0], $bs['sz'][1])->url . " {$bs['sz'][0]}w";
	}
	$srcSet = implode(', ', $srcSet);

	//uk-cover
	$ukcover = ($cover) ? "uk-cover" : "";

	return "<img class='img-fluid' src='{$imgSrc}' srcset='{$srcSet}' sizes='{$sizes}' alt='{$alt}' $ukcover>";

}
function imageSrcsetWebp($img, $imageSrcset, $imageSizes, $cover = false) {
	/**
	 * ripreso funcion renderImageResponsive e rimodellato secondo esigenze
	 * $imageSrcset = [585,450,241];
	 * $imageSizes = [
		['css' => 'min-width: 1200px', 'width' => 33.3vw],
		['css' => 'max-width: 640px', 'width' => 100vw],
		];
	 * @return string 
	 */

	$imgSrc = $img->url; // use original image as fallback src
	$alt = ($img->description) ? $img->description : $img->page->title; // if no description use page title 

	// construct sizes attribute
		if (array_filter($imageSizes)) {
			$sizes = array();
			foreach(array_reverse($imageSizes) as $bs) {
				$sizes[] = "({$bs['css']}) {$bs['width']}";
			}
			$sizes = implode(', ', $sizes) . ', 100vw';
		}else{
			$sizes = '100vw';
		}

	// construct srcset attribute
		//1 normal jpg
		$srcSet = array();
		foreach($imageSrcset as $iSrc) {
			$srcSet[] = $img->width($iSrc)->url . " {$iSrc}w";
		}
		$srcSet = implode(', ', $srcSet);
		//2 webp -- only if masonry
		if (!$cover) {
			$webpSet = array();
			foreach($imageSrcset as $iSrc) {
				$webpSet[] = $img->width($iSrc)->webp->url . " {$iSrc}w";
			}
			$webpSet = implode(', ', $webpSet);
		}

	// purtroppo ho dei problemi con uk-cover e webp...
	if ($cover) {
		$picture .=  "<img src='{$imgSrc}' srcset='{$srcSet}' sizes='{$sizes}' alt='{$alt}' uk-cover>";
	}else{
		$picture = "<picture>";
		$picture .= "<source srcset='{$webpSet}' sizes='{$sizes}' type='image/webp'>";
		$picture .=  "<img src='{$imgSrc}' srcset='{$srcSet}' sizes='{$sizes}' alt='{$alt}' >";
		$picture .= "</picture>";

	}

	return $picture;
}

?>
