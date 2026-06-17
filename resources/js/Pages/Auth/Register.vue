<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const currentStep = ref(1);
const generatedToken = ref('123456'); // Token simulado
const userTokenInput = ref('');
const showCardError = ref(false);

const form = useForm({
    document_type: 'DNI',
    document_number: '',
    email: '',
    card_number: '',
    pin: '',
    password: '',
    password_confirmation: '',
});

const documentTypes = ['DNI', 'RUC', 'Carné de Extranjería', 'Pasaporte'];

// Lógica para avanzar pasos
const nextStep = async () => {
    if (currentStep.value === 1) {
        try {
            // Quitamos espacios del número de tarjeta antes de enviar
            const cleanCardNumber = form.card_number.replace(/\s+/g, '');
            
            const response = await axios.post('/validate-card', {
                document_number: form.document_number,
                card_number: cleanCardNumber,
                pin: form.pin
            });

            if (response.data.valid) {
                currentStep.value = 2; // Avanza al token
                showCardError.value = false;
            }
        } catch (error) {
            // Si Laravel devuelve 401 o hay error, mostramos el mensaje
            showCardError.value = true;
        }
    } else if (currentStep.value === 2) {
        // Validación del token (esta sí puede ser simulada o fija)
        if (userTokenInput.value === '123456') {
            currentStep.value = 3;
        } else {
            alert("Token incorrecto");
        }
    }
};

const submitFinal = () => {
    // Usamos transform para enviar solo lo necesario en el paso final
    form.transform((data) => ({
        ...data,
        document_number: form.document_number, // Enviamos el DNI para saber a quién actualizar
    })).put(route('user.activate'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            alert("¡Clave Digital creada con éxito! Ahora puedes iniciar sesión.");
        }
    });
};
</script>

<template>
    <Head title="Activación de Clave Digital" />
    <div class="min-h-screen bg-[#F4F4F4] font-sans">
        
        <header class="bg-white border-b p-4">
            <div class="max-w-5xl mx-auto flex justify-between items-center">
                <h1 class="text-[#D11218] text-2xl font-black">Scotiabank<span class="text-gray-300">.</span></h1>
                <span class="text-sm font-bold text-gray-500">Paso {{ currentStep }} de 3</span>
            </div>
        </header>

        <main class="max-w-xl mx-auto mt-12 p-6">
            <div class="bg-white rounded-lg shadow-lg p-8">
                
                <div v-if="currentStep === 1">
                    <h2 class="text-2xl font-bold mb-6">Empecemos por identificarte</h2>
                    <div class="space-y-4">
                        <label class="block text-sm font-bold">Tipo de documento</label>
                        <select v-model="form.document_type" class="w-full border-gray-300 rounded-md">
                            <option v-for="t in documentTypes" :value="t">{{ t }}</option>
                        </select>

                        <label class="block text-sm font-bold">Número de documento</label>
                        <input v-model="form.document_number" type="text" class="w-full border-gray-300 rounded-md" placeholder="12345678">

                        <label class="block text-sm font-bold">Correo electrónico</label>
                        <input v-model="form.email" type="email" class="w-full border-gray-300 rounded-md" placeholder="tu correo">

                        <label class="block text-sm font-bold">Número de tarjeta</label>
                        <input v-model="form.card_number" type="text" class="w-full border-gray-300 rounded-md" placeholder="XXXX XXXX XXXX XXXX">

                        <label class="block text-sm font-bold">PIN de cajero (4 dígitos)</label>
                        <input v-model="form.pin" type="password" maxlength="4" class="w-full border-gray-300 rounded-md text-center tracking-widest">
                    </div>
                    
                    <div v-if="showCardError" class="mt-4 text-red-600 text-sm bg-red-50 p-2 rounded">
                        Datos no encontrados. (Prueba DNI: 12345678, PIN: 1234)
                    </div>
                </div>

                <div v-if="currentStep === 2" class="text-center">
                    <div class="mb-6 text-5xl">📱</div>
                    <h2 class="text-2xl font-bold mb-2">Valida tu identidad</h2>
                    <p class="text-gray-600 mb-6">Ingresa el código de 6 dígitos que enviamos a tu celular.</p>
                    
                    <input v-model="userTokenInput" type="text" maxlength="6" 
                        class="text-3xl text-center w-full tracking-[0.5em] border-b-2 border-red-500 border-t-0 border-l-0 border-r-0 focus:ring-0" 
                        placeholder="000000">
                    
                    <p class="mt-6 text-sm text-gray-500 italic">Tip: El código de prueba es 123456</p>
                </div>

                <div v-if="currentStep === 3">
                    <h2 class="text-2xl font-bold mb-2">Crea tu Clave Digital</h2>
                    <p class="text-gray-600 mb-6">Esta clave te servirá para entrar a tu banca por internet.</p>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold">Nueva Clave (6 dígitos)</label>
                            <input v-model="form.password" type="password" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-bold">Confirma tu Clave</label>
                            <input v-model="form.password_confirmation" type="password" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex justify-between border-t pt-6">
                    <button @click="currentStep--" v-if="currentStep > 1" class="text-gray-600 font-bold">Atrás</button>
                    <div v-else></div>

                    <button v-if="currentStep < 3" @click="nextStep" class="bg-[#D11218] text-white px-8 py-3 rounded font-bold">
                        Continuar
                    </button>
                    <button v-else @click="submitFinal" class="bg-[#D11218] text-white px-8 py-3 rounded font-bold">
                        Finalizar Activación
                    </button>
                </div>

            </div>
        </main>
    </div>
</template>