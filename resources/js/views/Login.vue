<template>
    <section class="login-form min-h-screen flex items-center justify-center bg-img"
        :style="{ backgroundImage: `url('/assets/image/bbblurry.svg')` }">
        <div class="container mx-auto">
            <div class="flex justify-center px-6 my-12">
                <div class="w-96 flex">
                    <div class="w-full bg-login p-6 rounded-lg">

                        <div class="pt-10 text-center">
                            <img src="https://i.pinimg.com/originals/0a/5f/ea/0a5feae400fc816c4ca2aca8bd67a168.jpg"
                                class="rounded-full m-auto p-1 border" width="100" />

                            <h3 class="pt-8 font-bold text-4xl text-white">
                                {{ loginType === 'admin' ? 'Admin Login' : 'Seller Login' }}
                            </h3>
                        </div>

                        <form class="pt-8" @submit.prevent="login">
                            <input v-model="email" type="email" placeholder="Email"
                                class="w-full mb-4 px-3 py-3 text-sm text-gray-50 bg-[#ffffff1a] rounded" />

                            <input v-model="password" type="password" placeholder="Password"
                                class="w-full mb-6 px-3 py-3 text-sm text-gray-50 bg-[#ffffff1a] rounded" />

                            <button class="w-full px-4 py-3 font-bold tracking-wider text-black bg-white rounded-lg">
                                Login
                            </button>

                            <!-- SWITCH LINK -->
                            <p class="text-center mt-4 text-sm text-white">
                                <span v-if="loginType === 'admin'">
                                    Login as
                                    <a href="#" @click.prevent="switchLogin('seller')" class="underline font-semibold">
                                        Seller
                                    </a>
                                    ?
                                </span>

                                <span v-else>
                                    Login as
                                    <a href="#" @click.prevent="switchLogin('admin')" class="underline font-semibold">
                                        Admin
                                    </a>
                                    ?
                                </span>
                            </p>

                            <p v-if="error" class="text-red-400 text-center mt-4">
                                {{ error }}
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api, { setToken } from '../services/api';

const router = useRouter();

const email = ref('');
const password = ref('');
const error = ref('');
const loginType = ref('admin');

const switchLogin = (type) => {
    loginType.value = type;
    error.value = '';
};

const login = async () => {
    error.value = '';

    try {
        const endpoint =
            loginType.value === 'admin'
                ? '/admin/login'
                : '/seller/login';

        const res = await api.post(endpoint, {
            email: email.value,
            password: password.value,
        });

        setToken(res.data.token);
        router.push('/list');
    } catch (e) {
        error.value = 'Invalid email or password';
    }
};
</script>
