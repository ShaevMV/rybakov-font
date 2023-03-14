<template>
    <div class="col-md-12">
        <h5 class="lg-title mb5">Список вопросов к уроку</h5>
        <div class="table-responsive">
            <table class="table mb30">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Вопрос</th>
                    <th>Тип</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,index) in editableTask.questions">
                    <td>{{index+1}}</td>
                    <td v-html="item.text"></td>
                    <td>{{rusType(item.type)}}</td>
                    <td>
                        <a @click="remove(item.id)"><span class="glyphicon glyphicon-trash"></span></a>
                        <a @click="selectQuestions(item)"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <new-question :itemQuestions="itemQuestions"
                      :save="save"></new-question>
    </div>
</template>

<script>
    import NewQuestion from "../Testing/NewQuestion";
    import {mapGetters, mapActions, mapState} from 'vuex';

    export default {
        components: {
            NewQuestion
        },
        name: "list-questions-for-task",
        data() {
            return {
                itemQuestions: {
                    type: 'text',
                    text: '',
                    options: [],
                    comment: '',

                },

            }
        },
        computed: {
            ...mapGetters('appLesson', [
                'editableTask'
            ]),
            ...mapGetters('appTesting', [
                'getParamsForNewQuestions'
            ]),

        },
        methods: {
            ...mapActions('appTesting', [
                'questionsDelete',
                'saveQuestions',
            ]),
            ...mapActions('appLesson', [
                'getTask'
            ]),
            /**
             * Русские названия для типов
             *
             * @param type
             * @return {string}
             */
            rusType(type) {
                switch (type) {
                    case 'option':
                        return 'Один вариант ответа';
                    case 'text':
                        return 'Письменный вопрос';
                    case 'many':
                        return 'Множество вариантов ответа';
                }
            },
            /**
             * Удалить вопрос из теста
             * @param id
             */
            remove(id) {
                this.questionsDelete({
                    id: id,
                    callback: this.beforeSave
                });
            },
            async selectQuestions(item) {
                let app = this;
                new Promise(function () {
                    let result = {};
                    result.options = JSON.parse(item.options);
                    result.type = item.type;
                    result.text = item.text;
                    result.id = item.id;
                    result.comment = item.comment;
                    app.itemQuestions = result;
                });
            },
            beforeSave() {
                this.itemQuestions = {
                    type: 'text',
                    text: '',
                    options: [],
                    comment: '',
                };
                this.getTask({
                    id: this.editableTask.id
                })
            },
            save() {
                let app = this;
                this.saveQuestions({
                    data: app.itemQuestions,
                    type: 'task',
                    typeQuestion: 'any',
                    id: app.editableTask.id,
                    callback: app.beforeSave
                });
            },
        },

    }
</script>

<style scoped>

</style>