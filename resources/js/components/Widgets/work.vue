<template>
    <div id="third_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <p class="th_desc">{{getData('description')}}</p>
            <div class="third_blocks uk-flex uk-flex-between uk-flex-middle">
                <div class="th_white_block">
                    <div class="th_white_img th_white_img1"></div>
                    <p>{{getData('level1')}}</p>
                </div>
                <div class="th_arrow"></div>
                <div class="th_white_block">
                    <div class="th_white_img th_white_img2"></div>
                    <p>{{getData('level2')}}</p>
                </div>
                <div class="th_arrow"></div>
                <div class="th_white_block">
                    <div class="th_white_img th_white_img3"></div>
                    <p>{{getData('level3')}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';

    export default {
        name: "work",
        mixins: [mixin],
    }
</script>

<style scoped>

</style>