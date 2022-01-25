<?php include(\ProcessWire\wire('files')->compile('inc/head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>
</head>

<!--
Adding a show cart button + cart summary + customer dashboard links.

The key is to have elements with specific Snipcart classes in your markup:

 - "snipcart-summary"      -- wrapper element for all elements with Snipcart classes supplied (optional but recommended!)
 - "snipcart-total-items"  -- displays total items currently in cart
 - "snipcart-total-price"' -- displays the current total cart price
 - "snipcart-user-profile" -- triggers the apparition of the users dashboard (orders history, subscriptions)
 - "snipcart-user-email"   -- displays the users email address (previous content within this element will be overridden)
 - "snipcart-user-logout"  -- enables a logout link/button (+ elements with this class will be hidden until the user is logged in)
 - "snipcart-edit-profile" -- triggers the apparition of the users profile editor (billing address, shipping address)

The complete markup is up to you - it just needs to have the described classes included!

More here: https://docs.snipcart.com/getting-started/the-cart
and here: https://docs.snipcart.com/getting-started/customer-dashboard
-->

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
    //echo ukHeading1(\ProcessWire\page()->title, 'divider');

    // We use the first image in snipcart_item_image field for demo
    if ($image = \ProcessWire\page()->snipcart_item_image->first()) {
        $productImageLarge = $image->size(800, 0, array('quality' => 70));
        $imageDesc = $productImageLarge->description ? $productImageLarge->description : \ProcessWire\page()->title;
        $imageMedia = '<img src="' . $productImageLarge->url . '" alt="' . $imageDesc . '">';
    } else {
        $imageMedia = 
        '<div class="uk-width-1-1 uk-height-medium uk-background-muted uk-text-muted uk-flex uk-flex-center uk-flex-middle">' .
            '<div title="' . \ProcessWire\__('No product image available') . '">' .  
            '</div>' .
        '</div>';
    }

    // This is the part where we render the Snipcart anchor (buy button)
    // with all data-item-* attributes required by Snipcart.
    // The anchor method is provided by MarkupSnipWire module and can be called 
    // via custom API variable: $snipwire->anchor()
    $options = array(
        'label' => 'Add to cart',
        'class' => 'uk-button uk-button-primary',
        'attr' => array('aria-label' => \ProcessWire\__('Add item to cart')),
    );
    $anchor = \ProcessWire\wire('snipwire')->anchor(\ProcessWire\page(), $options);

    // Get the formatted product price.
    // The getProductPriceFormatted method is provided by MarkupSnipWire module and can be called 
    // via custom API variable: $snipwire->getProductPriceFormatted()
    $priceFormatted = \ProcessWire\wire('snipwire')->getProductPriceFormatted(\ProcessWire\page());

    $out =
    '<div class="uk-margin-medium-bottom" uk-grid>' .
        '<div class="uk-width-2-5@s">' .
            $imageMedia .
        '</div>' .
        '<div class="uk-width-3-5@s">' .
            '<dl class="uk-description-list uk-description-list-divider">' .
                '<dt>Price</dt>' .
                '<dd><span class="uk-text-primary uk-text-large">' . $priceFormatted . '</span></dd>' .
                '<dt>Description</dt>' .
                '<dd>' . \ProcessWire\page()->snipcart_item_description . '</dd>' .
                '<dt>Product ID</dt>' .
                '<dd>' . \ProcessWire\page()->snipcart_item_id . '</dd>' .
            '</dl>' .
            $anchor .
        '</div>' .
    '</div>';
    
    echo $out;
    ?>
</div>


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