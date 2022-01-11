<div id="stiki" uk-sticky="">
<nav id="newNavbar" class="uk-navbar-container" uk-navbar>
	<div class="uk-navbar-left">

		<a class="uk-navbar-item uk-logo uk-text-uppercase" href="<?php echo $homepage->url ?>" >
			<img src="<?php echo $config->urls->templates ?>styles/images/logo-smv.svg" width="180" alt="Sistema Museale Valtellina">
		</a>

	</div>
	<div class="uk-navbar-right">

		<?php if($page->editable()){
			echo "<a target='_blank' class='uk-navbar-item' href='https://carburo.net/news/smv-screencast/'><i class='far fa-chalkboard-teacher'></i></a>";
			echo "<a class='uk-navbar-item' href='$page->editURL'>Modifica Pagina</a>";
		} ?>

		<a class='uk-padding-small' uk-toggle="target: #modal-menu" ><i class="fas fa-bars"></i></a>
		
	</div>
</nav>
</div>

<!-- modal -->
	<div id="modal-menu" class="uk-modal-full " uk-modal>
		<div class="uk-modal-dialog uk-box-shadow-small">
			<div class='modalMenu smv-bg-smv'>
				<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
				<div class="uk-grid-collapse uk-child-width-1-2@s  uk-child-width-1-4@l uk-flex-top" uk-grid>
					<!-- 1st menu 1/2-->
						<div class="menu1 uk-padding">
							<ul class='uk-nav uk-nav-intro'>
								<li>SISTEMA</li>
							</ul>
							<ul class='uk-nav uk-nav-default'>
								<?php foreach ($homepage->children("template=basic-page|appuntamenti|articoli|contatti")->prepend($homepage) as $sideMenu) {
									$activeMenu = ($sideMenu->id == $page->id) ? "uk-active" : "";
									echo "<li class='$activeMenu uk-nav-header'><a href='$sideMenu->url'>$sideMenu->title</a></li>";
									$activeMenu = "";
								} ?>
							</ul>
						</div>
					<!-- 2nd menu 2/2-->
						<div class="menu2 uk-padding">
							<ul class='uk-nav uk-nav-intro'>
								<li>Musei</li>
							</ul>
							<ul class='uk-nav uk-nav-default'>
								<?php 
								//get pages
								$menu2ndColumn = $homepage->findOne("template=musei_tutti");
								foreach ($menu2ndColumn->children() as $sideMenu) {
									$activeMenu = ($sideMenu->id == $page->id) ? "uk-active" : "";
									echo "<li class='$activeMenu uk-nav-header'><a href='$sideMenu->url'>$sideMenu->title</a></li>";
									$activeMenu = "";
								} ?>

							</ul>
						</div>
					<!-- 3rd logo -->
						<div class="uk-padding ">
							<ul class='uk-nav uk-nav-intro'>
								<li>Scuola</li>
							</ul>
							<ul class='uk-nav uk-nav-default'>
								<?php foreach ($pages->findOne("name=menu-url-esterni")->children as $urlEx) {
									echo "<li><a href='$urlEx->museo_URL'>$urlEx->title</a></li>";
								} ?>
								<!-- <li>Didattica</li> -->
								<li class="login"><a href="<?php echo $config->urls->admin ?>">LOGIN</a></li>
								<li class="uk-nav-divider"></li>
								<li>
									<ul class="select-language">
										<!-- <li class="uk-display-inline-block"><a href="">Italiano</a></li>
										<li class="uk-display-inline-block">/</li>
										<li class="uk-display-inline-block"><a href="">Inglese</a></li> -->
										<?php 
										if (!$homepage->sito_tradotto) {
											$langLink = '';
											// $langX = 0; -- complicato, uso easy peasy solution...
											foreach ($languages as $language) {
												$langActive = ($user->language->id == $language->id) ? " active" : "";
												$url = $page->localUrl($language);
												if ($language->name == 'deutsch') {
													$langLink .= '<li class="uk-display-inline-block">&nbsp;/&nbsp;</li>';
												}
												$langLink .= "<li class='uk-display-inline-block'>";
												$langLink .= "<a href='$url' class='$langActive '>$language->title</a>";
												$langLink .= "</li>";
												if ($language->name == 'default') {
													$langLink .= '<li class="uk-display-inline-block">&nbsp;/&nbsp;</li>';
												}
												//$langX++;
											}
											
											// echo $langLink; -- aspettiamo traduzione - e metto toppa qua sotto
											echo '<li class="uk-display-inline-block uk-margin-remove">&nbsp;  &nbsp;</li>';
										} ?>
									</ul>
								</li>
								<li class='social'>
									<a target="_blank" href="https://www.youtube.com/channel/UCpgC7A1AxHwecq3Rq0WhmBg/videos"><i class="fab fa-youtube"></i></a>
									
									<a target="_blank" href="https://www.facebook.com/SistemaMusealeValtellina"><i class="fab fa-facebook-square"></i></a>

									<a target="_blank" href="https://www.instagram.com/sistemamusealevaltellina/"><i class="fab fa-instagram"></i></a>
								</li>
							</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
