<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-footer">
                <div class="form-group"  v-for="item in params">
                    <label class="col-sm-2 control-label">Блок {{item.key + 1}}</label>
                    <div class="col-sm-5">
                        <input class="form-control"
                               type="text"
                               placeholder="Заголовок"
                               v-model="item.params.title"/>
                    </div>
                    <div class="col-sm-5">
                        <input class="form-control"
                               type="text"
                               placeholder="Текст"
                               v-model="item.params.text"/>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-rounded"
                style="float: right !important"
                @click="save">Сохранить
        </button>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        mixins: [mixin],
        name: "talking",
    }
</script>

<style scoped>

</style>