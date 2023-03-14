<template>
    <div class="uk-flex-top modal_block_overlay" id="loginModal" data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block padding-form">
            <div data-uk-close="" class="custom_close_button uk-modal-close-outside uk-close uk-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"
                     data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg>
            </div>
            <div class="form_overlay_block uk-padding-remove width-100 no-shadow">
                <h3 class="uk-text-center uk-text-capitalize h2-header uk-align-center font-26">Вход</h3>
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <input placeholder="E-mail"
                           v-model="email"
                           type="email">
                </div>
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <input placeholder="Пароль"
                           v-model="password"
                           type="password">
                </div>
                <div class="mistake_alert hidden"
                     v-html="getError('login')"
                     v-bind:class="{'visible':getError('login')}">
                </div>
                <a class="go_back custom_link"
                   @click="$router.push('/forgotPassword')">
                    Восстановить пароль
                </a>
                <button type="button"
                        @click="login()"
                        class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom width-100 height-50">
                    Войти
                </button>
                <a class="uk-close button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom width-100 height-50"
                   @click="goRegister()">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        data() {
            return {
                email: '',
                password: '',
                remember: false,
                error: '',
            }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),
        },
        name: "auth-modal",
        methods: {
            ...mapActions('appLogin', [
                'loginUser'
            ]),
            goRegister(){
                // закрыть окно
                let modal = UIkit.modal("#loginModal");
                modal.hide();
                // перейти к регистрации
                this.$router.push('/register');
            },
            login() {
                let app = this;
                this.loginUser({
                    username: this.email,
                    password: this.password,
                    callback: function () {
                        let modal = UIkit.modal("#loginModal");
                        modal.hide();
                        app.$router.push('/');
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>
