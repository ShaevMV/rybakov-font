<template>
    <component :is="officeType"></component>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import UserOffice from "./UserOffice/UserOffice";
    import ExpertOffice from "./ExpertOffice";
    import KGOffice from "./Kindergarten/KGOffice";

    export default {
        components: {
            UserOffice,
            ExpertOffice,
            KGOffice
        },
        name: "cabinet",
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('initDataUser'); // получить данные о пользователе
            store.dispatch('appTraining/loadCertificate'); // получить данные о сертификатах
            store.dispatch('appTraining/getAvailableLevelAll'); // получить данные о доступных уровнях
            store.dispatch('appRequest/loadKindergartenRequest');
            next();
        },
        computed: {
            ...mapGetters([
                'getRole',
            ]),
            officeType() {
                if(this.getRole === 2 || this.getRole === 1) return 'UserOffice';
                if(this.getRole === 3) return 'KGOffice';
                if(this.getRole === 4) return 'ExpertOffice';
            }
        },
    }
</script>

<style scoped>

</style>