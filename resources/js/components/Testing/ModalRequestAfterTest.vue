<template>
    <div class="uk-modal-container modal_block_overlay uk-modal" id="ModalTesting"
         data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block">
            <p class="modal-par" v-html="getMessageModal"></p>

                <a class="button_continue button_medium uk-margin-small-bottom button_continue--large" @click="closePushRequest">Подать заявку</a>
                <a class="button_continue button_medium button_continue--large" @click="closePushCabinet"> Завершить и подать заявку позже</a>

        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "modal-request-after-test",
        methods: {
            ...mapActions('appTesting', [
                'pushTestingInEmail'
            ]),
            closePushRequest() {
                UIkit.modal("#ModalTesting").hide();
                this.$router.push({
                    name: 'evalTraining' , params: {
                        type: this.$route.params.type,
                        OpenModalRequest: true
                    }
                });
            },
            closePushCabinet() {
                UIkit.modal("#ModalTesting").hide();
                this.$router.push({
                    name: 'cabinet'
                });
            }
        },
        computed: {
            ...mapState([
                'selectDirection'
            ]),
            ...mapGetters([
                'getDirectName',
                'getMessageModal'
            ]),
        },
    }
</script>

<style scoped>

</style>
