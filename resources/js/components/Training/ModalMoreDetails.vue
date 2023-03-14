<template>
    <div class="uk-flex-top modal_block_overlay uk-modal"
         id="modalMoreDetails">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle width_modal padding_0"
             style="width: 950px!important;">
            <div class="custom_close_button uk-modal-close-outside uk-close uk-icon" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></div>
            <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1">
                <h2> Подробная информация</h2>
                <div class="form_overlay_block width_modal_form"
                     v-html="textMoreDetails">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import Inputmask from 'inputmask';
    import _ from 'lodash';

    export default {
        name: "modal-more-details",
        props: {
            textMoreDetails: {
                type: String,
                default: '',
            }
        },

    }
</script>

<style scoped>

</style>