<template>
    <div id="fifth_part">
        <div class="container">
            <h2 class="title_landing"> {{title}}</h2>
            <div class="fifth_block">
                <div class="fifth_overlay uk-flex uk-flex-between">
                    <div class="fifth_img" v-for="item in params">
                        <img :src="item.image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';

    export default {
        name: "sponsor",
        mixins: [mixin],
    }
</script>

<style scoped>

</style>