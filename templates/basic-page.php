<?php include 'inc/head.php'; ?>
</head>

	<body>
		<h1 class="text-5xl font-bold text-green-600"><?php echo $page->title; ?></h1>
		<?php if($page->editable()) echo "<p><a href='$page->editURL'>Edit</a></p>"; ?>

	</body>
</html>
