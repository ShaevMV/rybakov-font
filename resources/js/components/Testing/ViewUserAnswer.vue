<template>
    <div class="wrapper uk-flex uk-flex-center uk-flex-left">
        <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle form_test margin_top_70">
            <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26"> Тест {{getTitle}}</h2>
            <h3 class="grey-color uk-margin-remove">{{getTesting.description}}</h3>
            <div class="test_block test_box margin_bottom_0">
                <div class="question_block" v-for="(item,index) in getListQuestions">
                    <h4 class="question_header"><span> {{index+1}}.</span>{{getRusType(item.type)}}</h4>
                    <p class="question_desc">{{item.text}}</p>

                    <div v-bind:class="getClassForType(item.type)">
                        <span class="answer_text">   Ответ:</span>
                        <div class="answer_textarea" v-if="item.type === 'text'">
                            {{getJson(item.answer_user.answer)[0]}}
                        </div>
                        <div class="buttons uk-flex uk-flex-middle" v-else>
                            <div class="input_radio" v-for="answer in getJson(item.answer_user.answer)">
                                <label class="uk-flex uk-flex-middle uk-flex-center" for="a11"><span>{{answer}}</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_overlay_block width-100 test_block test_box margin_bottom_40">
                <label for="inp_comment">Экспертное заключение</label>
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <!-- У input_wrapper есть классы success и failed-->
                    <textarea id="inp_comment" v-model="comment" type="text"></textarea>
                </div>
                <div class="uk-flex uk-flex-wrap">
                    <div class="input_checkbox">
                        <input type="checkbox" name="agree_p_data" id="checkbox_form_1" v-model="access">
                        <label for="checkbox_form_1"> {{getTextAccess}} </label>
                    </div>
                </div>
            </div><a class="button_finish_test"
                     @click="submit()"> Отправить</a>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {

        name: "view-user-answer",
        data(){
            return {
                comment:'',
                access:false
            }
        },
        computed: {
            ...mapGetters('appTesting', [
                'getListQuestions',
                'getTesting',
                'getDirectionName',
                'getTraining'
            ]),
            getTextAccess(){
                let result = '';
                if(typeof this.getTesting.level !== 'undefined'){
                    switch (this.getTesting.level.number){
                        case 2:
                            result = 'Открыть доступ на 3 уровень обучения';
                            break;
                        case 3:
                            result = 'Присвоить статус эксперта';
                            break;
                        case 4:
                            result = 'Присвоить значок';
                            break;
                    }
                }

                return  result;
            },
            getTitle(){
                let level = '';
                if(this.getTesting.level !== undefined){
                    level = this.getTesting.level.number < 4 ? ' ' + this.getTesting.level.number + ' уровня ' : '';
                }
                return this.getDirectionName + level;
            }
        },
        methods:{
            ...mapActions('appExpert',[
                'setExpertOpinion'
            ]),
            getRusType(type){
                switch(type){
                    case 'text':
                        return 'Напишите ответ';
                    case 'testing':
                    case 'option':
                        return 'Выберите один из вариантов';
                    case 'many':
                        return 'Выберите несколько вариантов ответов';
                }
            },
            getClassForType(type){
                switch(type){
                    case 'text':
                        return 'form_overlay_block uk-padding-remove width-100 no-shadow margin_bottom_0 grey_back';
                    case 'testing':
                    case 'option':
                    case 'many':
                        return 'block_with_buttons uk-flex uk-flex-middle';
                }
            },
            submit(){
                let app = this;
                this.setExpertOpinion({
                    data:{
                        comment: this.comment,
                        access: this.access
                    },
                    training_id: this.$route.params.training
                }).then(function () {
                    app.$router.go(-1);
                })
            },
            getJson(json){
                return JSON.parse(json)
            },


        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appTesting/clearUserAnswer');
            store.dispatch('appTesting/loadUserAnswer', {
                trainingId: to.params.training
            }).then(function () {
                next(vm => {

                    vm.comment = vm.getTraining.expert_opinion;
                    vm.access = vm.getTraining.false;
                })
            });
        },
        beforeRouteUpdate(to, from, next) {
            store.dispatch('appTesting/clearUserAnswer');
            store.dispatch('appTesting/loadUserAnswer', {
                trainingId: to.params.training
            }).then(function () {
                next(vm => {
                    vm.comment = vm.getTraining.expert_opinion;
                    vm.access = vm.getTraining.false;
                })
            });

        },
    }
</script>

<style scoped>

</style>