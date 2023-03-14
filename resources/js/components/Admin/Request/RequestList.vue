<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Фильтр</h4>
            <request-filter :role_id="2" ></request-filter>
        </div>
        <div class="panel-body nopadding">
            <div class="table-responsive" v-if="getRequestList.length > 0">
                <table class="table mb30">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ФИО пользователя</th>
                        <th>Город</th>
                        <th>Телефон</th>
                        <th>email</th>
                        <th>Дата заявки</th>
                        <th v-if="$route.params.type !== 'kindergarten'">Назначенная группа заявок</th>
                        <th v-else>Эксперт</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="request in getRequestList">
                        <td>{{request.id}}</td>
                        <td>{{request.fio}}</td>
                        <td>{{request.city}}</td>
                        <td>{{request.phone}}</td>
                        <td>{{request.email}}</td>
                        <td>{{request.created_at}}</td>
                        <td v-if="$route.params.type !== 'kindergarten'">
                            <select class="form-control" v-model="request.group_request_id"
                                    v-if="getGroupListinExpert.length > 0" title="Назначенная группа заявок">
                                <option value=""></option>
                                <option v-for="group in getGroupListinExpert" :value="group.id">{{group.name}}</option>
                            </select>
                            <span v-else>В базе нет ни одной группы заявок с назначенным экспертом!</span>
                        </td>
                        <td v-else>
                            <select class="form-control" v-model="request.expert_id"
                                    v-if="getExpertList.length > 0" title="Эксперт">
                                <option value=""></option>
                                <option v-for="item in getExpertList" :value="item.id">{{item.name}}</option>
                            </select>
                            <span v-else>В базе нет ни одного эксперта!</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-success" v-else>
                <strong>В базе ещё пока нет заявок!</strong>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-primary mr5" @click="save()">Сохранить</button>
                    <button type="reset" class="btn btn-dark" @click="reset()">Отмена</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import RequestFilter from "./RequestFilter";

    export default {
        components: {RequestFilter},
        name: "request-list",
        computed: {
            ...mapGetters('appRequest', [
                'getRequestList',
                'getGroupListinExpert'
            ]),
            ...mapGetters('appExpert', [
                'getExpertList',
            ]),
        },
        methods:{
            ...mapActions('appRequest',[
                'loadRequestList',
                'saveRequest'
            ]),
            save(){
                this.saveRequest({
                    data: this.getRequestList,
                    updateType: 'assigned',
                    callback: alert('Данные обновлены!')
                })
            },
            reset(){
                this.loadRequestList({
                    level: this.$route.params.level,
                    type: this.$route.params.type
                });
            },
        },
    }
</script>

<style scoped>

</style>