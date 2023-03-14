<template>
    <div id="eight_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <div class="cert_slider">
                <div class="user_slider_expert_block uk-slider" uk-slider="">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container uk-light user_slider user_slider_expert">
                            <ul class="uk-child-width-1-7@xl uk-child-width-1-7@l uk-child-width-1-6@m uk-child-width-1-6@s uk-child-width-1-2 uk-slider-items uk-child-width-1-1 uk-slider-items uk-grid slider_ul"
                                style="transform: translateX(0px);">
                                <li v-for="(expert, index) in params" v-bind:class="{'uk-active':index < 6 }">
                                    <div class="slider_img" @click="selectExpert(expert)">
                                        <img :src="expert.image" alt="" ></div>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-light"><a class="uk-position-center-left uk-position-small slider_left_new"
                                                 href="#" uk-slider-item="previous"></a><a
                                class="uk-position-center-right uk-position-small slider_right_new" href="#"
                                uk-slider-item="next"></a></div>
                    </div>
                </div>
                <div class="expert_description">
                    <div class="expert_block visible">
                        <div class="expert_left"><img :src="select.image"></div>
                        <div class="expert_right">
                            <h3>{{select.name}}</h3>
                            <span v-html="select.text"></span>
                        </div>
                    </div>
                </div>
            </div>
            <router-link
                    class="button_continue button_mark"
                    to="/lk">
                Заказать оценку качества
            </router-link>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    import _ from 'lodash';
    export default {
        name: "experts",
        mixins: [mixin],
        data() {
            return {
                select: {}
            }
        },
        methods: {
            /**
             * Выбрать эксперта
             *
             * @param expert
             */
            selectExpert: function (expert) {
                this.select = expert;
                this.clearExpert();
                //expert['opacity'] = 1;
            },
            clearExpert: function () {
                let app = this;
                /*this.item.forEach(function (expert, index) {
                    app.item[index]['opacity'] = 0.8;
                });*/
            },

        },
        mounted() {
            let experts = this.params;
            this.selectExpert(experts[0]);
        }
    }
</script>

<style scoped>

</style>