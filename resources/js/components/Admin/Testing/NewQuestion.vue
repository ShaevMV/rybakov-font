<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                <h4 class="panel-title">{{getNumber()}} вопрос </h4>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Текст вопроса</label>
                            <ckeditor id="taskText"
                                      :editor="editor"
                                      v-model="itemQuestions.text"
                                      :config="editorConfig"></ckeditor>
                            <span class="error">{{getError('data.text')}}</span>
                        </div><!-- form-group -->
                    </div>
                    <div class="col-sm-6" v-if="itemQuestions.type!=='testing'">
                        <div class="form-group">
                            <label class="control-label">Тип вопроса</label>
                            <select v-model="itemQuestions.type" title="Тип вопроса">
                                <option value="text">
                                    Письменный вопрос
                                </option>
                                <option value="option">
                                    Один вариант ответа
                                </option>
                                <option value="many">
                                    Множество вариантов ответа
                                </option>
                            </select>
                            <span class="error">{{getError('data.type')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Комментарии к ответу</label>
                            <textarea
                                    class="form-control"
                                    v-model="itemQuestions.comment"
                                    title="Комментарии к ответу"></textarea>
                            <span class="error">{{getError('data.text')}}</span>
                        </div><!-- form-group -->
                    </div>
                </div>

                <div class="row" v-if="showOptions()">
                    <p>Варианты ответов</p>
                    <div class="table-responsive">
                        <table class="table mb30">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Вариант ответа</th>
                                <th>Правильный ответ</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(questions,index) in itemQuestions.options">
                                <td>
                                    {{index+1}}
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="questions.answer" title="Вопрос">
                                </td>
                                <td>
                                    <select class="form-control"
                                            v-model="questions.right"
                                            title="Правильный ответ"
                                            @change="isOneRight(questions,index)">
                                        <option value="true">Да</option>
                                        <option value="false">Нет</option>
                                    </select>

                                </td>
                                <td>
                                    <a @click="removeQuestions(index)"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <button class="btn btn-primary" @click="addQuestions()">Добавить вариант ответа</button>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary"
                        @click="save()">
                    Добавить вопрос</button>
            </div><!-- panel-footer -->
        </div><!-- panel -->

    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import {mixin} from '../../CKEditor/mixin.js';

    export default {
        name: "new-question",
        props: ['itemQuestions','save'],
        mixins : [mixin],
        computed: {
            ...mapGetters('appTesting', [
                'getTestingData'
            ]),
            ...mapGetters([
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appTesting',[
                'saveQuestions',
                'loadListQuestions',
                'addQuestions'
            ]),
            /**
             * Вывод идентификатора вопроса
             *
             * @return {string}
             */
            getNumber(){
                return typeof this.itemQuestions.id === 'undefined' ? 'Новый' :this.itemQuestions.id;
            },
            /*save(){
                let app = this;
                this.saveQuestions({
                    data: app.itemQuestions,
                    type: app.$route.params.type,
                    typeQuestion: app.getTestingData.type,
                    id: app.getTestingData.id,
                    callback: app.callback
                });
            },*/
            callback(){
                this.loadListQuestions({
                    type: this.$route.params.type,
                    level: this.$route.params.level
                })
            },
            addQuestions(){
                this.itemQuestions.options.push({
                    answer: '',
                    right: "false",
                });
            },
            removeQuestions(index){
                this.itemQuestions.options.splice(index,1);
            },
            showOptions() {
                return this.itemQuestions.type === 'option' || this.itemQuestions.type === 'many'
            },
            isOneRight(question, indexQuestion) {
                if (this.itemQuestions.type === 'option' && question.right === "true") {
                    this.itemQuestions.options.forEach(function (item, index) {
                        if (indexQuestion !== index) {
                            item.right = "false";
                        }
                    })

                }
            }

        },
    }
</script>

<style scoped>

</style>