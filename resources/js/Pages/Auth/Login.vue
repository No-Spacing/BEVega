<script setup>
import { useForm, usePage } from '@inertiajs/vue3'

import { Link } from '@inertiajs/vue3'
import { reactive } from 'vue'

const variables = reactive({
    snackbar: true
})

const page = usePage();

const form = useForm({
    _token: page.props.csrf_token,
    username: null,
    password: null,
    remember: false,
})
</script>

<template>
<v-app>
    <v-container class="fill-height">
        <v-row class="d-flex justify-center align-center fill-height" >
            <v-col cols="12" sm="4">
                <v-card :loading="form.processing">

                    <v-card-title>Login</v-card-title>
                    <v-card-subtitle>Login Form</v-card-subtitle>

                    <form @submit.prevent="form.post('/PostLogin')">
                        <v-card-text>
                            <v-alert
                            v-if="$page.props.flash.message"
                            type="warning"
                            class="mb-4"
                            >
                                {{ $page.props.flash.message }}
                            </v-alert>

                            <v-text-field
                            v-model="form.username"
                            :error-messages="form.errors.username"
                            label="Username"
                            ></v-text-field>

                            <v-text-field
                            v-model="form.password"
                            :error-messages="form.errors.password"
                            label="Password"
                            type="password"
                            ></v-text-field>
                            <Link class="d-flex justify-end" href="/register">Register</Link>
                            <v-checkbox
                            v-model="form.remember"
                            label="Remember Me"
                            type="checkbox"
                            ></v-checkbox>
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
                            Login
                            </v-btn>
                        </v-card-actions>
                    </form>

                    </v-card>
            </v-col>
        </v-row>
    </v-container>
</v-app>
    <v-snackbar
    v-model="$page.props.flash.snackbar"
    color="success"
    vertical
    top
    location="top"
    >
        <div class="text-subtitle-1 pb-2">Success</div>
        Successfully Registered

        <template v-slot:actions>
            <v-btn
                variant="text"
                @click="$page.props.flash.snackbar = false"
            >
                Close
            </v-btn>
      </template>
    </v-snackbar>
</template>
