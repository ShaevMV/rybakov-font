<template>
    <div class="uk-flex-top modal_block_overlay uk-modal" id="ModalCompleted"
         data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block">
            <div class="custom_close_button uk-modal-close-outside uk-close uk-icon"
                 @click="close"
                 uk-close="">
                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></div>
            <img src="/images/content/arrow.svg">
            <p class="modal-par"  v-html="getMessageModal"></p>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "modal-completed",
        props: ['link'],
        methods:{
            close(){
                this.$router.push(this.link);
            },
        },
        computed: {
            ...mapGetters([
                'getMessageModal'
            ]),
        },
    }
</script>

<style scoped>

</style>