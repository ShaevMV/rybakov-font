<template>
    <div class="input_radio answers_block show_hint">
        <span v-for="(answer,answerIndex) in option">
            <input :id="'a'+ idQuestions + answerIndex"
                   type="radio"
                   @click="setAnswerOptions({
                        idQuestions:idQuestions,
                        answer:answerIndex,
                        type:'options'
                    })"
                   v-bind:class="{'right':isChecked({
                        idQuestions:idQuestions,
                        answer:answerIndex
                    })}">
            <label :for="'a'+ idQuestions + answerIndex">{{answer.answer}}</label>
        </span>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "options-questions",
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