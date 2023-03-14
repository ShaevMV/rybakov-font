<template>
    <div class="uk-flex-top modal_block_overlay uk-modal"
         id="modalRequest"
         data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle width_modal padding_0"
             style="width: 950px!important;">
            <div class="custom_close_button uk-modal-close-outside uk-close uk-icon" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></div>
            <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1">
                <h2> Оформить заявку<br>на обучение</h2>
                <h3 class="grey-color uk-align-center" v-if="isUser"> {{level}} уровень обучения - двухдневный очный семинар</h3>
                <h3 class="grey-color uk-align-center" v-else> Оформить заявку на встречу с экспертом</h3>
                <div class="form_overlay_block width_modal_form">

                    <h2>Заполните контактную информацию</h2>
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                        <label for="inp_org">Фамилия, имя, отчество</label>
                        <input id="inp_org"
                               v-model="getUserForRequest.name"
                               type="text"
                               required="required">
                        <span v-if="getError('name')" class="error"> {{getError('name')}}</span>
                    </div>

                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                            <label for="inp_phone">Мобильный телефон*</label>
                            <input class="tel-mask"
                                   id="inp_phone"
                                   v-model="getUserForRequest.phone"
                                   required="required"
                                   type="text">
                            <span v-if="getError('phone')" class="error"> {{getError('phone')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                            <label for="inp_mail">Электронная почта*</label>
                            <input id="inp_mail"
                                   required="required"
                                   v-model="getUserForRequest.email"
                                   type="email">
                            <span v-if="getError('email')" class="error"> {{getError('email')}}</span>
                        </div>
                    </div>
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                        <label for="inp_town"> Город, в котором хотите провести встречу*</label>
                        <select id="inp_town" v-model="getUserForRequest.city" required="required">
                            <option value="Москва">г. Москва</option>
                            <option value="Казань">г. Казань</option>
                            <option value="Санкт-Петербург">г. Санкт-Петербург</option>
                            <option value="Сочи">г. Сочи</option>
                            <option value="Краснодар">г. Краснодар</option>
                            <option value="Киев">г. Киев</option>
                            <option value="Челябинск">г. Челябинск</option>
                        </select>
                        <span v-if="getError('city')" class="error"> {{getError('city')}}</span>
                    </div>


                </div>
            </div>
            <div class="buttons_block uk-flex uk-flex-center uk-flex-middle">
                <a class="button_cancel button_medium"> Назад</a>
                <a class="button_continue button_medium" @click="save()"> Продолжить</a>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import Inputmask from 'inputmask';
    import _ from 'lodash';

    export default {
        name: "modal-request",
        props: {
            level: {
                type: Number,
                default: 0,
            },
            typeRequest: {
                type: String,
                default: '',
            },
            callback: Function,
        },
        computed: {
            ...mapGetters([
                'getUserForRequest',
                'getError'
            ]),

            isUser(){
                return this.level < 4;
            }
        },
        methods: {
            ...mapActions('appRequest', [
                'requestGroupTraining'
            ]),
            save(){
                this.requestGroupTraining({
                    user: this.getUserForRequest,
                    level: this.level,
                    type: this.typeRequest,
                    callback: function () {
                        UIkit.modal("#modalRequest").hide();
                        UIkit.modal("#ModalCompleted").show();
                    }
                })
            },

        },
        mounted() {
            let im = new Inputmask("+7 999-999-99-99");
            im.mask(document.getElementById('inp_phone'));
        }

    }
</script>

<style scoped>

</style>