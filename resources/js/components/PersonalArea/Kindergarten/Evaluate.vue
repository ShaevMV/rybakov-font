<template>
    <div class="right_kg">
        <div class="right_evaluate">
            <h3> Внутренняя оценка</h3>
            <p> Внутренняя оценка проводится Вами самостоятельно. Для этого необходимо пройти тесты.</p>
            <div class="kg_buttons uk-flex">
                <!--добавить complete для отображения получения значка-->
                <div class="right_color right_color_blue"
                     v-bind:class="({'complete':isListLevels('NOKDO')})">
                    <router-link
                            class="btn_white"
                            :to="'/testing/NOKDO/2'">
                        НОКДО
                    </router-link>
                </div>
                <div class="right_color right_color_green"
                     v-bind:class="({'complete':isListLevels('ECERS')})">
                    <router-link
                            class="btn_white"
                            :to="'/testing/ECERS/2'">
                        ECERS
                    </router-link>
                </div>
            </div>
        </div>
        <div class="right_evaluate">
            <h3> Внешняя оценка</h3>
            <p> Внешняя оценка проводится нашим экспертом в Вашем детском саду. Услуга является платной.</p>
            <div class="kg_buttons uk-flex">
                <div class="right_color right_color_orange"
                     v-bind:class="({'complete':isRequestNOKDO})">
                    <a class="btn_white" @click="openModalRequest(1)">НОКДО</a>
                </div>
                <div class="right_color right_color_yellow"
                     v-bind:class="({'complete':isRequestECERS})">
                    <a class="btn_white" @click="openModalRequest(2)">ECERS</a>
                </div>
            </div>
        </div>
        <modal-request
                :level = 4
                :typeRequest = "typeRequest"
                :callback = "getAvailableLevelAll"
        ></modal-request>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import ModalRequest from "../../Training/ModalRequest";
    export default {
        components: {ModalRequest},
        data() {
            return {
                typeRequest: '',
            }
        },
        name: "evaluate",
        computed:{
            ...mapGetters('appTraining',[
                'isListLevels',
                'getListLevelsType'
            ]),
            ...mapGetters('appRequest',[
                'getRequestList'
            ]),
            isRequestNOKDO() {
                return this.isRequest(1);
            },
            isRequestECERS() {
                return this.isRequest(2);
            },
        },
        methods: {
            ...mapActions('appTraining',[
                'getAvailableLevelAll'
            ]),
            openModalRequest(type) {
                let typeStr = type === 1 ? 'NOKDO' : 'ECERS';
                if (!this.isRequest(type) && this.isListLevels(typeStr)) {
                    this.typeRequest = typeStr;
                    UIkit.modal("#modalRequest").show();
                }
            },
            isRequest(type){
                let result = false;

                if (typeof this.getRequestList !== 'undefined') {
                    result = _.filter(this.getRequestList, function (item) {
                        return item.direction_id === type
                    }).length > 0
                }
                return result;
            }
        }
    }
</script>

<style scoped>

</style>