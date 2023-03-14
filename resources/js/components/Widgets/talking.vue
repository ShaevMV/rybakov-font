<template>
    <div id="sixth_part">
        <div class="container">
            <h2 class="title_landing"> {{title}}</h2>
            <div class="sixth_block">
                <div class="sixth_overlay uk-flex uk-flex-between">
                    <div class="sixth_part blue_back">
                        <h3>{{params[0]['title']}}</h3>
                        <div class="six_line"></div>
                        <p>{{params[0]['text']}}</p>
                    </div>
                    <div class="sixth_part green_back">
                        <h3>{{params[1]['title']}}</h3>
                        <div class="six_line"></div>
                        <p>{{params[1]['text']}}</p>
                    </div>
                    <div class="sixth_part orange_back">
                        <h3>{{params[2]['title']}}</h3>
                        <div class="six_line"></div>
                        <p>{{params[2]['text']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        name: "talking",

        mixins: [mixin],

    }
</script>

<style scoped>

</style>