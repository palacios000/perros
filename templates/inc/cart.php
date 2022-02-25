<!-- 
	@ Mikita: I've copied this cart from a template found on Vue + Nuxt,
	that's why you still see some tags from Vue.
	It's the first time I deal with Vue, so I don't know what a BaseIcon
	or BaseButton is.
	
	At the bottom of this file you see the scripts copied from the Nuxt template, they are probably useful for the interaction with SwellJS
	 -->




<div>
  <!-- <div x-data="alpineStore()" > -->
  <div x-data="alpineStore()" x-show="cartReady" >
    <div class="fixed inset-0 z-50">
      <!-- Overlay -->
      <div
        class="overlay absolute hidden h-full w-full bg-neutral-500 opacity-90 md:block"
        
      >

      <!-- Panel -->
      <div class="panel absolute right-0 h-full w-full max-w-md">
      	<button @click="cartReady = !cartReady">chiudi</button>
        <div class="h-full w-full overflow-y-scroll bg-white">
          <!-- Header -->
          <div class="container relative border-b border-primary-med py-5">
            <div class="flex items-center justify-between">
              <h3 >
                Carrello
                <template x-if="myCart">
                	<span x-text="myCart.item_quantity"></span>
                </template
                >
              </h3>
              <button @click.prevent="closeCart">
                <BaseIcon icon="uil:multiply" size="lg" />
              </button>
            </div>

            <div
              v-if="$te('cart.infoText')"
              class="mt-4 text-sm"
              v-html="$t('cart.infoText')"
            >
          </div>

          <!-- Items -->
          <template x-if="myCart">
              <template x-for="item in myCart.items">
                <span x-text="item.product.name"></span>
              </template>
          </template>

          <!-- <div v-if="cart && cart.items && cart.items.length">
            <CartItem
              v-for="(item, index) in cart.items"
              :key="`cartItem_${item.id}`"
              :item="item"
              :index="index"
            />
          </div>
          <div v-else class="container py-10">
            <span class="mb-4 block">{{ $t('cart.empty') }}</span>
            <BaseButton
              :link="shopLink"
              :label="$t('cart.backToProducts')"
              fit="static"
            />
          </div> -->

          <!-- Footer -->
          <div
            v-if="cart && cart.items && cart.items.length"
            class="border-t border-primary-med bg-primary-lighter"
          >

            <!-- Summary -->
            <div class="container border-b border-primary-med py-6">
              <div class="mb-1 flex justify-between">
                <span>Totale</span>
                <span x-text="myCart.currency + ' ' +  myCart.sub_total"></span>
              </div>
              <div class="mb-1 flex justify-between">
                <span>Spedizione</span>
                <span x-text="myCart.currency + ' ' +  myCart.shipment_total"></span>
              </div>
              <div
                v-show="cart.discountTotal"
                class="mb-1 flex justify-between"
              >
                <span>Sconto</span>
                <span x-text=" '-' + myCart.currency + ' ' +  myCart.discount_total"></span>
              </div>

              <h3 class="mt-3 flex justify-between text-xl font-semibold">
                <span>Totale</span>
                <span x-text="myCart.currency + ' ' +  myCart.grand_total"></span>
              </h3>


              <BaseButton
                class="mt-4 mb-1 block"
                size="lg"
                :label="$t('cart.checkout')"
                :is-loading="cartIsUpdating"
                :loading-label="$t('cart.updating')"
                :link="cart.checkoutUrl"
                target="_self"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	// Helpers
	/*import { mapState } from 'vuex'

	export default {
	  name: 'TheCart',

	  data() {
	    return {
	      couponCode: null,
	      shopLink: null,
	    }
	  },

	  async fetch() {
	    // Set component data
	    const { $swell } = this
	    this.shopLink = await $swell.settings.get('cart.shopLink', '/categories/')
	  },

	  computed: {
	    ...mapState(['cart', 'cartIsUpdating', 'currency']),

	    account() {
	      if (!this.cart.account) return
	      return this.cart.account
	    },
	  },

	  mounted() {
	    // Pass a checkout ID as a query string param to recover a specific cart
	    const { checkout: checkoutId } = this.$route.query
	    this.$store.dispatch('initializeCart', { checkoutId })
	  },

	  methods: {
	    closeCart() {
	      this.$store.commit('setState', { key: 'cartIsActive', value: false })
	    },

	    async applyDiscount() {
	      // Try to apply a coupon or gift card code
	      await this.$store.dispatch('applyDiscount', this.couponCode)
	      // Reset the coupon input
	      this.couponCode = null
	    },

	    removeDiscount(id) {
	      this.$store.dispatch('removeDiscount', id)
	    },
	  },
	}*/
</script>