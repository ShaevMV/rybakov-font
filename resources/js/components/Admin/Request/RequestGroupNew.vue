<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Создание группы</h4>
        </div>
        <div class="panel-footer">
            <div class="input-group">
                <input type="text"
                       v-model="name"
                       class="form-control"
                       placeholder="Введите название для группы заявок"
                       required="">
                <span class="input-group-btn">
                        <button class="btn btn-primary" @click="save()">Создать</button>
                </span>
            </div>
            <span class="error">{{getError('name')}}</span>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "request-group-new",
        data() {
            return {
                name: '',
            }
        },
        computed:{
            ...mapGetters([
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appRequest',[
                'createRequestGroup'
            ]),
            save(){
                let app = this;
                this.createRequestGroup({
                    name: this.name,
                    type: this.$route.params.type,
                    level: this.$route.params.level,
                    callback: function () {
                        app.name = '';
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>