<template>
    <div class="inner_section">
        <div class="container uk-flex inner_content">
            <div class="left_kg">
                <div class="acc_data">
                    <!-- добавить .office_edit_active для редактирования полей-->
                    <form class="form_overlay_block border_4" :class="edit ? 'office_edit_active' : ''" @submit.prevent="send">
                        <div class="kg_acc_header_block uk-flex uk-flex-between">
                            <h2 class="uk-text-uppercase font-26 uk-margin-remove uk-text-left"> Личные данные</h2>
                            <a class="kg_pencil"
                               @click="edit = !edit"
                               v-bind:class="{'active': edit}"></a>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                            <!-- У input_wrapper есть классы success и failed-->
                            <label for="inp_org">Организация</label>
                            <input id="inp_org" type="text" v-model="organization.name_organization" :disabled="!edit">
                            <span class="error">{{getError('organizations.name_organization')}}</span>
                        </div>
                        <div class="double_block uk-flex uk-flex-wrap">
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_fio_lead">ФИО представителя</label>
                                <input id="inp_fio_lead" type="text" :disabled="!edit" v-model="user.name" required>
                                <span class="error">{{getError('users.name')}}</span>
                            </div>
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_post">Должность</label>
                                <input id="inp_post" required type="text" :disabled="!edit" v-model="user.position">
                                <span class="error">{{getError('users.position')}}</span>
                            </div>
                        </div>
                        <div class="double_block uk-flex uk-flex-wrap">
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_phone">Мобильный телефон</label>
                                <input class="tel-mask" id="inp_phone" required type="text" :disabled="!edit" v-model="user.phone">
                                <span class="error">{{getError('users.phone')}}</span>
                            </div>
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_mail">Электронная почта</label>
                                <input id="inp_mail" required="required" type="email" :disabled="!edit" v-model="user.email">
                                <span class="error">{{getError('users.email')}}</span>
                            </div>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                            <!-- У input_wrapper есть классы success и failed-->
                            <label for="inp_adr">Адрес</label>
                            <input id="inp_adr" type="text" :disabled="!edit" v-model="organization.address">
                            <span class="error">{{getError('organizations.address')}}</span>
                        </div>
                        <div class="double_block uk-flex uk-flex-wrap hidden_inputs">
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_pas2">Пароль*</label>
                                <input id="inp_pas2" type="password" :disabled="!edit" v-model="password">
                                <span class="error">{{getError('users.password')}}</span>
                            </div>
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_rep_pas2">Повторите пароль*</label>
                                <input id="inp_rep_pas2" v-model="password_confirmation" type="password" :disabled="!edit">
                            </div>
                        </div>
                        <button class="button_continue button_save button_form" type="submit">Сохранить</button>
                        <badges></badges>
                        <a class="custom_link cancel_absolute cancel_form"
                           @click="edit = !edit">
                            Отменить
                        </a>
                    </form>
                </div>
            </div>

            <evaluate></evaluate>
        </div>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import _ from 'lodash';
    import Inputmask from 'inputmask';
    import Badges from "./Badges";
    import Evaluate from "./Evaluate";

    export default {
        components: {
            Evaluate,
            Badges},
        name: "KGOffice",
        data: () => ({
            password: null,
            password_confirmation: null,
            position: null,
            edit: false,
            user: {},
            organization: {},
            isStaff: false
        }),
        computed: {
            ...mapGetters([
                'getUser',
                'getError'
            ]),

            getOrganization(index) {
                if (typeof this.organization[index] === 'undefined') {
                    this.organization[index] = '';
                }
                return this.organization[index];
            }
        },

        methods: {
            ...mapActions('appLogin', [
                'updateUser'
            ]),
            send() {
                if (this.password !== null) {
                    this.user['password'] = this.password;
                    this.user['password_confirmation'] = this.password_confirmation;
                }{
                    let app = this;
                    this.updateUser({
                        users: this.user,
                        position: this.position,
                        organizations: this.organization,
                        staff: true
                    }).then(function () {
                        app.edit = false;
                    });
                }

            }
        },

        mounted() {
            let im = new Inputmask("+7 999-999-99-99");
            im.mask(document.getElementById('inp_phone'));
            this.user = _.cloneDeep(this.getUser);

            this.isStaff = this.getUser.organizations !== null;
            if (this.isStaff) {
                this.organization = _.cloneDeep(this.getUser.organizations);
            } else {
                this.organization = {
                    address: '',
                    name_organization: ''
                };
            }
        }
    }
</script>
<style scoped>

</style>