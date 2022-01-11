<?php 
//mostra hr solo in certe pagine
//$hrNo = array('collezione'); 
// echo (in_array($page->template, $hrNo)) ? "" : "<hr>" 
?>


	<ul class="uk-breadcrumb uk-text-lowercase" >
		<?php 
		// problema redirect "appuntamenti"
		/*if ($page->template == "appuntamento" && $input->get->f) {
			$breads = $page->parents();
		}else{
			$breads = $page->parents()->append($page);
		}
		foreach( $breads as $parent) {
			$active = ($parent->id == $page->id) ? "is-active" : "";
			echo "<li class='$active'><a href='{$parent->url}'>";
			echo $parent->title;
			echo "</a></li> ";
		}*/
		?>
	</ul>
