<div class="relative w-full h-96 overflow-hidden rounded-2xl shadow-2xl mb-12">
    <!-- Images -->
    <div class="relative w-full h-full">
        <div class="carousel-slide active absolute inset-0 transition-opacity duration-1000">
            <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=800&fit=crop"
                 alt="Infrastructure IT Moderne" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center text-white">
                <div class="max-w-2xl px-4">
                    <h3 class="text-4xl font-bold mb-4">Infrastructure IT Moderne</h3>
                    <p class="text-xl opacity-90">Solutions serveurs haute performance pour votre entreprise</p>
                </div>
            </div>
        </div>
        
        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <img src="https://images.pexels.com/photos/60504/security-protection-anti-virus-software-60504.jpeg?auto=compress&cs=tinysrgb&w=1920&h=800&fit=crop"
                 alt="Cybersécurité Avancée" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center text-white">
                <div class="max-w-2xl px-4">
                    <h3 class="text-4xl font-bold mb-4">Cybersécurité Avancée</h3>
                    <p class="text-xl opacity-90">Protection multicouche contre toutes les menaces</p>
                </div>
            </div>
        </div>
        
        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0">
            <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=1920&h=800&fit=crop"
                 alt="Support Expert 24/7" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center text-white">
                <div class="max-w-2xl px-4">
                    <h3 class="text-4xl font-bold mb-4">Support Expert 24/7</h3>
                    <p class="text-xl opacity-90">Accompagnement technique par nos experts certifiés</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    
    <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <button onclick="goToSlide(0)" class="carousel-dot w-3 h-3 rounded-full bg-white transition-all duration-300"></button>
        <button onclick="goToSlide(1)" class="carousel-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300"></button>
        <button onclick="goToSlide(2)" class="carousel-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300"></button>
    </div>
</div>