<template>
    <div class="inner_section">
        <div class="container">
            <div class="expert_rating_block">
                <h1> {{groupData.name}}.</h1>


                <div class="uk-flex uk-flex-between  expert-filter">
                    <div class="expert-filter__input">
                        <label for="group_name">Название группы</label>
                        <input id="group_name" type="text" v-model="groupData.name" placeholder="название группы">
                    </div>
                    <div class="expert-filter__input">
                        <label for="group_date">Дата проведения</label>
                        <date-picker v-model="groupData.date_of_meeting"
                                     class="uk-display-block"
                                     valueType="format"
                                     id="group_date"
                                     lang="ru"
                                     type="datetime"
                                     format="YYYY-MM-DD hh:mm:ss"
                                     :minute-step="10">
                        </date-picker>
                    </div>
                    <div class="expert-filter__input">
                        <label for="group_place">Место проведения</label>
                        <input id="group_place" type="text" v-model="groupData.place" placeholder="место проведения">
                    </div>
                    <div class="expert-filter__input uk-flex uk-flex-column uk-flex-right">
                        <button class="button_continue button_medium" @click="save()" type="button"> сохранить</button>
                    </div>

                </div>

                <div class="expert_rating_table">
                    <div class="rating_table_header uk-flex">
                        <span class="header_list table_list0">Имя</span>
                        <span class="header_list table_list1">Телефон</span>
                        <span class="header_list table_list2">E-mail</span>
                        <span class="header_list table_list3">Тест</span>
                        <span class="header_list table_list4">Действие</span>
                    </div>
                    <div class="rating_table_body">
                        <div class="rating_table_row uk-flex"
                             v-if="requestsList.length > 0"
                             v-for="item in requestsList">
                            <div class="rating_table_data table_name table_list0"><span>{{item.fio}}</span></div>
                            <div class="rating_table_data table_phone table_list1"><span>{{item.phone}}</span></div>
                            <div class="rating_table_data table_email table_list2"><span :title="item.email">{{item.email}}</span></div>
                            <div class="rating_table_data table_test table_list3"
                                 v-bind:class="{complete: item.passed}">
                                <a class="table_link" @click="openUserAnswer(item.training_id)">
                                    Просмотреть тест
                                </a>
                                <span>Еще не пройден</span>
                            </div>
                            <div class="rating_table_data table_mark table_list3 exist_and_eval uk-text-right">
                                <a class="table_link"
                                   @click="openTestingForUser({
                                        request: item,
                                        updateType: 'access'
                                   })"
                                   v-if="!item.check">Открыть доступ</a>
                                <span v-else>Доступ открыт</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import DatePicker from 'vue2-datepicker'

    export default {
        name: "request-list-in-group",
        components: {DatePicker},
        data() {
            return {
                groupData: {},
                requestsList: [],
            }
        },
        computed: {
            ...mapGetters('appRequest', [
                'getRequestList'
            ]),
        },
        methods: {
            ...mapActions('appRequest', [
                'updateGroupData',
            ]),
            ...mapActions('appExpert', [
                'openTestingForUser'
            ]),
            save() {
                this.updateGroupData({
                    groupId: this.$route.params.groupId,
                    data: this.groupData,
                    updateType: 'place'
                })
            },
            openUserAnswer(trainingId) {
                this.$router.push({name: 'viewUserAnswer', params: {training: trainingId}});
            },
            getParamsData(index) {
                let result = '';
                if (typeof this.groupData.date_of_meeting !== 'undefined') {
                    if (this.groupData.date_of_meeting !== null) {
                        let temp = this.groupData.date_of_meeting.split(' ');
                        result = temp[index];
                    }
                }
                return result;
            },
            setParamsData(index, value) {
                if (typeof this.groupData.date_of_meeting !== 'undefined') {
                    if (this.groupData.date_of_meeting !== null) {
                        let temp = this.groupData.date_of_meeting.split(' ');
                        temp[index] = value;
                        this.groupData.date_of_meeting = temp.join(' ');
                    } else if (index) {
                        this.groupData.date_of_meeting = ' ' + value
                    } else {
                        this.groupData.date_of_meeting = value + ' ';
                    }
                }
            }
        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appRequest/loadGroupRequest', {groupId: to.params.groupId})// получить данные о группах заявок
                    .then(function (response) {
                        let tempData = response.data[0];
                        vm.groupData = _.cloneDeep(tempData);
                        delete vm.groupData.requests;
                        vm.requestsList = tempData.requests;
                    });
            })

        },
    }
</script>

<style scoped>

</style>