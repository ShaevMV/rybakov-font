<template>
    <div class="wrapper uk-flex uk-flex-center uk-flex-left">
        <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle">
            <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26"> Регистрация</h2>
            <div class="form_overlay_block uk-margin-medium-bottom uk-padding-remove">
                <div class="switcher_block">
                    <ul class="uk-margin-remove uk-flex" id="ul_switcher">
                        <li class="reg_par0"
                            @click="userType = true"
                            v-bind:class="{'active_link' : userType}">Как пользователь</li>
                        <li class="reg_par1"
                            @click="userType = false"
                            v-bind:class="{'active_link' : !userType}">Как детский сад</li>
                    </ul>
                </div>
                <div class="as_user padding-form" v-bind:class="{hidden : !userType}">
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                        <!-- У input_wrapper есть классы success и failed-->
                        <input v-model="user.name"
                               type="text"
                               required="required"
                               placeholder="Фамилия, имя и отчество*">
                        <span class="error">{{getError('name')}}</span>
                    </div>
                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="user.phone"
                                   id="inp_phone"
                                   placeholder="Телефон*"
                                   type="text">
                            <span class="error">{{getError('phone')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="user.email"
                                   placeholder="Электронная почта*"
                                   type="email">
                            <span class="error">{{getError('email')}}</span>
                        </div>
                    </div>
                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="user.password"
                                   placeholder="Пароль*"
                                   type="password">
                            <span class="error">{{getError('password')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="user.password_confirmation"
                                   placeholder="Повторите пароль*"
                                   type="password">
                        </div>
                    </div>
                    <div class="uk-flex uk-flex-wrap">
                        <div class="input_checkbox">
                            <input type="checkbox" name="agree_p_data" v-model="user.staff" id="checkbox_kg_emp">
                            <label for="checkbox_kg_emp"> Являюсь сотрудником детского сада</label>
                        </div>
                    </div>
                    <div class="add_check_block" v-bind:class="{hidden: !user.staff}">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input placeholder="Детский сад*"
                                   v-model="user.kindergarten"
                                   type="text">
                            <span class="error">{{getError('kindergarten')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input placeholder="Адрес детского сада*"
                                   v-model="user.kindergartenAddress"
                                   type="text">
                            <span class="error">{{getError('kindergartenAddress')}}</span>
                        </div>
                    </div>
                    <div class="mistake_alert hidden"> Заполните все необходимые поля
                        <!-- добавить visible для отображения-->
                    </div>
                    <div class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom" @click="send">
                        Зарегистрироваться
                    </div>
                </div>
                <div class="as_kg padding-form" v-bind:class="{hidden : userType}">
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                        <input type="text"
                               v-model="kindergarten.organization"
                               placeholder="Организация*">
                        <span class="error">{{getError('organization')}}</span>
                    </div>
                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="kindergarten.name"
                                   placeholder="ФИО представителя*"
                                   type="text">
                            <span class="error">{{getError('name')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="kindergarten.position"
                                   placeholder="Должность*"
                                   type="text">
                            <span class="error">{{getError('position')}}</span>
                        </div>
                    </div>
                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input  v-model="kindergarten.phone"
                                    placeholder="Телефон*"
                                    id="inp_tel"
                                    type="text">
                            <span class="error">{{getError('phone')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="kindergarten.email"
                                   placeholder="Электронная почта*"
                                   type="email">
                            <span class="error">{{getError('email')}}</span>
                        </div>
                    </div>
                    <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                        <!-- У input_wrapper есть классы success и failed-->

                        <input v-model="kindergarten.address"
                               placeholder="Адрес*"
                               type="text">
                        <span class="error">{{getError('address')}}</span>
                    </div>
                    <div class="double_block uk-flex uk-flex-wrap">
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="kindergarten.password"
                                   placeholder="Пароль*"
                                   type="password">
                            <span class="error">{{getError('password')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                            <input v-model="kindergarten.password_confirmation"
                                   placeholder="Повторите пароль*"
                                   type="password">
                        </div>
                    </div>
                    <div class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom" @click="send">
                        Зарегистрироваться
                    </div>
                </div>
            </div>
            <router-link class="go_back custom_link"
                         to="/">
                Вернуться на сервис
            </router-link>
        </div>

    </div>
</template>

<script>
    import Inputmask from 'inputmask';
    import {mapState, mapGetters, mapActions} from 'vuex';

    import ModalAfterRegister from "./modalAfterRegister";
    export default {
        components: {
            ModalAfterRegister
        },
        name: "register",
        data() {
            return {
                // данные пользователя
                user: {
                    name: '', // ФИО
                    email: '', //email
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    staff: false,
                    kindergarten: '', // детский сад,
                    kindergartenAddress: '', // детский сад,
                },
                // данные для регистрации детского сада
                kindergarten : {
                    organization: '', // организация
                    name: '', // ФИО
                    position: '', // должность
                    email: '', //email
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    address: ''
                },
                userType: true
            }
        },
        computed: {

            ...mapGetters([
                'getMessageModal',
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appLogin',[
                'registration'
            ]),
            /**
             * Регистрация
             */
            send(){
                let app = this;
                let data = {};
                if(this.userType){
                    data = this.user;
                } else {
                    data = this.kindergarten;
                }
                this.registration({
                    userType: this.userType,
                    data: data,
                    callback: function () {
                        app.user = {
                            name: '', // ФИО
                            email: '', //email
                            phone: '',
                            password: '',
                            password_confirmation: '',
                            staff: false,
                            kindergarten: '', // детский сад,
                            kindergartenAddress: '', // детский сад,
                        };
                        app.kindergarten = {
                            organization: '', // организация
                                name: '', // ФИО
                                position: '', // должность
                                email: '', //email
                                phone: '',
                                password: '',
                                password_confirmation: '',
                                address: ''
                        };
                        app.userType = true;
                        UIkit.modal("#ModalAfterReg").show();
                        //document.location.href="/";
                    }
                });
            },
        },
        mounted () {
            let im = new Inputmask("+7 999-999-99-99");
            im.mask(document.getElementById('inp_phone'));
            im.mask(document.getElementById('inp_tel'));
        }
    }
</script>

<style scoped>

</style>