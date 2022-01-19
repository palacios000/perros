<?php include(\ProcessWire\wire('files')->compile('inc/head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>
<body>

<?php include(\ProcessWire\wire('files')->compile('inc/menu.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)))?>

</body>
</html>


<?php



/*
table template & fields

HOME
|============|==========|=====================|
| slider     | repeater | title, images, body |
| titleH1    | text     |                     |
| subtitleH1 | text     |                     |
| homebox    | repeater | vedi sotto          |



homebox, repeater
|===============|=======|==============================|
| title         | text  | titolo                       |
| titleH1       | text  | categoria                    |
| subtitleH1    | text  | sottotitolo                  |
| codice        | text  | colore sfondo                |
| images        |       | immagini rotonde per colonna |
| homebox_aside | combo | title, body, title_extra     |
|               |       |                              |


*/