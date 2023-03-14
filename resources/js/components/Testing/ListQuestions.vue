<template>
    <div class="test_block test_box margin_bottom_40">
        <div class="question_block"
             v-for="(items, index) in getListQuestions">
            <h4 class="question_header"><span> {{getIndex(index)}}.</span> {{getTextAnswer(items.type)}}</h4>
            <p class="question_desc" v-html="items.text"></p>
            <testing-questions v-if="items.type === 'testing'"
                               :option="getAnswerOptionsList(items.options)"
                               :indexQuestions="index"
                               :idQuestions='items.id'/>
            <options-questions v-if="items.type === 'option'"
                               :option="getAnswerOptionsList(items.options)"
                               :indexQuestions='index'
                               :idQuestions='items.id'/>
            <many-questions v-if="items.type === 'many'"
                            :indexQuestions='index'
                            :option="getAnswerOptionsList(items.options)"
                            :idQuestions='items.id'/>

            <text-questions v-if="items.type === 'text'"
                            :indexQuestions='index'
                            :option="getAnswerOptionsList(items.options)"
                            :idQuestions='items.id'/>
            <span class="error" v-if="items.answer_user == null && getCountAnswered>0">
                Для завершения теста, пожалуйста ответьте на данный вопрос
            </span>

        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import TestingQuestions from "./TestingQuestions";
    import OptionsQuestions from "./OptionsQuestions";
    import TextQuestions from "./TextQuestions";
    import ManyQuestions from "./ManyQuestions";


    export default {

        components: {
            ManyQuestions,
            TextQuestions,
            OptionsQuestions,
            TestingQuestions
        },
        name: "list-questions",
        data() {
            return {
                answersList: {}
            }
        },
        computed: {
            ...mapGetters('appTesting', [
                'getListQuestions',
                'dataForPagination',
                'getCountAnswered',
                'isChecked'
            ]),
        },
        methods: {
            ...mapActions('appTesting', [
                'setAnswerOptions'
            ]),
            getTextAnswer(type) {
                let result = '';
                switch (type) {
                    case 'text':
                        result = 'Напишите свой ответ';
                        break;
                    case 'many':
                        result = 'Выберите несколько вариантов ответа';
                        break;
                    case 'option':
                        result = 'Выберите один из вариантов';
                        break;
                    case 'testing':
                        result = '';
                        break;
                    default:
                        console.error('нет такого типа');
                }
                return result;
            },
            getAnswerOptionsList(options) {
                let optionsList = JSON.parse(options);
                return optionsList
            },
            /**
             * Вывести индекс
             *
             * @param index
             * @return {Number}
             */
            getIndex(index) {
                return this.dataForPagination.from + index;
            },
            /**
             * Выделить ответ
             * isChecked(items.id,answer)
             * @param idQuestions
             * @param answer
             */
            setAnswers(idQuestions, answer) {
                this.answersList[idQuestions] = answer;
            }
        },
    }
</script>

<style scoped>

</style>