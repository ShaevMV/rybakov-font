<template>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <ul class="nav nav-tabs nav-justified">
                <li v-bind:class="{active: selectTabs === index}"
                    v-for="(item,index) in listWidgets">
                    <a data-toggle="tab"
                       @click="selectTabs = index"
                       :href="'#tab_'+index">{{getRusName(item.template)}}</a>
                </li>
            </ul>
            <div class="tab-content">
                <br />
                <div :id="'tab_'+index"
                     class="tab-pane"
                     v-bind:class="{active: selectTabs === index}"
                     v-for="(item,index) in listWidgets">
                    <div class="form-horizontal form-bordered">
                        <div class="panel panel-default">
                            <div class="panel-body nopadding">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Заголовок</label>
                                    <div class="col-sm-4">
                                        <input type="text"
                                               placeholder="Заголовок"
                                               class="form-control"
                                               v-model="item.title">
                                    </div>
                                    <label class="col-sm-1 control-label">Порядок</label>
                                    <div class="col-sm-4">
                                        <input type="number"
                                               placeholder="Порядок отображения"
                                               class="form-control"
                                               v-model="item.sort">
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="checkbox block">
                                            <label>
                                                <input type="checkbox" v-model="item.active">Активность
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><b>Элементы</b></h4>
                                <p>Элементы в виджете</p>
                            </div>
                            <div class="panel-body nopadding">
                                <component v-bind:is="item.template"
                                           :template="item.template"
                                           :params="item.params"
                                           :joinData="item.items"
                                           v-on:saveComponent="sumbit"
                                           :data_join="item.data_join"
                                ></component>
                                <button class="btn btn-primary btn-rounded"
                                        @click="addParams(item)"
                                        v-if="isAddParams(item)">Добавить элемент
                                </button>

                            </div>
                        </div>
                    </div>

                </div><!-- tab-pane -->
            </div><!-- tab-content -->
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import axios from 'axios'
    import Slider from "./slider";
    import Participation from "./participation";
    import Work from "./work";
    import Tools from "./tools";
    import Sponsor from "./sponsor";
    import Talking from "./talking";
    import YouTube from "./youTube";
    import Experts from "./experts";
    import Reviews from "./reviews";

    export default {
        name: "list-widgets",
        components: {
            Reviews,
            Experts,
            YouTube,
            Talking,
            Sponsor,
            Tools,
            Work,
            Participation,
            Slider},
        data(){
            return {
                selectTabs: 0,
                listWidgets:[]
            }
        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appWidgets/getListWidgetForAdmin')
                    .then(response => {
                        vm.listWidgets = response.data;
                    });
            })
        },
        computed: {},
        methods:{
            ...mapActions('appWidgets',[
                'getListWidgetForAdmin'
            ]),

            /**
             * Вывести русское название шаблона
             *
             * @param name
             * @return {string}
             */
            getRusName(name){
                switch (name){
                    case 'slider':
                        return 'Слайдер';
                    case 'participation':
                        return 'Участие';
                    case 'work':
                        return 'Работа';
                    case 'tools':
                        return 'Инструменты';
                    case 'sponsor':
                        return 'Спонсор';
                    case 'talking':
                        return 'Оценки';
                    case 'youTube':
                        return 'Видео';
                    case 'experts':
                        return 'Эксперты';
                    case 'reviews':
                        return 'Oтзывы';
                }
            },

            /**
             * Проверить возможность добавить группу праметров
             *
             * @param widget
             * @return {boolean}
             */
            isAddParams(widget) {
                if (typeof widget.countParams !== 'undefined') {
                    return widget.countParams === 'array' ? true :
                        widget.params.length < widget.countParams;
                }
            },
            /**
             * Добавить параметр
             *
             * @param widget
             */
            addParams(widget) {
                axios.get('/api/v1/widget/getNewParams/' + widget.template)
                    .then(response => {
                        widget.params.push({
                            key: widget.params.length,
                            params: response.data.param
                        });
                    })
            },
            /**
             * Найти и отправить элемент на сохранение
             *
             * @param data
             * @param template
             * @param del
             */
            sumbit: function (data, template, del = []) {
                let elemParams = [];
                let title = '';
                let sort = 0;
                let active = true;
                this.listWidgets.forEach(function (item) {
                    if (item.template === template) {
                        title = item.title;
                        sort = item.sort;
                        elemParams = item.params;
                        active = item.active;
                    }
                });
                if (elemParams.length > 0 && del.length > 0) {
                    elemParams = this.delParams(elemParams, del);
                }

                axios.post('/api/v1/widget/update/' + template, {
                    params: this.getParamsForSubmit(elemParams),
                    title: title,
                    sort: sort,
                    active: active,
                    data: data
                }).then(function () {
                    this.getListWidgetForAdmin();
                });

            },
            /**
             * Удаление элементов, которые отмеченые на удаление
             *
             * @param elemParams
             * @param del
             * @return {Array}
             */
            delParams(elemParams, del) {
                return _.filter(elemParams, function (item) {
                    if (del.indexOf(item.key) === -1) {
                        return true;
                    }
                });
            },
            /**
             * Вывести параметры для отправки на сохранение
             *
             * @param elemParams
             * @return {{}}
             */
            getParamsForSubmit(elemParams) {
                let result = {};
                elemParams.forEach(function (item) {
                    result[item.key] = item.params
                });
                return result
            }


        },

    }
</script>

<style scoped>

</style>