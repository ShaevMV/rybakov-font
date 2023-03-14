<template>
    <div class="right_header uk-flex uk-flex-middle uk-flex-wrap">
        <div class="notif_overlay uk-flex">
            <router-link
                    class="notif_block"
                    to="/notifications">
                <span>{{getCountNotifications}}</span>
            </router-link>
        </div>
        <nav data-uk-navbar="mode: click">
            <ul class="uk-navbar-nav">
                <li>
                    <a class="right_part__main_link" href="#">{{getUserEmail}}</a>
                    <div class="uk-navbar-dropdown link_block" id="userNav">
                        <ul class="uk-margin-remove">
                            <router-link tag="li" to="/lk" uk-toggle="target: #userNav">
                                <a>
                                    Личный кабинет
                                </a>
                            </router-link>
                            <li uk-toggle="target: #userNav"
                                v-if="isAdmin">
                                <a href="/admin">
                                    Панель администратора
                                </a>
                            </li>
                            <li>
                                <a href="#" @click="logOut()">Выйти</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "user-data",
        computed: {
            ...mapGetters([
                'getUserEmail',
                'isAdmin'
            ]),
            ...mapGetters('appNotification',[
                'getCountNotifications'
            ])
        },
        methods:{
            ...mapActions('appLogin',[
                'logOut'
            ])
        },

    }
</script>

<style scoped>

</style>