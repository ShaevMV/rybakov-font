<template>
    <span class="signin">
        <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99"
                 style="width: 100%;">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>
        <section>
            <div class="panel panel-signin">
                <div class="panel-body">
                    <span>
                        <h4 class="text-center mb5">Авторизация</h4>
                        <div class="mb30"></div>
                        <div>
                            <div class="input-group mb15">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input type="email"
                                       class="form-control"
                                       placeholder="email"
                                       v-model="email">
                            </div><!-- input-group -->
                            <div class="input-group mb15">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input type="password"
                                       class="form-control"
                                       placeholder="Password"
                                       v-model="password">
                            </div><!-- input-group -->
                            <label for="skype" class="error">{{getError('active')}}</label>
                            <div class="clearfix">

                                <div class="pull-right">
                                    <button type="submit"
                                            class="btn btn-success"
                                            @click="login">Войти <i class="fa fa-angle-right ml5"></i></button>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </section>
    </span>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "auth-admin",
        data() {
            return {
                email: '',
                password: '',
            }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),
        },
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
                        document.location.href="/admin";
                    }
                });
            }
        },
        mounted() {
            $('.pace-done').addClass('signin');
        }
    }
</script>

<style scoped>

</style>