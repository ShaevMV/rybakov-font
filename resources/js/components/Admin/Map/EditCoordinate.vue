<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Назначить координаты</h4>
            </div><!-- panel-heading -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Длина</label>
                            <input type="text"
                                   v-model="item.long"
                                   id="long"
                                   class="form-control"
                                   title="Длина">
                            <span class="error">{{getError('long')}}</span>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Ширина</label>
                            <input type="text"
                                   v-model="item.width"
                                   id="width"
                                   class="form-control"
                                   title="Ширина">
                            <span class="error">{{getError('width')}}</span>
                        </div><!-- form-group -->
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" @click="$emit('save')">Сохранить</button>
                </div>
            </div><!-- panel -->

        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapState} from 'vuex';
    import Inputmask from 'inputmask';
    export default {
        name: "edit-coordinate",
        props: ['item'],
        methods: {
            ...mapActions('appKindergarten',[
                'saveKindergarten',
                'loadKindergartenList'
            ]),
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),
            isSelectKindergarten(){
                return typeof this.selectKindergarten.id !== 'undefined'
            }
        },
        mounted () {
            let im = new Inputmask("99.9999999");
            im.mask(document.getElementById('long'));
            im.mask(document.getElementById('width'));
        }
    }
</script>

<style scoped>

</style>