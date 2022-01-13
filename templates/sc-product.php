<?php include 'inc/head.php'; ?>
</head>

<body>
    <div hidden id="snipcart" data-api-key="ZGMzZTk0YmItMmU2OC00OGRjLTg3OTItYWY5ODBhZjRkNDM4NjM3Nzc0MDE2OTE4MzA0NzA2"></div>

<div class="uk-text-center snipcart-summary" pw-after="masthead-logo">
    <a href="#" class="uk-link-reset snipcart-checkout" aria-label="Shopping cart">
       
        <span class="uk-badge uk-text-middle snipcart-total-items" aria-label="Items in cart"></span>
        <span class=" uk-text-middle snipcart-total-price" aria-label="Total"></span>
    </a>
    <button class="uk-button uk-button-default uk-button-small snipcart-user-profile" type="button">
        <span class="snipcart-user-email">My Account</span>
    </button>
    <div class="uk-inline snipcart-user-logout">
        <button class="uk-button uk-button-default uk-button-small snipcart-edit-profile" type="button"> Edit Profile</button>
        <button class="uk-button uk-button-default uk-button-small snipcart-user-logout" type="button"> Logout</button>
    </div>
</div>


<!--
The content element holds your product detail view.
-->
<div id="content">
    <?php
    //echo ukHeading1(page()->title, 'divider');

    // We use the first image in snipcart_item_image field for demo
    if ($image = page()->snipcart_item_image->first()) {
        $productImageLarge = $image->size(500, 0, array('quality' => 70));
        $imageDesc = $productImageLarge->description ? $productImageLarge->description : page()->title;
        $imageMedia = '<img src="' . $productImageLarge->url . '" alt="' . $imageDesc . '">';
    }


    // Get the formatted product price.
    // The getProductPriceFormatted method is provided by MarkupSnipWire module and can be called 
    // via custom API variable: $snipwire->getProductPriceFormatted()
    $priceFormatted = wire('snipwire')->getProductPriceFormatted(page());

    if (!$input->get->taglia) {
        
    $out =
    '<div class="" >' .
        '<div>' .
            $imageMedia .
        '</div>' .
        '<div>' .
            '<dl>' .
                '<dt>Price</dt>' .
                '<dd><span class="uk-text-primary uk-text-large">' . $priceFormatted . '</span></dd>' .
                '<dt>Description</dt>' .
                '<dd>' . page()->snipcart_item_description . '</dd>' .
            '</dl>' .
            $anchor .
        '</div>' .
    '</div>';
    
    echo $out;
    }else{
        echo "";
    }
    ?>

    <!-- modal taglie -->

        <div x-data="{ open: false }">
            <!-- Button -->
            <button x-on:click="open = true" type="button" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                Scegli la taglia
            </button>

            <!-- Modal -->
            <div
                x-show="open"
                x-on:keydown.escape.prevent.stop="open = false"
                role="dialog"
                aria-modal="true"
                x-id="['modal-title']"
                :aria-labelledby="$id('modal-title')"
                class="fixed inset-0 overflow-y-auto"
            >
                <!-- Overlay -->
                <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

                <!-- Panel -->
                <div
                    x-show="open" x-transition
                    x-on:click="open = false"
                    class="relative min-h-screen flex items-center justify-center p-4"
                >
                    <div
                        x-on:click.stop
                        x-trap.noscroll.inert="open"
                        class="relative max-w-2xl w-full bg-white border border-black p-8 overflow-y-auto"
                    >
                        <!-- Title -->
                        <h2 class="text-3xl font-medium" :id="$id('modal-title')">Confirm</h2>
                        <!-- Content -->
                        <p class="mt-2 text-gray-600">Are you sure you want to learn how to create an awesome modal?</p>
                        <!-- Buttons -->
                        <div class="mt-8 flex space-x-2">
                            <form action="" method="get">

                                <?php foreach ($page->snipcart_item_variations as $variation) {
                                    echo "
                                      <input type='radio' id='$variation->id' name='taglia' value='{$variation->product_variations->code}'>
                                      <label for='$variation->id'>{$variation->product_variations->code}</label><br>
                                    ";
                                } ?>
<!--                                   <input type="radio" id="css" name="taglia" value="CSS">
                                  <label for="css">CSS</label><br>
                                  <input type="radio" id="javascript" name="taglia" value="JavaScript">
                                  <label for="javascript">JavaScript</label>
 -->                                  <hr>

                                <button type="submit" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                                    Confirm
                                </button>
                                <button type="button" x-on:click="open = false" class="bg-white border border-black px-4 py-2 focus:outline-none focus:ring-4 focus:ring-aqua-400">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>






</div>


</body>
</html>


<!-- 
table template & fields

VARIAZIONE PRODOTTI
|====================|=======|==================================================|
| product_options    | combo | colours,price_extra                              |
| product_variations | combo | code,price,nastro,circ_toracica,circ_addome,peso |

MINUTERIA
|==========|
| title    |
| images   |
| infotext |
|          |

VARIABILI - colori
|========|
| title  |
| codice |
|        |

 -->