<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-footer">
                <div class="form-group"  v-for="item in params">
                    <label class="col-sm-3 control-label">Hash ссылка на youtube ролик</label>
                    <div class="col-sm-3">
                        <input class="form-control"
                               type="text"
                               placeholder="Заголовок"
                               v-model="item.params"/>
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
        name: "you-tube",
    }
</script>

<style scoped>

</style>