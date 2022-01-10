<?php if ($page->name != "http404"): ?>
	    <?php
	    //which image?
	    $museoRandom = $pages->find("template=museo_singolo, images_random.count>=1, sort=random")->first();
		$image = $museoRandom->images_random->getRandom(); 
		$didascalia = ($image->description) ? $image->description : $museoRandom->title;
	    $didascalia = "<a href='$museoRandom->url'>$didascalia</a>"; 
	    ?>
		<div class="uk-visible@m">
			<div class="uk-cover-container" uk-height-viewport="offset-top: true; offset-bottom: 15">
				<?php //output <picture>
			    $ukcover = 1;
			    $imageSrcset = [640,960,1200,1600,1920];
			    $imageSizes = [];
			    echo imageSrcsetWebp($image, $imageSrcset, $imageSizes, $ukcover)  ?>
				<div class="didascaliaRandom  uk-text-right ">
					<div class="">
						<?php echo $didascalia ?>
					</div>
				</div>
			</div>
		</div>
		<div class="uk-hidden@m">
			<div class="">
				<?php //output <picture>
			    $ukcover = 0;
			    $imageSrcset = [640,960,1200];
			    $imageSizes = [];
			    echo imageSrcsetWebp($image, $imageSrcset, $imageSizes, $ukcover)  ?>
			</div>
			<div class="didascaliaRandom"><?php echo $didascalia ?></div>
		</div>
	<?php endif ?>