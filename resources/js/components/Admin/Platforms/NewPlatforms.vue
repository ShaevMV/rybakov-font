<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Название</label>
                            <input type="email" v-model="item.title" class="form-control" title="Название">
                            <label class="error">{{getError('title')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Ссылка</label>
                            <input type="text" v-model="item.link" class="form-control" title="Ссылка">
                            <label class="error">{{getError('link')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Активность</label>
                            <select class="form-control" v-model="item.active">
                                <option value="1">да</option>
                                <option value="0">нет</option>
                            </select>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" @click="save()">Сохранить\Добавить</button>
            </div>
        </div><!-- panel -->

    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "new-platforms",
        props:['item'],
        computed: {
            ...mapGetters([
                'getError',
            ]),
        },
        methods:{
            ...mapActions('appStatic',[
                'addPlatforms'
            ]),
            save(){
                let app = this;
                this.addPlatforms({
                    platforms: this.item,
                    callback: function(){
                        app.item = {
                            id: null,
                            title: '',
                            link: '',
                            active: 0,
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>