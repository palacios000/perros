<?php include 'inc/head.php'; ?>
<body>

<?php include 'inc/menu.php' ?>

<section id="info">
  <div class="bg-neutral-200">
    <div class="container mx-auto px-4 grid justyfy-between grid-cols-2 gap-y-16 pt-24 pb-36">

      <!-- testo -->
      <div class="">
        <p class="uppercase text-red-700 font-oswald text-2ll mb-11 ">Come scegliere</p>
        <h2 class="font-oswald text-5xl font-bold leading-tight">Pettorine, guinzagli, come scegliere</h2>
        <p class="font-oswald text-2xl leading-tight mt-12">Sottotitolo Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit eos obcaecati non sint soluta, eveniet consequatur magni sapiente numquam, esse libero. Rerum perspiciatis aliquid, magnam quis molestias tenetur recusandae at?</p>

        <!-- body -->
        <div class="mt-20 ">
          e qui ci metto il body
          
        </div>
      </div>

      <!-- immagine -->
      <div>
        
      <div class="h-full flex flex-row-reverse">
        <div class="h-full w-96 bg-white bg-ossi-pattern rounded-full mt-8">
          <img class="w-96" src="<?php echo $config->urls->templates ?>styles/images/cane.png" alt="">
        </div>
      </div>
      </div>
      
    </div>
  </div>
</section>

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