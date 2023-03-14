<template>
    <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle">
        <h2 class="text-500 uk-text-uppercase h2-header uk-align-center font-26">Восстановить пароль</h2>
        <div class="form_overlay_block uk-margin-medium-bottom uk-padding-remove width_600">
            <div class="as_user padding-form">
                <div class="input_wrapper uk-flex uk-flex-column uk-flex-center">
                    <!-- У input_wrapper есть классы success и failed-->
                    <input placeholder="E-mail"
                           v-model="email"
                           type="email">
                </div>
                <div class="mistake_alert hidden"
                     v-html="getError('email')"
                     v-bind:class="{'visible':getError('email')}">
                </div>
                <div class="button_continue uk-text-uppercase button_conf_reg uk-align-center uk-margin-remove-bottom"
                     @click="sendEMail()">Восстановить пароль</div>
            </div>
        </div>
        <a class="go_back custom_link" href="/">Вернуться на сервис</a>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "forgot-password",
        data(){
              return {
                  email: '',
              }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appLogin',[
                'getRestorePassword'
            ]),
            sendEMail(){
                this.getRestorePassword({
                    email: this.email,
                    callback: function () {
                        UIkit.modal("#ModalAfterReg").show();
                        this.email = null;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>