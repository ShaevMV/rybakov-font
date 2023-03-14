<template>
    <div class="inner_section">
        <div class="container">
            <div class="expert_rating_block">
                <h1> Уведомления</h1>
                <div class="notif_overlay">
                    <div class="notif_kg uk-flex uk-flex-between uk-flex-middle" v-for="item in getNotifications">
                        <div class="left_notif">
                            <p class="uk-margin-remove" v-html="item.message"></p>
                        </div>
                        <div class="right_notif">
                            <span>{{item.updated_at}}</span>
                        </div>
                    </div>
                </div>
                <a class="close-button" href="/"></a>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from "../Testing/Pagination";
    import {mapGetters, mapActions} from 'vuex';

    export default {
        components: {Pagination},
        name: "notifications",
        data(){
            return {
                notificationsList:[]
            }
        },
        computed:{
            ...mapGetters('appNotification',[
                'getNotifications'
            ])
        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appNotification/loadNotification');
            next();

        },
    }
</script>

<style scoped>

</style>