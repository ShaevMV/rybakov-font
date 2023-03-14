<template>
    <div class="block_with_buttons uk-flex uk uk-flex-between uk-flex-middle">
        <div class="black_line"></div>
        <div class="buttons uk-flex uk-flex-middle">

            <div class="input_radio"
                 v-for="(answer,answerIndex) in option">
                <input type="radio" :id="'a'+(answerIndex+1)+(indexQuestions+1)">
                <label class="uk-flex uk-flex-middle uk-flex-center"
                       v-bind:class="{'checked': isChecked({
                            idQuestions: idQuestions,
                            answer: answerIndex
                       })}"
                       @click="setAnswerOptions({
                            idQuestions: idQuestions,
                            answer: answerIndex,
                            type:'testing'
                       })"
                       :id="'a'+(answerIndex+1)+(indexQuestions+1)"><span>{{answer.answer}}</span>
                </label>
            </div>
        </div>
        <div class="black_line"></div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "testing-questions",
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
            ...mapGetters('appTesting', [
                'isChecked'
            ]),
        },
    }
</script>

<style scoped>

</style>