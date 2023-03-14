<template>
    <div class="input_radio answers_block show_hint">
        <span class="input_checkbox" v-for="(answer,answerIndex) in getOptionsList()">
            <input :id="'a'+ question.id + answerIndex"
                   type="checkbox"
                   class="input_checkbox"
                   v-bind:checked="isChecked({
                        idQuestions:question.id,
                        answer:answerIndex
                   })"
                   @click="setAnswerOptions({
                        idQuestions:question.id,
                        answer:answerIndex,
                        type:'many'
                    })"
                   v-bind:class="{'right':isChecked({
                        idQuestions:question.id,
                        answer:answerIndex
                    })}">
            <label :for="'a'+ question.id + answerIndex">
                {{answer.answer}}
                <span v-bind:class="isShowRight(answer,answerIndex)" v-if="getShowRight"></span>
            </label>
        </span>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import {mixin} from './mixin.js';

    export default {
        name: "many-questions",
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