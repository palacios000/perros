<footer>
	<div class="f1 smv-bg-smv uk-section">
		<div class="uk-grid uk-child-width-1-1@s uk-child-width-1-3@m ">
			
			<!-- menu -->
			<div class="menuFooter uk-margin">

				<p><?php echo $traduzioni->findOne("name=appuntamenti")->title ?><br>
					<?php echo "<a href='$appuntamenti->url' class='uk-button uk-button-default'>$appuntamenti->title</a>" ?>
				</p>
				<p><?php echo $traduzioni->findOne("name=iscriviti-newsletter")->title ?><br>
					<form action="https://scuola.sistemamusealevaltellina.it/index.php?option=com_acymailing&view=user&layout=modify&Itemid=651" method="post">
						<div class="uk-margin" uk-margin>
						    <div uk-form-custom="target: true">
						        <input name="email" class="uk-input uk-form-width-medium" type="email" placeholder="E-mail" required>
						    </div>
						    <button type="submit" class="uk-button uk-button-default"><?php echo $traduzioni->findOne("name=registrati")->title ?></button>
						</div>
					</form>
				</p>
			</div>

			<!-- logo @media medium-->
			<div class="uk-visible@m uk-text-center">
			</div>

			<!-- credits e altro -->
			<div id="SMVinfo" class="">
				<p class="ente uk-text-bold">
					<a class="uk-link-reset" href="<?php echo $config->urls->admin ?>">
					SERVIZIO CULTURA <br>
					E ISTRUZIONE <br>
					DELLA PROVINCIA DI SONDRIO <br>
					</a>
				</p>
				<p class="address">
					Corso XXV Aprile, 22 <br>
					23100 Sondrio <br>
					t. 0342 531231 <br>
					info@sistemamusealevaltellina.it <br><br>

					<a href="#">privacy</a> | <a href="#credits" uk-toggle>credits</a> <br><br>

					<a target="_blank" href="https://www.youtube.com/channel/UCpgC7A1AxHwecq3Rq0WhmBg/videos"><i class="fab fa-youtube"></i></a>
					<a target="_blank" href="https://www.facebook.com/SistemaMusealeValtellina"><i class="fab fa-facebook-square"></i></a>
					<a target="_blank" href="https://www.instagram.com/sistemamusealevaltellina/"><i class="fab fa-instagram"></i></a>

				</p>
			</div>
		</div>
	</div>

	<?php //if ($page->template == "home"){
		include "inc/bg_image-bottom.php";
	//} ?>
		

	<div class="f2 uk-section">
		<div class="uk-grid" uk-grid>
			<!-- same as menu -->
			<div class="uk-width-1-1@s uk-width-1-5@m uk-text-center uk-text-left@m">
				<a target="_blank" href="https://www.sistemamusealevaltellina.it"><img src="<?php echo $config->urls->templates ?>styles/images/logo-smv.svg" width="200" alt="Sistema Museale Valtellina"></a>
			</div>

			<div class="uk-width-1-6"></div>

			<!-- motto -->
			<div class="uk-visible@m uk-width-auto uk-text-center ">
				<p class='uk-text-large uk-margin-top'><?php echo $traduzioni->findOne("name=footer-line")->title ?></p>
			</div>

			
		</div>
	</div>
	
	<!-- credits MODAL -->
		<div id="credits" uk-modal>
		    <div class="uk-modal-dialog">
		        <button class="uk-modal-close-default" type="button" uk-close></button>
		        
		        <div class="uk-modal-body"><?php echo $homepage->credits ?></div>
		    </div>
		</div>
	<?php if ($user->hasRole("superuser")) {
		echo "<p>template: $page->template</p>";
	} ?>


</footer>

<!-- scripts -->
	<!-- uikit -->
	<script src="<?php echo $config->urls->templates?>js/uikit.min.js"></script>

	<!-- masonry -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
	<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>


	<!-- flickity // appuntamenti gallery-->
	<!-- <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script> -->

	<!-- smv settings -->
	<script src="<?php echo $config->urls->templates?>js/smv.js"></script>


	<script type="text/javascript">
			//menu sticky a scomparsa
	stiki     = document.getElementById("stiki");
	navbar    = document.getElementById("newNavbar");
	UIkit.util.on('#stiki', 'active', function () {
	    navbar.classList.add("uk-box-shadow-small", "myStiki");
	});
	UIkit.util.on('#stiki', 'inactive', function () {
	    navbar.classList.remove("uk-box-shadow-small", "myStiki");
	});

	</script>