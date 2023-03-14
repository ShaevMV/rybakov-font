<template>
    <div>
        <div class="panel panel-default"
             v-for="(item,index) in params">

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-10">Спонсор {{index+1}}</div>
                    <div class="col-sm-2 text-right">
                        <button class="btn btn-info btn-bordered"
                                v-if="!showElem(item.key)"
                                @click="restoreElem(item.key)">Восстановить
                        </button>
                        <button class="btn btn-primary btn-rounded" @click="del(item.key)" v-else>Удалить</button>
                    </div>
                </div>
            </div>
            <div class="panel-footer" v-if="showElem(item.key)">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <img :src="getImage(item.key)" style="width: 100%"/>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="control-label">Загрузить изображени</label>
                                <input class="form-control"
                                       type="file"
                                       :id="template+'image'+index"
                                       :ref="'image'+index"
                                       @change="previewFiles(item.key)"/>
                                <span class="error">{{getError(item.key)}}</span>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <button class="btn btn-primary btn-rounded"
                @click="save"
                style="float: right !important">Сохранить
        </button>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';

    export default {
        mixins: [mixin],
        name: "sponsor",
        methods: {

            /**
             * Отправить данные на сохранение
             */
            save() {
                this.$emit('saveComponent', {
                    newImage: this.getNewImageForSave(),
                }, this.template, this.delElem);
                this.image = [];
            },


        },
    }
</script>

<style scoped>

</style>