<template>
    <div>
        <div class="panel panel-default" v-for="(item,index) in params">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-10">Мнение эксперта {{index+1}}</div>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Имя эксперта</label>
                                <input class="form-control" type="text" v-model="item.params.name"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Текст мнения</label>
                                <textarea class="form-control" v-model="item.params.text"></textarea>
                            </div>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Загруженное фото эксперта</label>
                                <img :src="getImage(item.key)" style="width: 150px;"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Загрузить фото</label>
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
    import axios from 'axios';
    import _ from 'lodash';

    export default {
        mixins: [mixin],
        name: "experts",
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
        }
    }
</script>

<style scoped>

</style>