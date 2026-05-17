<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showPassword = ref(false);

const showDocument = ref(false);

const form = useForm({
    document_type: 'DNI',
    document_number: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const documentTypes = [
    'DNI', 'RUC', 'Carné de Extranjería', 'Pasaporte', 
    'PTP', 'Cédula de Identidad', 'Carné de Identidad', 
    'Documento de Identidad', 'Partida de Nacimiento'
];
</script>

<template>
    <Head title="Banca por Internet - Scotiabank" />

    <div class="min-h-screen flex bg-white font-sans">
        <div class="w-full lg:w-[30%] p-8 md:p-16 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                
                <div class="mb-10">
                    <img 
                        src="/icons/scotiabank-no-bg.svg"
                        alt="Scotiabank"
                        class="h-12 w-auto"
                    />

                    <h2 class="text-3xl font-bold mt-9 text-gray-800">
                        Inicia sesión
                    </h2>
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-6">
                        <label class="block text-sm font-bold text-gray-700">Tipo de documento</label>
                        <select v-model="form.document_type" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D11218] focus:ring-[#D11218]">
                            <option v-for="type in documentTypes" :key="type" :value="type">{{ type }}</option>
                        </select>
                    </div>

                    <div class="mt-6 relative">
                        <label class="block text-sm font-bold text-gray-700">
                            Número de documento
                        </label>

                        <div class="relative">
                            <input 
                                :type="showDocument ? 'text' : 'password'"
                                v-model="form.document_number" 
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D11218] focus:ring-[#D11218]" 
                                placeholder="Ingresa tu documento" 
                            />

                            <button 
                                type="button" 
                                @click="showDocument = !showDocument"
                                class="absolute right-3 top-1/2 -translate-y-1/2 mt-0.5"
                            >
                                <img 
                                    :src="showDocument 
                                        ? '/icons/ojo-abierto.svg' 
                                        : '/icons/ojo-cerrado.svg'"
                                    alt="Mostrar documento"
                                    class="w-5 h-5 opacity-70 hover:opacity-100 transition"
                                />
                            </button>
                        </div>

                        <p 
                            v-if="form.errors.document_number" 
                            class="text-red-600 text-xs mt-1"
                        >
                            {{ form.errors.document_number }}
                        </p>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-bold text-gray-700">Contraseña</label>
                        <div class="relative">
                            <input 
                                :type="showPassword ? 'text' : 'password'" 
                                v-model="form.password" 
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D11218] focus:ring-[#D11218]" 
                                placeholder="Ingresa tu contraseña" 
                            />

                            <button 
                                type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2"
                            >
                                <img 
                                    :src="showPassword 
                                        ? '/icons/ojo-abierto.svg' 
                                        : '/icons/ojo-cerrado.svg'"
                                    alt="Mostrar contraseña"
                                    class="w-5 h-5 opacity-70 hover:opacity-100 transition"
                                />
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="text-red-600 text-xs mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center justify-between mt-9">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" v-model="form.remember"
                                class="rounded border-gray-400 text-[#D11218] focus:ring-[#D11218]" />
                            <span class="ml-2 text-sm text-gray-600 font-medium">Confiar</span>
                        </label>
                        <Link :href="route('password.request')" class="text-sm text-[#1990ff] font-bold hover:underline">
                            Recuperar contraseña
                        </Link>
                    </div>

                    <button type="submit" 
                        class="w-full mt-8 bg-[#D11218] text-white py-3 rounded-md font-bold text-lg hover:bg-red-700 transition duration-300 shadow-lg shadow-red-100"
                        :class="{ 'opacity-50 cursor-not-allowed': form.processing }" :disabled="form.processing">
                        Ingresar
                    </button>
                </form>

                <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                    <p class="text-gray-700 text-sm">
                        <span class="font-bold text-gray-700">
                            ¿Es tu primera vez aquí?
                        </span>

                        Empieza ahora a realizar tus operaciones.

                        <Link 
                            :href="route('register')" 
                            class="text-[#1990ff] font-bold ml-1 underline decoration-dotted underline-offset-4 hover:opacity-80"
                        >
                            Registrarse
                        </Link>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-[70%] relative overflow-hidden bg-[#F9F9F9] border-l border-gray-100 p-16">
            <img 
                src="/images/cuenta-digital.svg"
                alt="Cuenta Digital"
                class="absolute bottom-0 right-0 w-[500px] opacity-95 pointer-events-none select-none"
            />

            <div class="relative z-10 max-w-xl">

                <h3 class="text-4xl font-bold text-[#000] leading-tight">
                    Abre ahora tu nueva <br />
                    Cuenta Digital
                </h3>

                <div class="mt-8 space-y-6">
                    <div class="flex items-start gap-4">
                        <img 
                            src="/icons/moneda.svg" 
                            alt="Monedas"
                            class="w-8 h-8"
                        />
                        <p class="text-gray-600 leading-relaxed">
                            Sin costo de mantenimiento.
                        </p>
                    </div>

                    <div class="flex items-start gap-4">
                        <img 
                            src="/icons/smartphone.svg" 
                            alt="Transferencias"
                            class="w-8 h-8"
                        />
                        <p class="text-gray-600 leading-relaxed">
                            Transferencias interbancarias digitales gratis.
                        </p>
                    </div>

                    <div class="flex items-start gap-4">
                        <img 
                            src="/icons/deposito.svg" 
                            alt="Depósitos"
                            class="w-8 h-8"
                        />
                        <p class="text-gray-600 leading-relaxed">
                            Depósitos GRATIS e ilimitados en nuestras ventanillas y cajeros a nivel nacional.
                        </p>
                    </div>

                    <div class="flex items-start gap-4">
                        <img 
                            src="/icons/plin-yape.svg" 
                            alt="Plin y Yape"
                            class="w-8 h-8"
                        />
                        <p class="text-gray-600 leading-relaxed">
                            Cobra y paga de forma inmediata con usuarios PLIN o YAPE.
                        </p>
                    </div>

                </div>

                <button
                    class="mt-10 bg-white hover:bg-[#495057] text-black hover:text-white border border-gray-400 font-semibold px-8 py-3 rounded-3xl transition duration-300 shadow-md"
                >
                    Abrir cuenta
                </button>
            </div>
        </div>
    </div>
</template>