<script setup>
import { reactive } from 'vue'
import { useForm, usePage, Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const page = usePage();

const form = useForm ({
    _token: page.props.csrf_token,
    name: null,
    email: null,  
    password: null,
    password_confirmation: null,
    
})

</script>
<template>
<Head title="Register" />
<v-app>
    <v-container fluid class="fill-height">
        <v-row class="d-flex justify-center align-center" >
            <v-col cols="12" sm="4" class="fill-height">
                <v-card :loading="form.processing">

                    <v-card-title>Register</v-card-title>
                    <v-card-subtitle>Register Form</v-card-subtitle>

                        <v-form @submit.prevent="form.post('/PostUser')">
                            <v-card-text>

                                <v-text-field
                                v-model="form.name"
                                :error-messages="form.errors.name"
                                label="Name"
                                ></v-text-field>

                                <v-text-field
                                v-model="form.email"
                                :error-messages="form.errors.email"
                                label="Email"
                                ></v-text-field>

                                <v-text-field
                                v-model="form.password"
                                :error-messages="form.errors.password"
                                label="Password"
                                type="password"
                                ></v-text-field>

                                <v-text-field
                                v-model="form.password_confirmation"
                                :error-messages="form.errors.password"
                                label="Re-Type Password"
                                type="password"
                                ></v-text-field>
                                <Link class="d-flex justify-end" href="/login">Login</Link>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-btn
                                class="me-4"
                                type="submit"
                                :loading="form.processing"
                                block
                                variant="tonal"
                                >
                                    Register
                                </v-btn>
                            </v-card-actions>
                        </v-form>

                    </v-card>
            </v-col>
        </v-row>
    </v-container>  
</v-app>
</template>