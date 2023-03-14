<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Создание задачи</h4>
                <p>Пожалуйста заполните форму</p>
            </div><!-- panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name"
                                       v-model="task.title"
                                       class="form-control"
                                       placeholder="Название задачи"
                                       required="">
                                <span class="error">{{getError('title')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name"
                                       v-model="task.description"
                                       class="form-control"
                                       placeholder="Описание"
                                       required="">
                                <span class="error">{{getError('description')}}</span>
                            </div>
                        </div>

                    </div><!-- form-group -->
                </div><!-- panel-body -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Тип</label>
                            <select class="form-control" v-model="task.type">
                                <option value="text">Текст</option>
                                <option value="video">Видео</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6" v-if="task.type === 'video'">
                        <div class="form-group">
                            <label>Ссылка на видео</label>
                            <input type="text" name="name"
                                   v-model="task.content"
                                   class="form-control"
                                   placeholder="Ссылка на видео"
                                   required="">
                            <span class="error">{{getError('content')}}</span>
                        </div>
                    </div>
                </div><!-- panel-body -->
                <div class="row" v-if="task.type === 'text'">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <ckeditor :editor="editor"
                                      v-model="task.content"
                                      :config="editorConfig"></ckeditor>
                            <span class="error">{{getError('content')}}</span>
                        </div>
                    </div><!-- form-group -->
                </div><!-- panel-body -->
                <!-- panel-footer -->
            </div><!-- panel -->

            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button class="btn btn-primary mr5" @click="save()">Создать задачу</button>
                        <button type="reset" class="btn btn-dark" @click="reset()">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import Vue from 'vue';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import {mixin} from '../../CKEditor/mixin.js';

    export default {
        name: "new-task",
        mixins: [mixin],
        data() {
            return {
                task: {
                    title: '',
                    type: 'text',
                    description: '',
                    content: '',
                },
            }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),

        },
        methods: {
            ...mapActions('appLesson', [
                'addTask'
            ]),
            /**
             * Сохранение
             */
            save() {
                let taskData = this.task;
                let app = this;

                this.addTask({
                    data: {
                        title: taskData.title,
                        content: taskData.content,
                        description: taskData.description,
                        type: taskData.type,
                        lesson_id: app.$route.params.id
                    },
                });

                this.task = {
                    title: '',
                    type: 'text',
                    description: '',
                    content: '',
                };

            },
            setAlert(message) {
                this.massage = message;
            },
            reset() {
                this.task = {
                    title: '',
                    type: 'text',
                    description: '',
                    content: '',
                };

            }
        }
    }
</script>

<style scoped>

</style>