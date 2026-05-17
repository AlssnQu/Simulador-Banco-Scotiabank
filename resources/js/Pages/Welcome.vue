<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showAccederMenu = ref(false);
const activePromo = ref(0); // Para controlar el carrusel de 4 puntos

const navItems = [
    'Canales', 'Ahorros', 'Tarjetas', 'Préstamos', 
    'Depósitos e inversión', 'Seguros', 'Programas de lealtad', 
    'Financieros', 'Servicios'
];
</script>

<template>
    <Head title="Scotiabank | Inicio" />

    <div class="min-h-screen bg-white font-sans text-gray-800">
        <header class="bg-white border-b border-gray-100 px-6 py-12">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                
                <div class="flex items-center space-x-8">
                    <h1 class="text-[#D11218] text-6xl font-black tracking-tighter">Scotiabank<span class="text-gray-300">.</span></h1>
                    
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Búsqueda" 
                            class="bg-white border-gray-300 rounded-md pl-10 pr-4 py-4 text-sm w-64 focus:ring-1 focus:ring-red-500 placeholder:text-lg"/>
                        <span class="absolute right-3 top-7 text-gray-400">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 h-6 w-6"
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2" 
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" 
                                />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="flex flex-col items-center text-gray-600 hover:text-[#D11218]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-[10px] font-bold uppercase mt-1">Hazte Cliente</span>
                    </button>

                    <div class="relative">
                        <button @click="showAccederMenu = !showAccederMenu" 
                            class="border-2 border-[#D11218] bg-[#D11218] text-white px-6 py-5 rounded-md font-bold flex items-center space-x-2 hover:bg-red-700 transition">
                            <span>Acceder</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div v-if="showAccederMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 shadow-xl rounded-md overflow-hidden z-50">
                            <Link :href="route('login')" class="block px-4 py-3 text-sm font-medium hover:bg-gray-50 border-b border-gray-50">Personas</Link>
                            <a href="#" class="block px-4 py-3 text-sm font-medium hover:bg-gray-50 border-b border-gray-50 text-gray-400">Negocios</a>
                            <a href="#" class="block px-4 py-3 text-sm font-medium hover:bg-gray-50 text-gray-400">Telebanking</a>
                        </div>
                    </div>

                    <button class="border-2 border-[#D11218] text-[#D11218] px-6 py-5 rounded-md font-bold hover:bg-red-50 transition">
                        Abrir cuenta digital
                    </button>
                </div>
            </div>
        </header>

        <nav class="bg-white border-b border-gray-100 overflow-x-auto whitespace-nowrap">
            <div class="max-w-7xl mx-auto px-6 flex space-x-8">
                <a v-for="item in navItems" :key="item" href="#" 
                    class="py-5 text-lg font-medium text-gray-600 hover:text-[#D11218] hover:border-b-2 hover:border-[#D11218] transition-all">
                    {{ item }}
                </a>
            </div>
        </nav>

        <section class="flex flex-col lg:flex-row h-[500px]">
            <div class="w-full lg:w-1/2 bg-[#D11218] p-12 md:p-20 flex flex-col justify-center text-white relative">
                <div class="max-w-md ml-auto">
                    <h3 class="text-4xl font-black leading-tight italic">¡Gana S/50 SIN sorteos!</h3>
                    <p class="text-xl mt-4 font-light">Abre tu primera Cuenta Digital y gana</p>
                    
                    <div class="mt-8 space-y-4">
                        <div class="flex items-center space-x-3">
                            <img 
                                src="/icons/plin-yape.svg"
                                alt="Yape y Plin"
                                class="w-9 h-9 brightness-0 invert"
                            />
                            <p class="text-lg font-medium">
                                Aprovecha un tipo de cambio preferencial
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <img 
                                src="/icons/smartphone.svg"
                                alt="Smartphone"
                                class="w-9 h-9 brightness-0 invert"
                            />
                            <p class="text-lg font-medium">
                                Realiza transferencias digitales gratuitas
                            </p>
                        </div>
                    </div>

                    <div class="mt-10 flex space-x-4">
                        <button class="bg-white border border-white text-black px-8 py-3 rounded-full font-bold hover:bg-[#D11218] hover:text-white transition">
                            Ábrela aquí
                        </button>
                        <button class="bg-white border border-white text-black px-8 py-3 rounded-full font-bold hover:bg-[#D11218] hover:text-white transition">
                            Conoce más
                        </button>
                    </div>

                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3">
                        <button v-for="i in 4" :key="i" @click="activePromo = i-1"
                            :class="['w-2.5 h-2.5 rounded-full transition', activePromo === i-1 ? 'bg-white' : 'bg-white/40']">
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 bg-gray-200 overflow-hidden">
                <img src="/images/gana-50.png" alt="Promoción Scotiabank" class="w-full h-full object-cover">
                </div>
        </section>
    </div>
</template>

<style scoped>
/* Estilo para ocultar scrollbar en el mini-header pero permitir scroll */
nav::-webkit-scrollbar {
    display: none;
}
nav {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>