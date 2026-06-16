<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
// Importamos iconos de Heroicons (suponiendo que están instalados, si no, usamos SVG directos)
import { 
    HomeIcon, QuestionMarkCircleIcon, BellIcon, UserCircleIcon, 
    ArrowRightOnRectangleIcon, ChevronRightIcon, CreditCardIcon,
    EyeIcon, PencilSquareIcon, ArrowsRightLeftIcon, BanknotesIcon,
    CurrencyDollarIcon, DevicePhoneMobileIcon
} from '@heroicons/vue/24/outline';

const props = defineProps({
    auth: Object,
    account: Object // Pasaremos la cuenta desde el controlador
});

const showBalance = ref(false);
const logoutForm = useForm({});

const handleLogout = () => {
    logoutForm.post(route('logout'));
};

const quieroOpciones = [
    { name: 'Transferir', icon: ArrowsRightLeftIcon },
    { name: 'Pagar', icon: BanknotesIcon },
    { name: 'Cambiar a Dólares', icon: CurrencyDollarIcon },
    { name: 'Retirar sin Tarjeta', icon: DevicePhoneMobileIcon },
];
</script>

<template>
    <Head title="Mi Banca Digital | Scotiabank" />

    <div class="min-h-screen bg-[#F4F4F4] font-sans">
        <header class="bg-white border-b border-gray-200 px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-[#D11218] text-2xl font-black tracking-tighter">Scotiabank</h1>
                <HomeIcon class="h-6 w-6 text-[#D11218] cursor-pointer" />
            </div>

            <div class="flex items-center space-x-6">
                <div class="flex space-x-4 text-black">
                    <QuestionMarkCircleIcon class="h-6 w-6 cursor-pointer" />
                    <BellIcon class="h-6 w-6 cursor-pointer" />
                </div>
                <div class="flex items-center space-x-2 cursor-pointer group">
                    <UserCircleIcon class="h-8 w-8 text-gray-400 group-hover:text-black" />
                    <span class="text-sm font-medium">Mi cuenta</span>
                </div>
                <div class="h-6 w-px bg-gray-300"></div>
                <button @click="handleLogout" class="flex items-center space-x-2 text-gray-600 hover:text-black">
                    <ArrowRightOnRectangleIcon class="h-6 w-6" />
                    <span class="text-sm font-medium">Salir</span>
                </button>
            </div>
        </header>

        <main class="max-w-7xl mx-auto flex py-8 px-6 space-x-8">
            
            <aside class="w-1/4 space-y-6">
                <h2 class="text-xl font-bold text-gray-800">Mis productos</h2>
                
                <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-[#D11218] flex justify-between items-center group cursor-pointer">
                    <div>
                        <p class="text-sm font-bold text-gray-700">Cuenta Free</p>
                        <p class="text-lg font-black mt-1">
                            {{ showBalance ? `S/ ${props.account?.montosaldodisponible_ac || '0.00'}` : 'S/ ...' }}
                        </p>
                    </div>
                    <ChevronRightIcon class="h-5 w-5 text-gray-400 group-hover:text-[#D11218]" />
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm flex justify-between items-center group cursor-pointer">
                    <div class="flex items-center space-x-3">
                        <CreditCardIcon class="h-6 w-6 text-[#D11218]" />
                        <p class="text-sm font-bold text-gray-700">Mis tarjetas</p>
                    </div>
                    <ChevronRightIcon class="h-5 w-5 text-gray-400 group-hover:text-[#D11218]" />
                </div>

                <div class="flex flex-col space-y-2 pt-4">
                    <button @click="showBalance = !showBalance" class="flex items-center space-x-2 text-sm font-bold text-gray-600 hover:text-black">
                        <EyeIcon class="h-5 w-5" />
                        <span>{{ showBalance ? 'Ocultar' : 'Mostrar' }}</span>
                    </button>
                    <button class="flex items-center space-x-2 text-sm font-bold text-gray-600 hover:text-black">
                        <PencilSquareIcon class="h-5 w-5" />
                        <span>Editar</span>
                    </button>
                </div>
            </aside>

            <section class="flex-1 flex space-x-12">
                
                <div class="flex-1 space-y-6">
                    <h2 class="text-xl font-bold text-gray-800">Quiero</h2>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                        <div v-for="opcion in quieroOpciones" :key="opcion.name" 
                            class="flex justify-between items-center p-4 border-b border-gray-50 hover:bg-gray-50 cursor-pointer transition">
                            <div class="flex items-center space-x-3 text-gray-700">
                                <component :is="opcion.icon" class="h-5 w-5 text-gray-400" />
                                <span class="font-medium">{{ opcion.name }}</span>
                            </div>
                            <ChevronRightIcon class="h-4 w-4 text-[#D11218]" />
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 leading-snug">
                                Abre tu Depósito a Plazo a 90 días y recibe <span class="font-bold italic">hasta 6.10% de tasa (TREA)</span>
                            </p>
                            <div class="mt-4 flex space-x-4">
                                <button class="text-[#D11218] font-bold text-sm hover:underline">Me interesa</button>
                                <button class="text-gray-400 font-bold text-sm hover:underline">Ahora no</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1 space-y-6">
                    <h2 class="text-xl font-bold text-gray-800">Mi lista</h2>
                    <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 text-center">
                        <div class="mb-4 flex justify-center">
                            <div class="bg-blue-50 p-4 rounded-full text-blue-500 italic font-black text-xl">L</div>
                        </div>
                        <p class="font-bold text-gray-800 mb-2">Paga y transfiere más fácil y rápido</p>
                        <p class="text-xs text-gray-500 leading-relaxed mb-6">
                            Si guardas tus pagos y transferencias frecuentes en Mi Lista, podrás verlos y realizarlos desde aquí.
                        </p>
                        <button class="border-2 border-blue-500 text-blue-500 px-6 py-2 rounded-md font-bold hover:bg-blue-50 transition text-sm">
                            Ver Mi Lista
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>