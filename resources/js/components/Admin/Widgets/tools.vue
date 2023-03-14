<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-footer">
                <div class="form-group"  v-for="item in params">
                    <label class="col-sm-1 control-label">{{getLabel(item.key)}}</label>
                    <div class="col-sm-11">
                        <input class="form-control"
                               type="text"
                               :placeholder="getLabel(item.key)"
                               v-model="item.params" title=""/>
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
        name: "tools",
        methods: {
            /**
             * Вывести название
             *
             * @param key
             * @return {string}
             */
            getLabel(key){
                switch (key) {
                    case 'ecers':
                        return 'ECERS';
                    case 'nokgo':
                        return 'НОКДО';
                }
            },
        }
    }
</script>

<style scoped>

</style>