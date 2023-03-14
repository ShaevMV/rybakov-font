<template>
    <div class="inner_section">
        <div class="container">
            <div class="expert_rating_block">
                <div class="expert_rating_table">
                    <div class="rating_table_header uk-flex">
                        <span class="header_list table_list0">Имя</span>
                        <span class="header_list table_list1">Телефон</span>
                        <span class="header_list table_list2">E-mail</span>
                        <span class="header_list table_list3">Экспертное заключение</span>
                    </div>
                    <div class="rating_table_body">
                        <div class="rating_table_row uk-flex"
                             v-if="getRequestList.length > 0"
                             v-for="item in getRequestList">
                            <div class="rating_table_data table_name table_list0"><span>{{item.fio}}</span></div>
                            <div class="rating_table_data table_phone table_list1"><span>{{item.phone}}</span></div>
                            <div class="rating_table_data table_email table_list2"><span :title="item.email">{{item.email}}</span></div>
                            <div class="rating_table_data table_test table_list3 complete">
                                <a class="table_link"
                                   @click="openUserAnswer(item.training_id)">
                                    Написать экспертное заключение
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <modal-expert-opinion :trainingId="selectTrainingId"></modal-expert-opinion>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import ModalExpertOpinion from "./ModalExpertOpinion";

    export default {
        components: {ModalExpertOpinion},
        name: "request-list-in-group",
        data(){
            return {
                groupData:{},
                requestsList:[],
                selectTrainingId: null,
            }
        },
        computed:{
            ...mapGetters('appRequest',[
                'getRequestList'
            ]),
        },
        methods:{
            ...mapActions('appRequest',[
                'updateGroupData',
            ]),
            ...mapActions('appExpert',[
                'openTestingForUser'
            ]),
            save(){
                this.updateGroupData({
                    groupId: this.$route.params.groupId,
                    data: this.groupData,
                    updateType: 'place'
                })
            },
            openUserAnswer(trainingId) {
                this.selectTrainingId = trainingId;
                UIkit.modal("#modalExpertOpinion").show();
            },
            getParamsData(index){
                let result = '';
                if( typeof this.groupData.date_of_meeting !== 'undefined'){
                    if(this.groupData.date_of_meeting !== null){
                        let temp = this.groupData.date_of_meeting.split(' ');
                        result = temp[index];
                    }
                }
                return result;
            },
            setParamsData(index,value){
                if( typeof this.groupData.date_of_meeting !== 'undefined') {
                    if (this.groupData.date_of_meeting !== null) {
                        let temp = this.groupData.date_of_meeting.split(' ');
                        temp[index] = value;
                        this.groupData.date_of_meeting = temp.join(' ');
                    } else if(index) {
                        this.groupData.date_of_meeting = ' ' + value
                    } else {
                        this.groupData.date_of_meeting = value + ' ';
                    }
                }
            }

        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appRequest/loadKindergartenRequest')// получить данные о группах заявок
                    .then(function (response) {
                        let tempData = response.data.groups;
                        vm.requestsList = _.cloneDeep(tempData);
                    });
            })

        },
    }
</script>

<style scoped>

</style>