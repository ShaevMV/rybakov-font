<template>
    <div id="seventh_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <div class="video_overlay uk-flex uk-flex-middle uk-flex-center">
                <iframe :src="'https://www.youtube-nocookie.com/embed/'+getData('video')+'?autoplay=0'" width="100%" height="550" frameborder="0" allowfullscreen data-uk-responsive data-uk-video autoplay="false">
                </iframe>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        name: "you-tube",
        mixins: [mixin],
    }
</script>

<style scoped>

</style>