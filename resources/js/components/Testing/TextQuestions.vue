<template>
    <div class="form_overlay_block uk-padding-remove width-100 no-shadow margin_bottom_0">
        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
            <!-- У input_wrapper есть классы success и failed-->
            <label :for="'inp_'+idQuestions">Ваш ответ</label>
            <textarea :id="'inp_'+idQuestions"
                      type="text"
                      @change="setAnswerOptions({
                        idQuestions: idQuestions,
                        answer: newValue,
                        type:'text'})"
                      v-model="userAnswer"></textarea>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "text-questions",
        data(){
            return {
                newValue: '',
            }
        },
        props: {
            option: {
                type: Array,
                default: [],
            },
            idQuestions: Number,
            indexQuestions: Number,
        },
        methods: {
            ...mapActions('appTesting', [
                'setAnswerOptions'
            ]),
        },
        computed: {
            userAnswer: {
                // геттер:
                get: function () {
                    return this.getAnswer(this.idQuestions)
                },
                // сеттер:
                set: function (newValue) {
                    this.newValue = newValue;
                   /* this.setAnswerOptions({
                        idQuestions: this.idQuestions,
                        answer: newValue});*/
                }
            },
            ...mapGetters('appTesting', [
                'getAnswer'
            ]),
        },
        created: function () {
            this.newValue = this.getAnswer(this.idQuestions);
        }
    }
</script>

<style scoped>

</style>