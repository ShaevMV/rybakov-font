<template>
    <div class="inner_section">
        <div class="container">
            <div class="eval_training">
                <h1> {{getTitle}}</h1>
                <p>  Курс подразделяется на три уровня</p>

                <div class="stage_overlay">
                    <!-- 1 уровень -->
                    <div class="stage_training stage_training1 stage1">
                        <div class="stage_img"><img src="/images/content/stage1.svg"></div>
                        <h2> Мастер самооценки</h2>
                        <div class="block_line">
                            <div class="block_level">1 уровень</div>
                        </div>
                        <p>  Онлайн курс по работе с инструментом оценки качества дошкольного образования, проведение самооценки с использованием электронного приложения</p>
                        <router-link
                            class="button_continue btn_train btn_sel1"
                            :to="'/lesson/'+type">
                            <span v-if="!isTrainingLevel({
                                    level:1,
                                    stage: 1
                                })">Пройти обучение</span>
                            <span v-else>Пройти обучение еще раз</span>
                        </router-link>

                        <router-link
                                v-if="isTrainingLevel({
                                    level:1,
                                    stage: 1
                                })"
                                class="button_continue btn_train uk-margin-top btn_block"
                                :to="'/testing/'+type+'/1'">
                            Провести самооценку
                        </router-link>
                        <span class="button_continue btn_train uk-margin-top btn_block disable" v-else>Провести самооценку</span>
                        <a class="custom_link uk-text-center link_train"
                           @click="setMoreDetails(1)"
                           v-bind:class="{disable_link: !getMoreDetailsForLevel(1)}">Подробнее</a>
                    </div>
                    <!-- 2 уровень-->
                    <div class="stage_training stage_training2"
                         v-bind:class="getClassLevel(2)">
                        <div class="stage_img"><img src="/images/content/stage2.svg"></div>
                        <h2> Исследователь качества</h2>
                        <div class="block_line">
                            <div class="block_level">2 уровень</div>
                        </div>
                        <p class="train-text train-text1">  Участие в обучающем 2-х дневном очном семинаре в Вашем городе. Участие является платным.</p>
                        <p class="train-text train-text2"><span class="uk-text-bold">  Заявка обрабатывается.<br></span>  Мы сообщим о дате начала обучения. По любым вопросам вы можете связаться с нами по телефону:<span class="uk-text-bold">   8 (800) 560-00-00</span></p>
                        <p class="train-text train-text3">  Обучение пройдет<span class="uk-text-bold"> {{dateOfThe[2]}} в {{place[2]}}.</span>  Подробную информацию мы выслали Вам на почту.</p>
                        <p class="train-text train-text4">   Вы прошли обучение! Теперь Вам доступно тестирование.</p>
                        <p class="train-text train-text5"> Вы прошли обучение!
                            <span v-if="!isTrainingLevel({
                                            level:2,
                                            stage: 2
                                        })">
                                Дождитесь проверки тестирования.
                            </span>
                        </p>

                        <a class="button_continue btn_train btn_train1"
                           v-bind:class="{'disable': !isAccessRequest(2)}"
                           @click="openModalRequestLevel(2)">
                            Начать
                        </a>
                        <router-link
                                v-if="isAccessTesting(2)"
                                class="button_continue btn_train uk-margin-top btn_block"
                                :to="'/testing/'+type+'/2'">
                            Пройти тест
                        </router-link>
                        <span v-else class="button_continue btn_train uk-margin-top btn_block disable">
                            Пройти тест
                        </span>

                        <a class="custom_link uk-text-center link_train"
                           @click="setMoreDetails(2)"
                           v-bind:class="{disable_link: !getMoreDetailsForLevel(2)}">Подробнее</a>
                    </div>
                    <!-- 3 уровень-->
                    <div class="stage_training stage_training3"
                         v-bind:class="getClassLevel(3)">
                        <div class="stage_img"><img src="/images/content/stage3.svg"></div>
                        <h2> Эксперт оценки качества</h2>
                        <div class="block_line">
                            <div class="block_level">3 уровень</div>
                        </div>
                        <p class="train-text train-text1">  Интенсив по подготовке эксперта оценки качества в Вашем городе</p>
                        <p class="train-text train-text2"><span class="uk-text-bold">  Заявка обрабатывается.<br></span>  Мы сообщим о дате начала обучения. По любым вопросам вы можете связаться с нами по телефону:<span class="uk-text-bold">   8 (800) 560-00-00</span></p>
                        <p class="train-text train-text3">  Обучение пройдет<span class="uk-text-bold">  {{dateOfThe[3]}} в {{place[3]}}.</span>  Подробную информацию мы выслали Вам на почту.</p>
                        <p class="train-text train-text4"> Вы прошли обучение! Теперь Вам доступно тестирование.</p>
                        <p class="train-text train-text5"> Вы прошли обучение!
                            <span v-if="!isTrainingLevel({
                                            level:3,
                                            stage: 2
                                        })">
                                Дождитесь проверки тестирования.
                            </span>
                        </p>
                        <a class="button_continue btn_train btn_train1"
                           v-bind:class="{'disable': !isAccessRequest(3)}"
                           @click="openModalRequestLevel(3)">Начать</a>
                        <router-link
                                v-if="isAccessTesting(3)"
                                class="button_continue btn_train uk-margin-top btn_block"
                                :to="'/testing/'+type+'/3'">
                            Пройти тест
                        </router-link>
                        <span v-else class="button_continue btn_train uk-margin-top btn_block disable">
                            Пройти тест
                        </span>

                        <a class="custom_link uk-text-center link_train"
                           @click="setMoreDetails(3)"
                           v-bind:class="{disable_link: !getMoreDetailsForLevel(3)}">Подробнее</a>

                    </div>
                </div><a class="close-button" @click="$router.push('/lk/')"></a>
            </div>
        </div>
        <modal-request :level="levelRequest" :typeRequest="typeRequest"></modal-request>
        <modal-completed
                :link="'/training/'+$route.params.type"></modal-completed>
        <modal-more-details
                :textMoreDetails="moreDetails"></modal-more-details>
    </div>

</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import ModalRequest from "./ModalRequest";
    import ModalEndLesson from "../Lesson/ModalEndLesson";
    import ModalCompleted from "../ModalCompleted";
    import ModalMoreDetails from "./ModalMoreDetails";

    const REQUEST_LEVEL = 1; // Уровен доступа к заявкам
    const REQUEST_STAGES = 2; // Этап доступа к заявкам

    export default {
        components: {
            ModalMoreDetails,
            ModalCompleted,
            ModalEndLesson,
            ModalRequest},
        name: "eval-training",
        props: ['type'],
        data(){
            return {
                dateOfThe: {},
                loadRequest: false,
                levelRequest: 2,
                typeRequest: '',
                place: {},
                moreDetails: ''
            };
        },
        beforeRouteEnter: async (to, from, next) => {
            let app = this;
            store.dispatch('appTraining/getAvailableLevel', {type: to.params.type})
                .then(async function () {
                // проверить что пользователь достиг прогресса для офлайн обучения
                if (store.getters['appTraining/isTrainingLevel']({
                        level: REQUEST_LEVEL,
                        stage: REQUEST_STAGES
                    })) {
                    await store.dispatch('appRequest/loadGroupList', {
                        type: to.params.type,
                        next: next(vm=>{
                            if(vm.$route.params['OpenModalRequest']){
                                vm.openModalRequestLevel(2);
                            }
                        })
                    })
                } else {
                    next();
                }
            });
        },
        computed: {
            ...mapGetters('appTraining', [
                'isTrainingLevel',
                'getMoreDetailsForLevel'
            ]),
            ...mapGetters('appRequest', [
                'getRequestTrainingGroup',
            ]),
            ...mapGetters(['getDirectName']),
            getTitle(){
                let result = '';
                switch (this.$route.params.type){
                    case 'NOKDO':
                        result = "Работа с инструментом оценки качества дошкольного образования НОК ДО";
                        break;
                    case 'ECERS':
                        result = "Работа с инструментом оценки качества дошкольного образования ECERS-3";
                        break;
                }
                return result;
            },
            /**
             * Данные для кнопки по тестированию
             *
             * @return {string}
             **/
            getTextButton() {
                return !this.isTrainingLevel({
                    level: 1,
                    stage: 2
                }) ?
                    'title: Необходимо закончить 1 уровень обучения; pos: bottom;' :
                    'title: Вы можете пройти тестирование; pos: bottom;';
            },


        },
        methods: {
            ...mapActions(['setTypeDirection']),
            setMoreDetails(level){
                let result = this.getMoreDetailsForLevel(level);
                let modal = UIkit.modal("#modalMoreDetails");
                if(result){
                    this.moreDetails = result;
                    modal.show();
                }
            },
            /**
             * Открыть модальное окно принятия заявки на офлайн обучение 2-го уровня
             *
             * @return {void}
             **/
            openModalRequestLevel(index) {
                let modal = UIkit.modal("#modalRequest");

                if (this.isAccessRequest(index)) {
                    this.levelRequest = index;
                    this.typeRequest = this.$route.params.type;
                    modal.show();
                }
            },
            /**
             * Получить данные по заявки
             *
             * @param level number
             * @return {object}
             **/
            getRequestTraining(level) {
                return this.requestTraining[level];
            },
            /**
             * Записать заявки
             *
             * @param request Object
             **/
            setRequestTraining(request) {
                this.requestTraining = request;
            },
            /**
             * Проверить доступк к тестированию
             *
             * @param level
             * @return {bool}
             **/
            isAccessTesting(level) {
                return this.getRequestTrainingGroup(level) !== undefined &&
                    this.getRequestTrainingGroup(level).check === 1 &&
                    (this.getRequestTrainingGroup(level).passed == null ||
                        this.getRequestTrainingGroup(level).passed === 0)
            },
            /**
             *  проверить доступ к отправки уведамления
             */
            isAccessRequest(index){

                return this.isTrainingLevel({
                    level: index - 1,
                    stage: 2
                }) &&
                typeof this.getRequestTrainingGroup(index) === 'undefined'
            },
            /**
             * Вывести класс для блока заявки
             *
             * @param index
             * @return {string}
             */
            getClassLevel(index) {
                let className = 'stage1';

                if (this.isTrainingLevel({
                        level: index,
                        stage: 2
                    })) {
                    className = 'stage6';
                } else if (this.isTrainingLevel({
                        level: index - 1,
                        stage: 2
                    }) && this.getRequestTrainingGroup(index) === undefined) {
                    className = 'stage1';
                } else if (this.getRequestTrainingGroup(index) !== undefined) {
                    className = 'stage2';
                    if(this.getRequestTrainingGroup(index).group_requests !== null){
                        if (this.getRequestTrainingGroup(index).group_requests.date_of_meeting !== null) {

                            className = 'stage4';
                            this.dateOfThe[index] = this.getRequestTrainingGroup(index).group_requests.date_of_meeting;
                            this.place[index] = this.getRequestTrainingGroup(index).group_requests.place;
                            //this.place = this.getRequestTraining(2).group_requests.place;
                        }
                        if (this.getRequestTrainingGroup(index).check && this.getRequestTrainingGroup(index).passed === 0) {
                            className = 'stage5';
                        }
                        if(this.getRequestTrainingGroup(index).check && this.getRequestTrainingGroup(index).passed === 1) {
                            className = 'stage6';
                        }
                    }
                }

                return className;
            }
        },
    }
</script>

<style scoped>

</style>