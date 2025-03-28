<script setup>
import { ref, watch } from 'vue'
import { useDisplay } from 'vuetify'

const { mobile } = useDisplay()

const drawer = ref(true), rail = ref(true)

function navigationRail () {
    this.drawer = !this.drawer;
    this.rail = false;
}
</script>
<template>
    <v-layout>
        <v-navigation-drawer
            v-model="drawer"
            expand-on-hover
            :rail="rail"
        >
            <v-list>
                <v-list-item prepend-icon="mdi-account-circle">
                    {{ $page.props.admin.username }}
                </v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item href="/dashboard" prepend-icon="mdi-view-dashboard" title="Dashboard"></v-list-item>
                <v-list-item href="/products" prepend-icon="mdi-alpha-p-box" title="Products"></v-list-item>
                <v-list-item href="/create-product" prepend-icon="mdi-plus-box" title="Create"></v-list-item>
                <v-list-item href="/videos" prepend-icon="mdi-play-box" title="Videos"></v-list-item>
            </v-list>

            <template v-slot:append>
                <v-list density="compact" nav>
                    <v-list-item href="/logout" prepend-icon="mdi-logout" title="Logout"></v-list-item>
                </v-list>
            </template>
        </v-navigation-drawer>


        <v-app-bar color="primary">
            <v-app-bar-nav-icon variant="text" @click="rail = !rail" v-if="mobile === false"></v-app-bar-nav-icon>
            <v-app-bar-nav-icon variant="text" @click="navigationRail()" v-if="mobile"></v-app-bar-nav-icon>
            <v-btn variant="plain" href="/dashboard":ripple="false">Home</v-btn>
            <v-btn variant="plain" :ripple="false">About</v-btn>

            <v-spacer></v-spacer>
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <slot />
            </v-container>
        </v-main>
    </v-layout>
</template>