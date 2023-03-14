<template>
    <div>
        <div class="panel-body nopadding">
            <div class="table-responsive" v-if="getGroupList.length > 0">
                <table class="table mb30">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название группы</th>
                        <th>Назначенный эксперт</th>
                        <th>Кол-во участников</th>
                        <th>Дата проведения занятия</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="request in getGroupList">
                        <td>{{request.id}}</td>
                        <td><input type="text"
                                   v-model="request.name"
                                   class="form-control"
                                   placeholder="Введите название для группы заявок">
                        </td>
                        <td>
                            <select class="form-control" v-model="request.expert_id"
                                    v-if="getExpertList.length > 0" title="Назначенный эксперт">
                                <option value=""></option>
                                <option v-for="expert in getExpertList" :value="expert.id">{{expert.name}}</option>
                            </select>
                            <span v-else>В базе нет ни одного эксперта!</span>
                        </td>
                        <td>{{request.requests_count}}</td>
                        <td>{{request.date_of_meeting === null ? '-' : request.date_of_meeting}}</td>
                        <td><span @click="deleteGroup(request.id)" class="glyphicon glyphicon-trash"></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-success" v-else>
                <strong>В базе ещё пока нет групп для заявок!</strong>
            </div>
            <request-group-new></request-group-new>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-primary mr5" @click="saveGroupRequest(getGroupList)">Сохранить
                    </button>
                    <button type="reset" class="btn btn-dark" @click="reset()">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import RequestGroupNew from "./RequestGroupNew";

    export default {
        components: {RequestGroupNew},
        name: "request-group",
        methods: {
            ...mapActions('appRequest', [
                'updateGroupData',
                'loadGroupList',
                'deleteGroupRequest'
            ]),
            saveGroupRequest(data) {
                this.updateGroupData({
                    data: data,
                    updateType: 'assigned'
                })
            },
            deleteGroup(id){
               this.deleteGroupRequest({
                   id: id,
                   callback: this.reset
               })
            },
            reset() {
                this.loadGroupList({
                    level: this.$route.params.level,
                    type: this.$route.params.type
                })
            }
        },
        computed: {
            ...mapGetters('appExpert', [
                'getExpertList',
            ]),
            ...mapGetters('appRequest', [
                'getGroupList'
            ])
        }
    }
</script>

<style scoped>

</style>