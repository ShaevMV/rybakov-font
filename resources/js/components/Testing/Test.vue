<template>
    <div class="wrapper uk-flex uk-flex-center uk-flex-left">
        <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle form_test">
            <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26"> {{getNameTest}}</h2>
            <h3 class="grey-color uk-margin-remove" v-html="">{{getTesting.description}}</h3>
            <list-questions></list-questions>
            <pagination></pagination>

            <a class="button_finish_test"
               @click="submitTesting()"
               v-if="getTesting.type === 'test'">Завершить</a>
            <modal-error></modal-error>
            <modal-completed
                    :link="'/training/'+$route.params.type"></modal-completed>
            <a class="button_finish_test"
               v-if="getTesting.type === 'testing'"
               @click="openMailModal()">Завершить</a>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import ListQuestions from "./ListQuestions";

    import Pagination from "./Pagination";
    import ModalError from "./ModalError";
    import ModalCompleted from "../ModalCompleted";
    import Modal from "./ModalRequestAfterTest";
    import ModalEndLesson from "../Lesson/ModalEndLesson";


    export default {
        components: {
            ModalEndLesson,
            Modal,
            ModalCompleted,
            ModalError,
            Pagination,

            ListQuestions},
        props:['type','level'],
        name: "test",
        computed: {
            ...mapGetters('appTesting', [
                'getTesting',
                'getDirectionName'
            ]),
            getNameTest(){
                if(this.$route.params.level === "1"){
                    return 'Самооценка с использованием инструмента оценки качества дошкольного образования ' + this.getDirectionName
                } else {
                    return 'Тест ' + this.getDirectionName
                }
            },
        },
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appTesting/loadListQuestions', {
                type: to.params.type,
                level: to.params.level,
            });
            store.dispatch('appTesting/clearAnswered');

            next();

        },
        methods:{
            ...mapActions([
                'setTypeDirection',
                'setLevel'
            ]),

            ...mapActions('appTesting',[
                'submitTesting',
                'pushTestingInEmail',
                'validateTesting'
            ]),
            openMailModal(){
                this.pushTestingInEmail({
                    type: this.$route.params.type,
                    idTesting: this.getTesting.id,
                    callback: function(){
                        $("#MailModalTesting").remove();
                        let modal = UIkit.modal("#ModalTesting");
                        modal.show();
                    },
                    errorCallback:function () {
                        UIkit.modal("#modalErrorTesting").show();
                    },
                });
            }
        },
        mounted() {
            this.setTypeDirection(this.type);
            this.setLevel(this.level);
        }

    }
</script>

<style scoped>

</style>