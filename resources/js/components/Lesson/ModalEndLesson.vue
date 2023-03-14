<template>
    <div class="uk-flex-top modal_block_overlay uk-modal" id="ModalEndLesson"
         data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block">
            <div class="custom_close_button uk-modal-close-outside uk-close uk-icon"
                 @click="$router.push('/training/'+$route.params.type)"
                 uk-close="">
                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg>
            </div>
            <p class="modal-par" v-html="getMessageModal"></p>
            <a class="button_continue button_medium" @click="close"> Продолжить</a>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "modal-message",
        computed: {
            ...mapState([
                'selectDirection'
            ]),
            ...mapGetters([
                'getDirectName',
                'getMessageModal'
            ]),
        },
        methods:{
            close(){
                UIkit.modal("#ModalEndLesson").hide();
                this.$router.push('/training/'+ this.$route.params.type);

            }
        }
    }
</script>

<style scoped>

</style>