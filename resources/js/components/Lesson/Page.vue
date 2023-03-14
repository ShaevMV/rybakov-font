<template>
    <div>
        <div class="education">
            <list-lesson :type="type"></list-lesson>
            <content-lesson></content-lesson>

            <span class="mob_menu" id="ham_button" uk-toggle="target: #main_menu; cls: active;">
                            <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                            </svg><!-- <i class="fas fa-bars"></i> -->
                        </span>

            <a class="grey-close-overlay" @click="$router.push('/training/'+type)">
            <span class="grey-close-button uk-icon" uk-icon="icon: close; ratio: 1">
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="close">
                    <path fill="none" stroke="#000" stroke-width="1.06" d="M16,16 L4,4"></path>
                    <path fill="none" stroke="#000" stroke-width="1.06" d="M16,4 L4,16"></path>
                </svg>
            </span>
            </a>
        </div>
        <navigator></navigator>

        <modal-error-lesson></modal-error-lesson>
    </div>

</template>


<script>
    import ListLesson from "./ListLesson";
    import ContentLesson from "./ContentLesson";
    import {mapState, mapGetters, mapActions} from 'vuex';
    import Navigator from "./Navigator";
    import ModalEndLesson from "./ModalEndLesson";
    import ModalErrorLesson from "./QuestionsForTask/ModalErrorLesson";

    export default {
        components: {
            ModalErrorLesson,
            ModalEndLesson,
            Navigator,
            ContentLesson,
            ListLesson
        },
        name: "page",
        props: ['type'],
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                $('html, body').animate(
                    {scrollTop: $("body").offset().top},
                    800
                );
                store.dispatch('appLesson/loadLesson', {type: to.params.type});
                //store.dispatch('appLesson/getNameDirection', {type: to.params.type});
                store.dispatch('appLesson/selectEnd');

            })

        },
        methods: {
            ...mapActions([
                'setTypeDirection',
            ])
        },
        mounted() {
            this.setTypeDirection(this.type);
        }

    }
</script>

<style scoped>

</style>