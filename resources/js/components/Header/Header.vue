<template>
    <div id="header">
        <div class="top_part">
            <platforms></platforms>
        </div>
        <div class="bottom_part">
            <div class="container">
                <div class="both_block uk-flex uk-flex-between uk-flex-wrap">
                    <div class="left_header uk-flex uk-flex-middle">
                        <div id="logo" @click="goHome()" style="cursor: pointer;">
                            <img src="/images/content/logo.png">
                        </div>
                        <span class="mob_menu" id="ham_button" uk-toggle="target: #main_menu; cls: active;">
                            <svg class="svg-inline--fa fa-bars fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                            </svg><!-- <i class="fas fa-bars"></i> -->
                        </span>
                        <div id="main_menu">
                            <span id="close_button" uk-toggle="target: #main_menu; cls: active;">
                                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                                </svg><!-- <i class="fas fa-times"></i> -->
                            </span>
                            <ul class="uk-flex uk-flex-between uk-margin-remove uk-padding-remove">
                                <li>
                                    <a @click="goAnchor('third_part')">
                                        О нас
                                    </a>
                                </li>
                                <li>
                                    <a @click="goAnchor('eight_part')">
                                        Эксперты
                                    </a>
                                </li>
                                <router-link tag="li"
                                             active-class="uk-active"
                                             @click.native="hideMenu"
                                             to="/kindergarten">
                                    <a>
                                        Сады-участники
                                    </a>
                                </router-link>
                            </ul>
                        </div>
                    </div>
                    <div class="right_header uk-flex uk-flex-middle">
                        <div class="right_header uk-flex uk-flex-middle" v-if="!getUserName">
                            <a @click="openModalLogin()" class="inner_link">Войти</a>
                        </div>
                        <header-user v-else></header-user>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import Platforms from "./Platforms";

    export default {
        components: {Platforms},
        name: "headerSite",
        computed: {
            ...mapGetters([
                'getUserName',
                'getCompanyName',
                'isAuthenticated'
            ])
        },
        methods: {
            ...mapActions('appLogin', [
                'logOut'
            ]),
            goAnchor(refName){
                let element = document.getElementById(refName);
                if(element){
                    let top = element.offsetTop;

                    $('html, body').animate(
                        {scrollTop: top},
                        800
                    );
                }
            },
            openModalLogin(){
                let modal = UIkit.modal("#loginModal");
                if(this.$route.path !== '/login'){
                    modal.show();
                }
            },


            goHome() {
                this.$router.push('/');
            },
            hideMenu() {
                document.getElementById('main_menu').classList.remove('active');
            }
        },
    }
</script>

<style scoped>

</style>
