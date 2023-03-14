<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Редактирование урока</h4>
                <p>This is an example of a form using a placeholder instead of label.</p>
            </div><!-- panel-heading -->
            <div class="panel-body" v-if="typeof lessonData.id !=='undefined'">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="control-label">Заголовок</label>
                        <input type="text" v-model="lessonData.title" placeholder="Заголовок" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Порядок отображения урока</label>
                        <input type="number" v-model="lessonData.sort" placeholder="Порядок отборажения урока" class="form-control">
                    </div>
                </div><!-- row -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <h3>Список задач</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table mb30">
                            <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th style="width: 100px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in lessonData.tasks" v-bind:class="{'removeItem':!isShow(item.id)}">
                                    <td>{{item.id}}</td>
                                    <td>{{item.title}}</td>
                                    <td>{{getType(item.type)}}</td>
                                    <td>
                                        <div class="button-group">
                                            <button class="btn btn-primary btn-sm" @click="editTask(item.id)" v-if="isShow(item.id)">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                            <button v-if="isShow(item.id)" type="button" class="btn btn-danger btn-sm" @click="addRemove(item.id)">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                            <button v-else="isShow(item.id)" type="button" class="btn btn-danger btn-sm" @click="restore(item.id)">
                                                Восстановить
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- panel-body -->
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-success mr5" @click="newTask()">Создать задачу</button>
                        <button class="btn btn-primary mr5" @click="sumbit()">Сохранить</button>
                        <button type="reset" class="btn btn-dark" @click="reset()">Отмена</button>
                    </div>
                </div>
            </div>
        </div><!-- panel -->

    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import axios from 'axios'

    import _ from 'lodash';

    export default {

        name: "Edit",
        data() {
            return {
                lessonData: {},
                oldLessonData: {},
                removeList: []
            }
        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appLesson/getLesson', {
                id: to.params.id,
                next: next
            });
        },
        computed: {
            ...mapGetters('appLesson', [
                'itemLesson'
            ]),

        },
        methods: {
            ...mapActions('appLesson', [
                'updateLesson',
                'getLesson'
            ]),

            getType(type) {
                switch (type) {
                    case 'text':
                        return 'текст';
                    case 'video':
                        return 'видео';
                    case 'testing':
                        return 'тестирование'
                }
            },
            getTask() {
                let app = this;

                return _.filter(this.lessonData.tasks, function (item) {
                    return app.removeList.indexOf(item.id) === -1
                })
            },

            sumbit() {
                this.updateLesson({
                    id: this.$route.params.id,
                    lesson: this.lessonData,
                    tasks: this.getTask(),
                    callback: this.callback
                });
            },
            deleteTask() {
                let lesson = this.lessonData;
                lesson['tasks'] = this.getTask();
                this.setData(lesson);
            },
            callback() {
                this.getLesson({
                    id: this.$route.params.id
                });
                this.deleteTask();
                alert('Урок сохранён!!!');
            },
            reset() {
                this.lessonData = _.cloneDeep(this.oldLessonData);
            },
            addRemove(taskId) {
                this.removeList = _.union([taskId], this.removeList);
            },
            restore(taskId) {
                let index = this.removeList.indexOf(taskId);
                this.removeList.splice(index, 1);
            },
            isShow(taskId) {
                return this.removeList.indexOf(taskId) === -1;
            },
            newTask() {
                this.$router.push({name: 'createTask', params: {id: this.$route.params.id}});
            },
            editTask(id) {
                this.$router.push({name: 'editTask', params: {id: this.$route.params.id, task: id}});
            },
            setData(itemLesson) {
                this.lessonData = _.clone(itemLesson);
                this.oldLessonData = _.cloneDeep(itemLesson);
            }
        },
        mounted: function () {
            this.$nextTick(function () {
                this.setData(this.itemLesson);
            })
        }
    }
</script>

<style scoped>

</style>