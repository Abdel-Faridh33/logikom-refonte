<div id="cart-modal" class="fixed inset-0 z-50 overflow-hidden hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeCart()"></div>
    
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b">
                <h2 class="text-xl font-bold text-gray-900 flex items-center space-x-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span>Panier (<span id="cart-items-count">0</span>)</span>
                </h2>
                <button onclick="closeCart()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-6">
                <div id="cart-items">
                    <!-- Les articles du panier seront chargés ici via JavaScript -->
                </div>
            </div>

            <!-- Footer -->
            <div id="cart-footer" class="border-t p-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold">Total:</span>
                    <span id="cart-total" class="text-2xl font-bold text-blue-600">0 CFA</span>
                </div>
                
                <button onclick="proceedToCheckout()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition-colors duration-300 font-semibold">
                    Procéder au paiement
                </button>
            </div>
        </div>
    </div>
</div>