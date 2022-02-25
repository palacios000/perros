import swell from 'https://cdn.skypack.dev/swell-js';
import Alpine from 'https://cdn.skypack.dev/alpinejs';
 
// Swell
	window.swell = swell;

	swell.init('perros', 'pk_ZdR0rU8LGHdbvfs80ZZAT9u4RCeGbUE1', {
	  useCamelCase: false,
	  url: 'https://perros.swell.store/',
	});

	/* these php vars below are fetched from the product page */
	window.addToSwellCart = function addToSwellCart() {
		swell.cart.addItem({
		  product_id: swellProductId,
		  quantity: 1,
		  options: {
		    Taglia: tagliaOK,
		    Colore: coloreOK,
		    Minuteria: sceltaMinuteria
		  }
		});
	};

const myCart = await swell.cart.get();

// Alpine
	window.Alpine = Alpine;

	window.alpineStore = function alpineStore(){
	  return{
	    myCart,
	    fetchCart(){
	      swell.cart.get().then(cart => {
	        myCart = cart
	      })
	    }
	  }
	}
	 
	Alpine.start()




// some console logs
console.log(myCart);
console.log(myCart.item_quantity);
console.log(myCart.id);