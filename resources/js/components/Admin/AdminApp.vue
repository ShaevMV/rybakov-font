<template>
    <div>
        <span v-if="isAuthenticated && isAdmin(getUser)">
            <header-app/>
            <section>
                <div class="mainwrapper">
                    <left-panel/>
                    <div class="mainpanel">
                        <div class="contentpanel">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </section>
        </span>
        <auth-admin v-else/>
    </div>

</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import HeaderApp from "./HeaderApp";
    import LeftPanel from "./LeftPanel";
    import PageHeader from "./PageHeader";
    import AuthAdmin from "./Auth/AuthAdmin";

    export default {
        data() {
            return {
                roles: {}
            }
        },
        components: {
            AuthAdmin,
            PageHeader,
            HeaderApp, LeftPanel
        },
        name: "admin-app",
        computed: {
            ...mapGetters([
                'isAuthenticated',
                'getUser'
            ]),
        },
        methods: {
            /**
             * Проверка на админа
             *
             * @param user
             * @return {boolean}
             */
            isAdmin(user) {
                if (typeof user.role_id !== 'undefined') {
                    if (user.role_id === 1) {
                        $('.pace-done').removeClass('signin');
                        return true;
                    }
                }
                return false;
            }
        },

    }
</script>

<style scoped>

</style>