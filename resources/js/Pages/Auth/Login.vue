<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const showPassword = ref(false);

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
        <div class="w-full lg:w-[40%] p-8 md:p-16 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                
                <div class="mb-10">
                    <h1 class="text-[#D11218] text-4xl font-black tracking-tighter">Scotiabank<span class="text-gray-300">.</span></h1>
                    <h2 class="text-2xl font-bold mt-8 text-gray-800">Inicia sesión</h2>
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
                        <label class="block text-sm font-bold text-gray-700">Número de documento</label>
                        <input type="text" v-model="form.document_number" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D11218] focus:ring-[#D11218]" 
                            placeholder="Ingresa tu documento" />
                        <p v-if="form.errors.document_number" class="text-red-600 text-xs mt-1">{{ form.errors.document_number }}</p>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-bold text-gray-700">Contraseña</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" v-model="form.password" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D11218] focus:ring-[#D11218]" 
                                placeholder="Ingresa tu contraseña" />
                            <button type="button" @click="showPassword = !showPassword" 
                                class="absolute right-3 top-2 text-[10px] text-[#D11218] font-bold uppercase hover:underline">
                                {{ showPassword ? 'Ocultar' : 'Mostrar' }}
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="text-red-600 text-xs mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" v-model="form.remember" 
                                class="rounded border-gray-300 text-[#D11218] focus:ring-[#D11218]" />
                            <span class="ml-2 text-sm text-gray-600 font-medium">Confiar</span>
                        </label>
                        <Link :href="route('password.request')" class="text-sm text-[#D11218] font-bold hover:underline">
                            ¿Olvidaste tu contraseña?
                        </Link>
                    </div>

                    <button type="submit" 
                        class="w-full mt-8 bg-[#D11218] text-white py-3 rounded-md font-bold text-lg hover:bg-red-700 transition duration-300 shadow-lg shadow-red-100"
                        :class="{ 'opacity-50 cursor-not-allowed': form.processing }" :disabled="form.processing">
                        Ingresar
                    </button>
                </form>

                <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm">¿Es tu primera vez aquí? 
                        <Link :href="route('register')" class="text-[#D11218] font-bold hover:underline ml-1">Registrarse</Link>
                    </p>
                </div>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-[60%] bg-[#F9F9F9] border-l border-gray-100 items-center justify-center p-20">
            <div class="text-center max-w-sm">
                <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-6 flex items-center justify-center text-3xl">🚀</div>
                <h3 class="text-2xl font-bold text-gray-400 italic">Abre tu Cuenta Digital</h3>
                <p class="text-gray-400 mt-4 leading-relaxed">
                    Disfruta de los beneficios de ser parte del banco más digital del Perú. 
                    Próximamente verás aquí nuestras promociones.
                </p>
            </div>
        </div>
    </div>
</template>