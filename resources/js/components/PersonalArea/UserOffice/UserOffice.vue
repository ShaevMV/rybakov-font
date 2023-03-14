<template>
    <div class="inner_section">
        <div class="container uk-flex inner_content">
            <div class="left_kg">
                <div class="acc_data">
                    <!-- добавить .office_edit_active для редактирования полей-->
                    <div class="form_overlay_block border_4">
                        <div class="kg_acc_header_block uk-flex uk-flex-between">
                            <h2 class="uk-text-uppercase font-26 uk-margin-remove uk-text-left"> Личные данные</h2>
                            <a class="kg_pencil"
                               v-bind:class="{'active': !edit}"
                               @click="onEdit"></a>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                            <!-- У input_wrapper есть классы success и failed-->
                            <label for="inp_org">Фамилия, имя, отчество</label>
                            <input id="inp_org" type="text" v-model="user.name" v-bind:disabled="edit">
                            <span class="error">{{getError('users.name')}}</span>
                        </div>

                        <div class="double_block uk-flex uk-flex-wrap">
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_phone">Телефон</label>
                                <input class="tel-mask" id="inp_phone" required="required" type="text"
                                       v-model="user.phone" v-bind:disabled="edit">
                                <span class="error">{{getError('users.phone')}}</span>
                            </div>
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_mail">Электронная почта</label>
                                <input id="inp_mail"
                                       required="required"
                                       type="email"
                                       v-model="user.email"
                                       v-bind:disabled="edit">
                                <span class="error">{{getError('users.email')}}</span>
                            </div>
                            <div class="input_checkbox">
                                <input type="checkbox" name="agree_p_data" v-model="isStaff" value="true"
                                       id="checkbox_kg_emp" v-bind:disabled="edit">
                                <label for="checkbox_kg_emp"> Являюсь сотрудником детского сада</label>
                            </div>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active"
                             v-bind:class="{'hidden_inputs': !isStaff}">
                            <!-- У input_wrapper есть классы success и failed-->
                            <label for="inp_kg">Детский сад</label>
                            <input id="inp_kg" type="text" v-model="organization.name_organization"
                                   v-bind:disabled="edit">
                            <span class="error">{{getError('organizations.name_organization')}}</span>
                        </div>
                        <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active"
                             v-bind:class="{'hidden_inputs': !isStaff}">
                            <!-- У input_wrapper есть классы success и failed-->
                            <label for="inp_adr">Адрес</label>
                            <input id="inp_adr" type="text" v-model="organization.address"
                                   v-bind:disabled="edit">
                            <span class="error">{{getError('organizations.address')}}</span>
                        </div>
                        <div class="double_block uk-flex uk-flex-wrap" v-bind:class="{'hidden_inputs': edit}">
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_pas2">Пароль*</label>
                                <input id="inp_pas2" v-model="password" type="password">
                                <span class="error">{{getError('users.password')}}</span>
                            </div>
                            <div class="input_wrapper uk-flex uk-flex-column uk-flex-center active">
                                <label for="inp_rep_pas2">Повторите пароль*</label>
                                <input id="inp_rep_pas2" v-model="password_confirmation" type="password">
                            </div>
                        </div>
                        <a class="button_continue button_save"
                           @click="send()"
                           v-bind:class="{'button_form':edit}">Сохранить</a>
                        <sertificat-list></sertificat-list>
                        <a class="custom_link cancel_absolute" v-bind:class="{'cancel_form':edit}">Отменить</a>
                    </div>
                </div>
            </div>
            <!-- Добавить .no-active при клике на карандаш-->
            <link-courses></link-courses>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import _ from 'lodash';
    import Inputmask from 'inputmask';
    import SertificatList from "./SertificatList";
    import LinkCourses from "./LinkCourses";

    export default {
        components: {
            LinkCourses,
            SertificatList},
        name: "user-office",
        data() {
            return {
                edit: true,
                password: null,
                password_confirmation: null,
                user: {},
                organization: {
                    address: '',
                    name_organization: ''
                },
                isStaff: false
            }
        },
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
            ...mapActions([
                'initDataUser'
            ]),
            send() {
                if(this.password !== null){
                    this.user['password'] = this.password;
                    this.user['password_confirmation'] = this.password_confirmation;
                }
                this.updateUser({
                    users: this.user,
                    organizations: this.organization,
                    staff: this.isStaff,
                    callback: this.callbackSave
                });

            },
            onEdit(){
                if(!this.edit){
                    this.initDataUser();
                    this.clone();
                }
                this.edit = !this.edit
            },
            callbackSave(){
                alert('Данные пользователя обновлены');
                this.edit = true;
            },
            clone(){
                this.user = _.cloneDeep(this.getUser);
                this.isStaff = this.getUser.organizations !== null;
                if (this.isStaff) {
                    this.organization = _.cloneDeep(this.getUser.organizations);
                }
            }
        },
        mounted() {
            let im = new Inputmask("+7 999-999-99-99");
            im.mask(document.getElementById('inp_phone'));
            this.clone();
        }
    }
</script>

<style scoped>

</style>