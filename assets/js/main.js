// Variables globales
let currentSlide = 0;
let cartItems = [];
let isCartOpen = false;
let isLoginModalOpen = false;

// Carousel functionality
function nextSlide() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    
    slides[currentSlide].classList.remove('opacity-100');
    slides[currentSlide].classList.add('opacity-0');
    dots[currentSlide].classList.remove('bg-white', 'scale-125');
    dots[currentSlide].classList.add('bg-white/50');
    
    currentSlide = (currentSlide + 1) % slides.length;
    
    slides[currentSlide].classList.remove('opacity-0');
    slides[currentSlide].classList.add('opacity-100');
    dots[currentSlide].classList.remove('bg-white/50');
    dots[currentSlide].classList.add('bg-white', 'scale-125');
}

function prevSlide() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    
    slides[currentSlide].classList.remove('opacity-100');
    slides[currentSlide].classList.add('opacity-0');
    dots[currentSlide].classList.remove('bg-white', 'scale-125');
    dots[currentSlide].classList.add('bg-white/50');
    
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    
    slides[currentSlide].classList.remove('opacity-0');
    slides[currentSlide].classList.add('opacity-100');
    dots[currentSlide].classList.remove('bg-white/50');
    dots[currentSlide].classList.add('bg-white', 'scale-125');
}

function goToSlide(index) {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    
    slides[currentSlide].classList.remove('opacity-100');
    slides[currentSlide].classList.add('opacity-0');
    dots[currentSlide].classList.remove('bg-white', 'scale-125');
    dots[currentSlide].classList.add('bg-white/50');
    
    currentSlide = index;
    
    slides[currentSlide].classList.remove('opacity-0');
    slides[currentSlide].classList.add('opacity-100');
    dots[currentSlide].classList.remove('bg-white/50');
    dots[currentSlide].classList.add('bg-white', 'scale-125');
}

// Auto-play carousel
setInterval(nextSlide, 5000);

// Mobile menu toggle
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
}

// Cart functionality
function toggleCart() {
    if (isCartOpen) {
        closeCart();
    } else {
        openCart();
    }
}

function openCart() {
    document.getElementById('cart-modal').classList.remove('hidden');
    isCartOpen = true;
    loadCartItems();
}

function closeCart() {
    document.getElementById('cart-modal').classList.add('hidden');
    isCartOpen = false;
}

function loadCartItems() {
    fetch('api/cart.php?action=get')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayCartItems(data.items);
                updateCartTotal(data.total);
                updateCartCount(data.count);
            }
        })
        .catch(error => console.error('Erreur:', error));
}

function displayCartItems(items) {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartFooter = document.getElementById('cart-footer');
    
    if (items.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="text-center py-12">
                <svg class="mx-auto w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <p class="text-gray-500">Votre panier est vide</p>
            </div>
        `;
        cartFooter.classList.add('hidden');
    } else {
        cartItemsContainer.innerHTML = items.map(item => `
            <div class="flex space-x-4 mb-6">
                <img src="assets/images/article/${item.Image}" alt="${item.Titre}" class="w-16 h-16 object-cover rounded-lg">
                
                <div class="flex-1">
                    <h3 class="font-medium text-gray-900 mb-1">${item.Titre}</h3>
                    <p class="text-blue-600 font-semibold">${formatPrice(item.Prix_reduction)}</p>
                    
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button onclick="updateQuantity(${item.Id_article}, ${item.Quantite - 1})" 
                                    class="p-1 hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            <span class="px-3 py-1 text-sm">${item.Quantite}</span>
                            <button onclick="updateQuantity(${item.Id_article}, ${item.Quantite + 1})" 
                                    class="p-1 hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </div>
                        
                        <button onclick="removeFromCart(${item.Id_article})" 
                                class="p-1 text-red-500 hover:bg-red-50 rounded transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
        cartFooter.classList.remove('hidden');
    }
}

function addToCart(productId, quantity = 1) {
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'add',
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount(data.count);
            showNotification('Produit ajouté au panier !', 'success');
            if (isCartOpen) {
                loadCartItems();
            }
        } else {
            showNotification('Erreur lors de l\'ajout au panier', 'error');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'ajout au panier', 'error');
    });
}

function removeFromCart(productId) {
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'remove',
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartItems();
            updateCartCount(data.count);
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function updateQuantity(productId, quantity) {
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'update',
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartItems();
            updateCartCount(data.count);
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function updateCartCount(count) {
    document.getElementById('cart-count').textContent = count;
    document.getElementById('mobile-cart-count').textContent = count;
    document.getElementById('cart-items-count').textContent = count;
}

function updateCartTotal(total) {
    document.getElementById('cart-total').textContent = formatPrice(total);
}

function formatPrice(price) {
    return new Intl.NumberFormat('fr-FR').format(price) + ' CFA';
}

// Login functionality
function openLoginModal() {
    document.getElementById('login-modal').classList.remove('hidden');
    isLoginModalOpen = true;
}

function closeLoginModal() {
    document.getElementById('login-modal').classList.add('hidden');
    isLoginModalOpen = false;
    document.getElementById('login-error').classList.add('hidden');
}

function handleLogin(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const username = formData.get('username');
    const password = formData.get('password');
    
    fetch('auth/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            username: username,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeLoginModal();
            location.reload();
        } else {
            document.getElementById('login-error').classList.remove('hidden');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        document.getElementById('login-error').classList.remove('hidden');
    });
}

// Solutions tabs
function showSolution(solutionName) {
    // Hide all solution contents
    document.querySelectorAll('.solution-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all solution tabs
    document.querySelectorAll('.solution-tab').forEach(tab => {
        tab.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
        tab.classList.add('bg-gray-50', 'text-gray-700', 'hover:bg-blue-50', 'hover:text-blue-600');
    });
    
    // Show selected solution content
    document.getElementById('solution-content-' + solutionName).classList.remove('hidden');
    
    // Add active class to selected solution tab
    const activeTab = document.getElementById('solution-' + solutionName);
    activeTab.classList.remove('bg-gray-50', 'text-gray-700', 'hover:bg-blue-50', 'hover:text-blue-600');
    activeTab.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
}

// Notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.classList.add('bg-green-500', 'text-white');
    } else if (type === 'error') {
        notification.classList.add('bg-red-500', 'text-white');
    } else {
        notification.classList.add('bg-blue-500', 'text-white');
    }
    
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Checkout
function proceedToCheckout() {
    window.location.href = 'checkout.php';
}

// Category Menu functionality - Style Amazon avec Dropdowns au Survol
// Déclarer la fonction dans le scope global explicitement
window.toggleCategoryMenu = function() {
    const menu = document.getElementById('categoryMenu');
    const overlay = document.getElementById('categoryMenuOverlay');

    if (!menu || !overlay) {
        console.error('Menu ou overlay non trouvé');
        return;
    }

    const isMenuHidden = menu.classList.contains('-translate-x-full');

    if (isMenuHidden) {
        // Ouvrir le menu
        console.log('Ouverture du menu');
        menu.classList.remove('-translate-x-full');
        menu.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Empêcher le scroll du body

        // Forcer le reflow pour s'assurer que l'animation fonctionne
        menu.offsetHeight;
    } else {
        // Fermer le menu
        console.log('Fermeture du menu');
        menu.classList.add('-translate-x-full');
        menu.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
        document.body.style.overflow = ''; // Réactiver le scroll du body
    }
};

// Fermer le menu quand on appuie sur Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const menu = document.getElementById('categoryMenu');
        if (menu && !menu.classList.contains('-translate-x-full')) {
            toggleCategoryMenu();
        }
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier que le menu et l'overlay existent
    const menu = document.getElementById('categoryMenu');
    const overlay = document.getElementById('categoryMenuOverlay');

    if (menu && overlay) {
        console.log('✓ Menu latéral et overlay chargés correctement');
        console.log('Menu initial classes:', menu.className);
    } else {
        console.error('✗ Menu ou overlay non trouvé!');
        if (!menu) console.error('  - categoryMenu manquant');
        if (!overlay) console.error('  - categoryMenuOverlay manquant');
    }

    // Vérifier que la fonction toggleCategoryMenu existe
    if (typeof window.toggleCategoryMenu === 'function') {
        console.log('✓ Fonction toggleCategoryMenu disponible dans window');
    } else {
        console.error('✗ Fonction toggleCategoryMenu non disponible dans window');
    }

    // Load cart count on page load
    fetch('api/cart.php?action=count')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount(data.count);
            }
        })
        .catch(error => console.error('Erreur:', error));
});