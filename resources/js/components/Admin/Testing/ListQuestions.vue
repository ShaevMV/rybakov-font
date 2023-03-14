<template>
    <div class="col-md-12">
        <h5 class="lg-title mb5">Список вопросов к тесту</h5>
        <p class="mb20">Описание теста</p>
        <textarea v-model="getTestingData.description" class="form-control" title="Описание теста"></textarea>
        <span class="error">{{getError('description')}}</span>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-primary mr5" @click="saveDescription()">Сохранить тест</button>
                    <button type="reset" class="btn btn-dark" @click="reset()">Отмена</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb30">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Вопрос</th>
                    <th>Тип</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in getListQuestions">
                    <td>{{item.id}}</td>
                    <td v-html="item.text"></td>
                    <td>{{rusType(item.type)}}</td>
                    <td>
                        <a @click="remove(item.id)"><span class="glyphicon glyphicon-trash"></span></a>
                        <a @click="selectQuestions(item)"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination-admin :callback="loadQuestions"></pagination-admin>
            <new-question :itemQuestions="itemQuestions"
                          :save="save"
                          :testId="getTestingData.id"></new-question>
        </div>

    </div>
</template>

<script>
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    import {mapState, mapGetters, mapActions} from 'vuex';
    import PaginationAdmin from "./paginationAdmin";
    import NewQuestion from "./NewQuestion";

    export default {
        components: {
            NewQuestion,
            PaginationAdmin
        },
        name: "list-questions",
        data() {
            return {
                editorConfig: {
                    // The configuration of the rich-text editor.
                },
                editor: ClassicEditor,
                description: '',
                itemQuestions:{}
            }
        },
        methods: {
            ...mapActions([
                'changePage'
            ]),
            ...mapActions('appTesting',[
                'saveQuestions'
            ]),
            ...mapActions('appTesting', [
                'loadListQuestions',
                'questionsDelete',
                'updateTestingDescription',
                'selectQuestions',
                'loadQuestions'
            ]),
            selectQuestions(item){
                let result = _.cloneDeep(item);
                result.options = typeof result.options !== 'undefined' ? JSON.parse(result.options): [];
                this.itemQuestions = result;
            },
            beforeSave(){
                this.itemQuestions = {
                    type: this.getTestingData.type !== 'testing' ? 'text': 'testing',
                    text:'',
                    options:[]
                };
                this.loadQuestions();
            },
            /**
             * Русские названия для типов
             *
             * @param type
             * @return {string}
             */
            rusType(type) {
                switch (type) {
                    case 'testing':
                    case 'option':
                        return 'Один вариант ответа';
                    case 'text':
                        return 'Письменный вопрос';
                    case 'many':
                        return 'Множество вариантов ответа';
                }
            },
            /**
             * Сохранить описание теста
             */
            saveDescription() {
                this.updateTestingDescription({
                    id: this.getTestingData.id,
                    data:{
                        description:this.getTestingData.description
                    },
                    callback:alert('Тест сохранён!!!')
                })
            },
            loadQuestions(){
                this.loadListQuestions({
                    type: this.$route.params.type,
                    level: this.$route.params.level
                })
            },
            save(){
                this.saveQuestions({
                    data: this.itemQuestions,
                    type: 'testing',
                    id: this.getTestingData.id,
                    callback: this.beforeSave,
                    typeQuestion: this.$route.params.type
                })
            },
            /**
             * Удалить вопрос из теста
             * @param id
             */
            remove(id) {
                this.questionsDelete({
                    id: id,
                    callback: this.loadQuestions
                });
            }
        },
        computed: {
            ...mapGetters('appTesting', [
                'getListQuestions',
                'getTestingData',
                'getItemQuestions'
            ]),

            ...mapGetters([
                'getError'
            ]),
        },

        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appTesting/loadListQuestions', {
                type: to.params.type,
                level: to.params.level,
                next: next
            });
        },
        beforeRouteUpdate(to, from, next) {
            this.changePage(1);
            this.loadListQuestions({
                type: to.params.type,
                level: to.params.level
            });
            this.description = _.clone(this.getTestingData.description);

            this.itemQuestions = {
                type: to.params.level !== '4' ? 'text': 'testing',
                text:'',
                options:[]
            };
            next();

        },
        mounted: function () {
            this.$nextTick(function () {
                this.description = _.clone(this.getTestingData.description);
                this.itemQuestions = {
                    type: this.getTestingData.type !== 'testing' ? 'text': 'testing',
                    text:'',
                    options:[]
                }
            })
        }
    }
</script>

<style scoped>

</style>