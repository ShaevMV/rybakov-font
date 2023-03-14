<template>
    <div class="test_block edu_test">
        <div class="question_block" v-for="(question,index) in getQuestionsInSelectTask">
            <h4 class="question_header"><span>   {{index+1}}.</span>  {{getTypeName(question.type)}}</h4>
            <p class="question_desc" v-html="question.text"></p>
            <text-questions v-if="question.type === 'text'"
                            :question="question"></text-questions>
            <options-questions v-if="question.type === 'option'"
                               :question="question"></options-questions>
            <many-questions v-if="question.type === 'many'"
                            :question="question"></many-questions>
            <div class="quest-answer" v-if="isShowComment(question)">
                <div class="quest-answer__title">Комментарий к вопросу</div>
                <div class="quest-answer__text">{{question.comment}}</div>
            </div>
        </div>

        <div class="tooltip_overlay"
             uk-tooltip="Для того, чтобы увидеть правильные ответы, пожалуйста ответьте на все вопросы"
             v-if="showButton()"
             title=""
             aria-expanded="false">
            <button v-bind:class="{ disable: isDisable() }"
                    @click="showTrue()"
                    style="padding: 0 15px 0 15px"
                    class="button_continue btn_test uk-margin-top">
                проверить ответы
            </button>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import TextQuestions from "./QuestionsForTask/TextQuestions";
    import OptionsQuestions from "./QuestionsForTask/OptionsQuestions";
    import ManyQuestions from "./QuestionsForTask/ManyQuestions";
    export default {
        components: {
            ManyQuestions,
            OptionsQuestions,
            TextQuestions
        },
        name: "task-questions",
        computed: {
            ...mapGetters('appLesson',[
                'getShowRight',
                'getQuestionsInSelectTask'
            ])
        },
        methods:{
            ...mapActions('appLesson',[
                'showRight'
            ]),
            showButton() {
                let result = false;
                this.getQuestionsInSelectTask.forEach(function (item) {
                    if (item.type === 'option' || item.type === 'many' || item.type === 'text') {
                        result = true;
                    }
                });
                return result;
            },
            showTrue() {
                if(!this.isDisable()){
                    this.showRight();
                }
            },
            isDisable() {
                let result = false;
                this.getQuestionsInSelectTask.forEach(function (item) {
                    if(item.answer_user === null && item.type !=='text'){
                        result = true;
                    }
                });
                return result;
            },
            getTypeName(type){
                switch (type){
                    case 'text':
                        return 'Напишите верный ответ на вопрос';
                    case 'option':
                        return 'Выберите один из вариантов';
                    case 'many':
                        return 'Выберите несколько из вариантов';
                }
            },
            isShowComment(question) {

                let comment = question.comment ? question.comment.length > 0 : false;
                return this.getShowRight && comment;
            }

        }
    }
</script>

<style scoped>

</style>