<?php include 'inc/head.php'; ?>
</head>

	<body>
		<h1 class="text-5xl font-bold text-green-600"><?php echo $page->title; ?></h1>
		<?php if($page->editable()) echo "<p><a href='$page->editURL'>Edit</a></p>"; ?>

	</body>
</html>


<?php 

/**
	 * fields

# extra_titles - COMBO
titolo
sottotitolo
footer
bottone
id_pagina

	 */	
 ?>