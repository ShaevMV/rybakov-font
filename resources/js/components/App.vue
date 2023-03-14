<template>
    <div>
        <header-site v-if="show"></header-site>
        <router-view></router-view>
        <footer-site v-if="show"></footer-site>
        <auth v-if="!isAuthenticated"></auth>

        <modal-end-lesson></modal-end-lesson>
        <modal-request-after-test></modal-request-after-test>
        <modal-after-register></modal-after-register>

    </div>
</template>
<script>

    import HeaderSite from "./Header/Header";
    import FooterSite from "./Header/FooterSite";
    import {mapState, mapGetters, mapActions} from 'vuex';
    import ModalEndLesson from "./Lesson/ModalEndLesson";
    import ModalRequestAfterTest from "./Testing/ModalRequestAfterTest";
    import ModalCompleted from "./ModalCompleted";
    import ModalAfterRegister from "./Auth/modalAfterRegister";

    export default {
        components: {
            ModalAfterRegister,
            ModalCompleted,
            ModalRequestAfterTest,
            ModalEndLesson,
            FooterSite,
            HeaderSite
        },
        name: 'app',
        computed: {
            ...mapGetters('appLogin',[
                'isAuthenticated'
            ]),
            show() {
                return this.$route.name !== 'pageLesson';
            }
        },

    }
</script>
