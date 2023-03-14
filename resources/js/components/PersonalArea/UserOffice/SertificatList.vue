<template>
    <div class="acc_badges">
        <div class="kg_acc_header_block" v-if="getListCertificats.length > 0">
            <h2 class="uk-text-left uk-text-uppercase font-26 uk-margin-remove uk-text-left">
                Сертификаты</h2>
            <div class="cert_slider">
                <div uk-slider="" class="uk-slider">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container uk-light user_slider">
                            <ul class="uk-child-width-1-3@xl uk-child-width-1-3@l uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-1@xs uk-slider-items uk-child-width-1-1 uk-slider-items uk-grid"
                                style="transform: translateX(0px);">
                                <li v-for="(item,index) in getListCertificats "
                                        v-bind:class="{'uk-active':index<3}">
                                    <a :href="item.pdf" download>
                                        <div class="slider_img uk-text-center">
                                            <img src="/images/certificateImage.jpg" alt="">
                                        </div>
                                        <div class="slider_desc">
                                            <p>{{item.title}}</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-light"><a
                                class="uk-position-center-left uk-position-small slider_left"
                                href="#" uk-slider-item="previous"></a><a
                                class="uk-position-center-right uk-position-small slider_right"
                                href="#" uk-slider-item="next"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "sertificat-list",
        computed: {
            ...mapGetters('appTraining',[
                'getListCertificats',
            ])
        },
    }
</script>

<style scoped>

</style>
