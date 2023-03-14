<template>
    <div>
        <div class="panel panel-default"
             v-for="(item,index) in params">

            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-10">
                        Слайдер {{index+1}}
                    </div>
                    <div class="col-sm-2 text-right">
                        <button class="btn btn-info btn-bordered" v-if="!showElem(item.key)" @click="restoreElem(item.key)">Восстановить</button>
                        <button class="btn btn-primary btn-rounded" @click="del(item.key)" v-else>Удалить</button>
                    </div>
                </div>

            </div>
            <div class="panel-footer" v-if="showElem(item.key)">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Заголовок</label>
                                <input type="text" placeholder="Заголовок" class="form-control" v-model="item.params.title">
                            </div>

                            <div class="form-group" v-show="false">
                                <label class="control-label">Ссылка</label>
                                <input class="form-control" type="text" placeholder="Ссылка" v-model="item.params.href"/>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Текст кнопки</label>
                                <input type="text" placeholder="Название кнопки" class="form-control" v-model="item.params.button">
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1"></div>

                        <div class="col-md-5 col-lg-5">
                            <div class="form-group">
                                <label class="control-label">Загруженное изображение</label>
                                <div>
                                    <img :src="getImage(item.key)" style="width: 180px;"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <input class="form-control"
                                       type="file"
                                       :id="template+'image'+item.key"
                                       :ref="'image'+item.key"
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
    import axios from 'axios'
    import {mixin} from './mixin.js';
    import _ from 'lodash';
    import ModalError from "../../Testing/ModalError";

    export default {
        components: {ModalError},
        name: "slider",
        mixins: [mixin],
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
        mounted() {
            //   this.data =
        }

    }
</script>

<style scoped>

</style>