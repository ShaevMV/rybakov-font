<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Создать нового эксперта</h4>
            </div><!-- panel-heading -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Login</label>
                            <input type="email" v-model="user.email" class="form-control" title="Login">
                            <label class="error">{{getError('email')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Имя</label>
                            <input type="text" v-model="user.name" class="form-control" title="Имя">
                            <label class="error">{{getError('name')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Телефон</label>
                            <input type="text" v-model="user.phone" id="inp_phone" class="form-control" title="Телефон">
                            <label class="error">{{getError('phone')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Пароль</label>
                            <input type="password" v-model="user.password" class="form-control" title="Пароль">
                            <label class="error">{{getError('password')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Повторите пароль</label>
                            <input type="password" v-model="user.password_confirmation" class="form-control" title="Повторите пароль">
                            <label class="error">{{getError('password_confirmation')}}</label>
                        </div><!-- form-group -->
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" @click="addExpert({
                    user: user,
                    callback: clear
                })">Добавить эксперта</button>
            </div>
        </div><!-- panel -->

    </div>
</template>

<script>

    import Inputmask from 'inputmask';
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "add-expert",
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    role_id: 4
                },
            }
        },
        computed: {
            ...mapGetters([
                'getError'
            ]),
        },
        methods: {
            ...mapActions('appExpert',[
                'addExpert'
            ]),
            clear(){
                this.user = {
                    name: '',
                    email: '',
                    phone: '',
                    password: '',
                    password_confirmation: '',
                    role_id: 4
                };
            }
        },
        mounted () {
            let im = new Inputmask("+7 999-999-99-99");
            im.mask(document.getElementById('inp_phone'));
        }
    }
</script>

<style scoped>

</style>