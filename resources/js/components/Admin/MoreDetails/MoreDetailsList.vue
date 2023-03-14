<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <h3>Данные для всплывающих окон «Подробнее» {{getDirectName($route.params.type)}}</h3>
            </div>

        </div>
        <hr>
        <table class="table table">
            <thead>
            <tr>
                <th style="width: 50px">#</th>
                <th>Уровень</th>
                <th>Наличие описание</th>
                <th style="width: 100px"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, idx) in getLevelsList" :key="idx">
                <td>{{item.more_details.id}}</td>
                <td>{{item.number}}</td>
                <td>{{getDetailsText(item.more_details)}}</td>
                <td>
                    <span class="glyphicon glyphicon-pencil" @click="setSelectMoreDetails(item.more_details)"></span>
                </td>
            </tr>
            </tbody>
        </table>
        <edit-more-detils
                v-if="isMoreDetails"
                :item="selectMoreDetails"
                @save="saveMoreDetails"></edit-more-detils>
    </div>

</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import EditMoreDetils from "./EditMoreDetils";

    export default {
        components: {EditMoreDetils},
        name: "more-details-list",
        data() {
            return {
                selectMoreDetails: {}
            };
        },
        computed: {
            ...mapGetters('appTraining', [
                'getLevelsList',
            ]),
            ...mapGetters([
                'getDirectName',
            ]),
            isMoreDetails() {
                return typeof this.selectMoreDetails.id !== 'undefined'
            }

        },
        methods: {
            ...mapActions('appTraining', [
                'updateMoreDetails',
                'loadDetailsList'
            ]),
            getDetailsText(item) {
                return item.text ? 'Информация заполнена' : '-';
            },
            setSelectMoreDetails(item) {
                this.selectMoreDetails = item;
            },
            saveMoreDetails() {
                let app = this;
                this.updateMoreDetails({
                    id: this.selectMoreDetails.id,
                    text: this.selectMoreDetails.text,
                    callback : function(){
                        app.loadDetailsList({
                            type: app.$route.params.type
                        });
                        app.selectMoreDetails = {};
                    }
                });


            }
        },
        beforeRouteUpdate (to, from, next) {
            store.dispatch('appTraining/loadDetailsList', {type: to.params.type});
            next();
        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appTraining/loadDetailsList', {type: to.params.type});
            next();
        },
    }
</script>

<style scoped>

</style>