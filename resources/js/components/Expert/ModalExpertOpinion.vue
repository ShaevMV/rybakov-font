<template>
    <div class="uk-flex-top modal_block_overlay" id="modalExpertOpinion" data-uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block padding-form">
            <div data-uk-close="" class="custom_close_button uk-modal-close-outside uk-close uk-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"
                     data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg>
            </div>
            <div class="form_overlay_block uk-padding-remove width-100 no-shadow">
                <h3 class="uk-text-center uk-text-capitalize h2-header uk-align-center font-26">Экспертное
                    заключение</h3>
                <div class="form_overlay_block width-100 test_block test_box margin_bottom_40">
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                        <!-- У input_wrapper есть классы success и failed-->
                        <textarea id="inp_comment" v-model="comment" type="text" title="Экспертное заключение"></textarea>
                    </div>
                    <div class="uk-flex uk-flex-wrap">
                        <div class="input_checkbox">
                            <input type="checkbox" name="agree_p_data" id="checkbox_form_1" v-model="access">
                            <label for="checkbox_form_1"> Присвоить значок </label>
                        </div>
                    </div>
                </div>
                <a class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom"
                   @click="submit()"> Отправить</a>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "modal-expert-opinion",
        props:['trainingId'],
        data() {
            return {
                comment: '',
                access: false,
            }
        },
        methods: {
            ...mapActions('appExpert', [
                'setExpertOpinion'
            ]),
            submit() {
                let app = this;
                this.setExpertOpinion({
                    data: {
                        comment: this.comment,
                        access: this.access
                    },
                    training_id: this.trainingId
                }).then(function () {
                    app.comment = '';
                    app.access = false;
                    UIkit.modal("#modalExpertOpinion").hide();
                })
            }
        },

    }
</script>

<style scoped>

</style>