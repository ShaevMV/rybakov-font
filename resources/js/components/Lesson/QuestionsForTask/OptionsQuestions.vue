<template>
    <div class="input_radio answers_block show_hint">
        <span v-for="(answer,answerIndex) in getOptionsList()">
            <input :id="'a'+ question.id + answerIndex"
                   type="radio"
                   @click="setAnswerOptions({
                        idQuestions:question.id,
                        answer:answerIndex,
                        type:'options'
                    })"
                   v-bind:class="{'right':isChecked({
                        idQuestions:question.id,
                        answer:answerIndex
                    })}">
            <label :for="'a'+ question.id + answerIndex" class="fail">{{answer.answer}}
                <span v-bind:class="isShowRight(answer,answerIndex)" v-if="getShowRight"></span>
            </label>
        </span>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import {mixin} from './mixin.js';

    export default {
        name: "options-questions",
        props: ['question'],
        mixins: [mixin],
        methods: {
            ...mapActions('appLesson', [
                'setAnswerOptions'
            ]),

        },
        computed: {
            ...mapGetters('appLesson', [
                'isChecked'
            ]),
        },
    }
</script>

<style scoped>

</style>