<template>
    <div>
        <div class="row">
            <div class="col-md-9">
                <h3>Онлайн обучение</h3>
            </div>

        </div>
        <hr>
        <table class="table table">
            <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th>Название</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(lesson, idx) in getListLesson" :key="idx">
                    <td>{{lesson.id}}</td>
                    <td>{{lesson.title}}  ({{lesson.tasks.length}}  задач)</td>
                    <td>
                        <router-link type="button" class="btn btn-primary"
                                     :to="{name: 'lessonsEdit', params: {id: lesson.id}}">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </router-link>
                        <button type="button" class="btn btn-danger" @click="deleteLesson(lesson)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <new-lesson></new-lesson>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';

    import NewLesson from "./NewLisson";

    export default {
        components: {
            NewLesson
        },
        name: "List",
        data() {
            return {
                showForm: false
            }
        },
        methods: {
            ...mapActions('appLesson', [
                'removeLesson',
                'loadLesson'
            ]),
            /**
             * Удаление урока
             * @param lesson
             */
            deleteLesson(lesson) {
                if (confirm('Удалить выбранный урок?')) {
                    this.removeLesson({
                        data: {
                            id: lesson.id
                        },
                        type: this.$route.params.type
                    });
                }
            },


        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appLesson/loadLesson', {
                type: to.params.type,
                next: next
            });
        },
        beforeRouteUpdate (to, from, next) {
            this.loadLesson({
                type: to.params.type,
                next: next
            });

        },
        computed: {
            ...mapGetters('appLesson', [
                'getListLesson'
            ]),

        }
    }
</script>

<style scoped>

</style>