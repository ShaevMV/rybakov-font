<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Создание задачи</h4>
                <p>Пожалуйста заполните форму</p>
            </div><!-- panel-heading -->
            <div class="panel-body">

                <div class="form-group">
                    <label for="nameTask" class="control-label">Название задачи</label>
                    <input type="text" name="name" id="nameTask"
                           v-model="editableTask.title"
                           class="form-control"
                           placeholder="Название задачи"
                           required="">
                    <span class="error">{{getError('title')}}</span>
                </div>

                <div class="form-group">
                    <label for="taskDesc" class="control-label">Описание</label>
                    <input type="text" name="name" id="taskDesc"
                           v-model="editableTask.description"
                           class="form-control"
                           placeholder="Описание"
                           required="">
                    <span class="error">{{getError('description')}}</span>
                </div>
                <div class="form-group">
                    <label for="taskType" class="control-label">Тип</label>
                    <select class="form-control" v-model="editableTask.type" id="taskType">
                        <option value="text">Текст</option>
                        <option value="video">Видео</option>
                        <option value="testing">Тестирование</option>
                    </select>
                </div>

                <div class="form-group" v-if="editableTask.type === 'text'">
                    <label for="taskText" class="control-label">Текст</label>
                    <ckeditor id="taskText"
                              :editor="editor"
                              v-model="editableTask.content"
                              :config="editorConfig"></ckeditor>
                    <span class="error">{{getError('content')}}</span>
                </div>
                <div class="form-group" v-if="task.type === 'video'">
                    <label for="taskText" class="control-label">Видео</label>
                    <input class="form-control" v-model="editableTask.content" title="Видео"/>
                    <span class="error">{{getError('content')}}</span>
                </div>
                <div class="form-group" v-if="editableTask.type === 'testing'">
                    <label for="taskText" class="control-label">Тестирование</label>
                    <span v-if="typeof $route.params.task === 'undefined'">Для добавления вопросов необходимо сохранить задание</span>
                    <list-questions-for-task v-else></list-questions-for-task>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row-fluid">
                    <button class="btn btn-primary mr5" @click="save()">
                        {{buttonText}}
                    </button>
                    <button type="reset" class="btn btn-dark" @click="back()">Вернуться</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import axios from 'axios';
    import ListQuestionsForTask from "./ListQuestionsForTask";
    import {mixin} from '../../CKEditor/mixin.js';


    export default {
        components: {ListQuestionsForTask},
        name: "CreateTask",
        mixins: [mixin],
        data() {
            return {
                buttonText: 'Создать задачу',
                lockButton: false,
                task: {
                    title: '',
                    description: '',
                    type: 'text',
                    content: '',
                },
            }
        },
        computed: {
            ...mapGetters('appLesson', [
                'editableTask'
            ]),

            ...mapGetters([
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appLesson', [
                'addTask',
            ]),
            /**
             * Сохранение
             */
            save() {

                let taskData = this.editableTask;
                let app = this;

                if (typeof this.$route.params.task === 'undefined') {

                    this.addTask({
                        data: {
                            title: taskData.title,
                            content: taskData.content,
                            description: taskData.description,
                            type: taskData.type,
                            lesson_id: app.$route.params.id
                        },
                        callback:app.callback
                    });
                } else {
                    this.addTask({
                        data: {
                            id: app.$route.params.task,
                            title: taskData.title,
                            content: taskData.content,
                            description: taskData.description,
                            type: taskData.type,
                            lesson_id: app.$route.params.id
                        },
                        callback:app.callback
                    });
                }

            },
            back() {
                this.$router.push({name: 'lessonsEdit', params: {id: this.$route.params.id}});
            },
            callback(){
                alert('Задача успешно создана!');
                this.back();
            },
        },
        mounted: function () {
            if (Object.keys(this.editableTask).length > 0) {
                this.task = _.cloneDeep(this.editableTask);
            }
            this.$nextTick(function () {

                if (typeof this.$route.params.task !== 'undefined') {
                    this.buttonText = 'Сохранить задачу';
                } else {
                    this.buttonText = 'Создать задачу';
                }
            })
        }
    }
</script>

<style scoped>

</style>