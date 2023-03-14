<template>
    <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle">
        <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26"> Авторизация</h2>
        <div class="form_overlay_block uk-margin-medium-bottom uk-padding-remove width_600">
            <div class="as_user padding-form">
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <!-- У input_wrapper есть классы success и failed-->
                    <input placeholder="E-mail"
                           v-model="email"
                           type="email">
                </div>
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <!-- У input_wrapper есть классы success и failed-->
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
                <div class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom" @click="login()"> Войти</div>
                <a class="button_cancel uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom margin_right_auto" @click="$router.push('register')"> Зарегистрироваться</a>
            </div>
        </div><a class="go_back custom_link" href="/">  Вернуться на сервис</a>
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
        name: "auth",
        methods: {
            ...mapActions('appLogin', [
                'loginUser'
            ]),
            login() {
                let app = this;
                this.loginUser({
                    username: this.email,
                    password: this.password,
                    callback: function () {
                        if(app.$route.query.nextUrl != null){
                            app.$router.push(app.$route.query.nextUrl)
                        }
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>