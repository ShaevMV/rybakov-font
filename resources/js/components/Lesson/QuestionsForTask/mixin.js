import {mapGetters} from 'vuex';

export const mixin = {
    props: ['question'],
    data() {
        return {
            newValue: '',
        }
    },
    methods: {
        getOptionsList() {
            return JSON.parse(this.question.options)
        },
        isShowRight(answer, answerIndex) {
            let result = '';
            if(this.getShowRight){
                if(answer.right === "true"){
                    result = 'right_viwe';
                } else {
                    result = 'mistake_viwe';
                }
            }

            return result;
        }
    },
    computed: {

        userAnswer: {
            // геттер:
            get: function () {
                return this.getAnswer(this.question.id)
            },
            // сеттер:
            set: function (newValue) {
                this.newValue = newValue;
                /* this.setAnswerOptions({
                     idQuestions: this.idQuestions,
                     answer: newValue});*/
            }
        },
        ...mapGetters('appLesson', [
            'getAnswer',
            'isChecked',
            'getShowRight'
        ]),
    },
};