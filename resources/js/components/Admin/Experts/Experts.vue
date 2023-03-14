<template>
    <div class="col-md-12">
        <h5 class="lg-title mb5">Список экспертов</h5>
        <p class="mb20">Описание таблицы</p>
        <div class="table-responsive">
            <table class="table mb30">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ФИО эксперта</th>
                        <th>Логин</th>
                        <th>Телефон</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="expert in getExpertList">
                        <td>{{expert.id}}</td>
                        <td>{{expert.name}}</td>
                        <td>{{expert.email}}</td>
                        <td>{{expert.phone}}</td>
                        <td><a @click="deleteUser(expert.id)"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <add-expert></add-expert>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import AddExpert from "./AddExpert";

    export default {

        components: {AddExpert},
        name: "experts",
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appExpert/loadExpertsList');
            next();
        },
        data(){
            return {
                editExpert: {}
            }
        },
        computed: {
            ...mapGetters('appExpert',[
                'getExpertList'
            ]),
        },
        methods: {
            ...mapActions('appExpert',[
                 'deleteUser'
            ]),
            /**
             * Вывести имя пользователя
             *
             * @param expert
             * @return {string}
             */
            getUserName(expert){
                let userName = '';
                if(expert.users) {
                    userName = expert.users.id +'/'+ expert.users.name
                }
                return userName;
            },
            edit(expert){
                this.editExpert = expert;
            }
        },
    }
</script>

<style scoped>

</style>