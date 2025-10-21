<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="mb-3">
                                <Label name="name">User name</Label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    v-model="auth.name"
                                    name="name"
                                    placeholder="Enter your user name"
                                    :class="{ 'is-invalid': errors &&  errors.name}"
                                    required
                                />
                            </div>

                            <div class="mb-3">
                                <Label name="password">Password</Label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    v-model="auth.password"
                                    name="password"
                                    placeholder="Enter your password"
                                    :class="{ 'is-invalid':  errors && errors.password }"
                                    required
                                />
                            </div>

                            <div class="d-flex gap-3 mb-3">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="isSubmitting"
                                >
                                    {{ isSubmitting ? 'Logging in...' : 'Login' }}
                                </button>

                            </div>

                            <div v-if="errors && errors.auth" class="text-danger fw-bold">
                                Something is wrong...
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Label from "@/Components/Forms/Label.vue";

const router = useRouter();
const store = useStore();

// Form state
const auth = ref({
    email: '',
    password: '',
});

const isSubmitting = ref(false);

const errors = computed(() => store.getters['auth/errors']);

const errorsAuth = ref(false);

onMounted(async () => {
    await store.dispatch('auth/clearErrors');
});

const actionsAfterLogin = async () => {
    await router.push('/');
};

const login = async () => {
    errorsAuth.value = false;
    isSubmitting.value = true;
    try {
        await axios.get('/sanctum/csrf-cookie');
        await store.dispatch('auth/login', auth.value);
        if (Object.keys(errors.value).length === 0) {
            await actionsAfterLogin();
        }
    } catch (error) {
        console.error('Login failed:', error);
        errorsAuth.value = true;
    } finally {
        isSubmitting.value = false;
    }
};
</script>
