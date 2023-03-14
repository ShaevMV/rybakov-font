<template>
    <div id="fourth_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <div class="four_overlay">
                <div class="four_overlay_block uk-flex uk-flex-middle uk-flex-between">
                    <div class="four_inner_block block_orange">
                        <div class="four_img four_img1"></div>
                        <h3> Провести внутреннюю оценку нокдо</h3>
                        <p>{{getData('nokgo')}}</p>
                    </div>
                    <div class="four_or"><span>   или</span></div>
                    <div class="four_inner_block block_green">
                        <div class="four_img four_img2"></div>
                        <h3> Провести внутреннюю оценку ecers</h3>
                        <p>{{getData('ecers')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';

    export default {
        name: "tools",
        mixins: [mixin],
    }
</script>

<style scoped>

</style>