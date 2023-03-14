<template>
    <div class="form_overlay_block uk-padding-remove width-100 no-shadow margin_bottom_0">
        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
            <label :for="'inp_'+question.id">Ваш ответ</label>
            <textarea :id="'inp_'+question.id"
                      type="text"
                      @change="setAnswerOptions({
                        idQuestions: question.id,
                        answer: newValue,
                        type:'text'})"
                      v-model="userAnswer"
                      title="Ваш ответ"></textarea>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import {mixin} from './mixin.js';

    export default {
        name: "text-questions",
        mixins: [mixin],
        methods: {
            ...mapActions('appLesson', [
                'setAnswerOptions'
            ]),
        },
        computed: {
            ...mapGetters('appLesson', [
                'getAnswer'
            ]),
        },
    }
</script>

<style scoped>

</style>