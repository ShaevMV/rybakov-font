<template>
    <div>
        <div class="alert alert-success" v-if="massage">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>{{massage}}</strong>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Создание урока</h4>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" name="name"
                           v-model="title"
                           class="form-control"
                           placeholder="Введите название урока"
                           required="">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" @click="save()">Создать урок</button>
                    </span>

                </div>
                <span class="error">{{getError('title')}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';

    export default {
        name: "new-lesson",
        props: ['showForm'],
        data() {
            return {
                title: '',
                massage: '',
            }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),

        },
        methods: {
            ...mapActions('appLesson', [
                'addLesson'
            ]),
            /**
             * Сохранение
             */
            save() {
                this.addLesson({
                    data: {
                        title: this.title,
                        type: this.$route.params.type
                    },
                    callback: this.setAlert
                });

                this.title = '';

            },
            setAlert(message) {
                this.massage = message;
            }
        }
    }
</script>

<style scoped>

</style>