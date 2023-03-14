<template>
    <div class="input_radio answers_block show_hint">
        <span class="input_checkbox" v-for="(answer,answerIndex) in option">
            <input :id="'a'+ idQuestions + answerIndex"
                   class="input_checkbox"
                   type="checkbox"
                    v-bind:checked="isChecked({
                        idQuestions:idQuestions,
                        answer:answerIndex
                    })"
                   @click="setAnswerOptions({
                        idQuestions:idQuestions,
                        answer:answerIndex,
                        type:'many'
                    })"
                   v-bind:class="{'right':isChecked({
                        idQuestions:idQuestions,
                        answer:answer

                    })}">
            <label :for="'a'+ idQuestions + answerIndex">{{answer.answer}}</label>
        </span>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
            name: "many-questions",
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