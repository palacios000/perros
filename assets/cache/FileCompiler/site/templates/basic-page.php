<?php include(\ProcessWire\wire('files')->compile('inc/head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>
</head>

	<body>
		<h1 class="text-5xl font-bold text-green-600"><?php echo $page->title; ?></h1>
		<?php if($page->editable()) echo "<p><a href='$page->editURL'>Edit</a></p>"; ?>

	</body>
</html>
