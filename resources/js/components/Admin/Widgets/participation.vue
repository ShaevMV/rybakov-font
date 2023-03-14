<template>
    <div>
        <div class="panel panel-default"
             v-for="(item, index) in getParamsType()">
            <div class="panel-body">
                {{item}}
            </div>
            <div class="panel-footer">
                <div class="form-group" v-for="(index, key) in getParams(index)">
                    <label class="col-sm-2 control-label">{{getLabel(key)}}</label>
                    <div class="col-sm-10">
                        <input class="form-control"
                               type="text"
                               :placeholder="getLabel(key)"
                               v-model="params[index].params"/>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-rounded"
                style="float: right !important"
                @click="save"
                >Сохранить
        </button>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        mixins: [mixin],
        name: "participation",
        methods: {
            /**
             * Вывести группы параметров
             *
             * @return {{Teacher: string, Kindergarten_Expert: string}}
             */
            getParamsType() {
                return {
                    'Teacher': 'Для педагогов',
                    'Kindergarten': 'Для детского сада'
                }
            },
            /**
             * Вывести параметры по определённому типу
             *
             * @param type
             * @return {{}}
             */
            getParams(type) {
                let result = {};
                this.params.forEach(function (item,index) {
                    if(item.key.indexOf(type) !== -1){
                        result[item.key] = index;
                    }
                });
                return result;
            },
            /**
             * Вывести заголовок для элемента
             *
             * @param label
             * @return {string}
             */
            getLabel(label){
                let result='';
                let char = label.substr(label.length - 1);

                if(!isNaN(+char)){
                    result = char + ' уровень';
                } else {
                    result = 'Название кнопка';
                }
                return result;
            },
            /**
             * Сохранить
             */
            save(){
                this.$emit('saveComponent',{}, this.template);
            }
        }
    }
</script>

<style scoped>

</style>