<script setup>
import Layout from './Layout/Main.vue'
import { Head } from '@inertiajs/vue3'
defineOptions({ layout: Layout })
</script>
<template>
    <Head title="Videos" />
    <v-card title="Videos" subtitle="Bonus objective">
        <v-card-text>
            <v-container fluid class="d-flex justify-center"> 
                <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                width="1080"
                height="540"
                poster=""
                autoplay
                data-setup="{}"
                >
                    <source :src="$page.props.video_url || '/video_files/Sunflower.mp4'" type="video/mp4" />
                    <!-- videoFile?.video_url -->
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                        >
                    </p>
                </video>
                
            </v-container>
            <div class="d-flex justify-center">
                    <v-btn href="/videos/sunflower" class="mx-2">Sunflower</v-btn>
                    <v-btn href="/videos/kaiKaiKitai" class="mx-2">KaiKai Kitai</v-btn>
                    <v-btn href="/videos/everLastingShine" class="mx-2">Everlasting Shine</v-btn>
            </div>
        </v-card-text>
    </v-card>
</template>
