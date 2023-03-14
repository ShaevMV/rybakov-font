<template>
    <div class="leftpanel">
        <div class="media profile-left">
            <!--<a class="pull-left profile-thumb" href="profile.html">
                <img class="img-circle" src="images/photos/profile.png" alt="">
            </a>-->
            <div class="media-body">
                <h4 class="media-heading">{{getUserName}}</h4>
            </div>
        </div><!-- media -->

        <h5 class="leftpanel-title">Меню</h5>
        <ul class="nav nav-pills nav-stacked">
            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/widgets">
                <a>
                    <i class="glyphicon glyphicon-th"></i>
                    <span>
                        Главная страница
                    </span>
                </a>
            </router-link>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'lesson'}">
                <a href="javascript:void(0);"
                   @click="openUL('lesson')">
                    <i class="glyphicon glyphicon-education"></i>
                    <span>Онлайн обучение</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/lessons/NOKDO">
                            <a><span>НОКДО</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/lessons/ECERS">
                            <a><span>ECERS</span></a>
                    </router-link>
                </ul>
            </li>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'testingNOKDO'}">
                <a href="javascript:void(0);"
                   @click="openUL('testingNOKDO')">
                    <i class="glyphicon glyphicon-ok-circle"></i>
                    <span>Тесты НОКДО</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/NOKDO/1">
                            <a><span>Глобальное тестирование</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/NOKDO/2">
                            <a><span>Тест 2-го уровня</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/NOKDO/3">
                        <a><span>Тест 3-го уровня</span></a>
                    </router-link>
                </ul>
            </li>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'testingECERS'}">
                <a href="javascript:void(0);"
                   @click="openUL('testingECERS')">
                    <i class="glyphicon glyphicon-ok-circle"></i>
                    <span>Тесты ECERS</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/ECERS/1">
                        <a><span>Глобальное тестирование</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/ECERS/2">
                        <a><span>Тест 2-го уровня</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/testing/ECERS/3">
                        <a><span>Тест 3-го уровня</span></a>
                    </router-link>
                </ul>
            </li>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'MoreDetails'}">
                <a href="javascript:void(0);"
                   @click="openUL('MoreDetails')">
                    <i class="fa fa-bars"></i>
                    <span>Подробная информация по уровням</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/moreDetails/NOKDO">
                        <a><span>Подробнее НОКДО</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/moreDetails/ECERS">
                        <a><span>Подробнее ECERS</span></a>
                    </router-link>
                </ul>
            </li>
            <!--<router-link
                    tag="li"
                    active-class="active"
                    to="/admin/answers">
                <a>
                    <i class="glyphicon glyphicon-pencil"></i>
                    <span>
                        Ответы на тесты
                    </span>
                </a>
            </router-link>-->
            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/experts">
                <a>
                    <i class="glyphicon glyphicon-user"></i>
                    <span>
                        Эксперты
                    </span>
                </a>
            </router-link>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'requestNOKDO'}">
                <a href="javascript:void(0);"
                   @click="openUL('requestNOKDO')">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    <span>Заявки НОКДО</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/request/NOKDO/2">
                        <a><span>Заявки на 2-й уровень</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/request/NOKDO/3">
                        <a><span>Заявки на 3-й уровень</span></a>
                    </router-link>
                </ul>
            </li>
            <li class="parent"
                v-bind:class="{'parent-focus':UL === 'requestECERS'}">
                <a href="javascript:void(0);"
                   @click="openUL('requestECERS')">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    <span>Заявки ECERS</span>
                </a>
                <ul class="children">
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/request/ECERS/2">
                        <a><span>Заявки на 2-й уровень</span></a>
                    </router-link>
                    <router-link
                            tag="li"
                            active-class="active"
                            to="/admin/request/ECERS/3">
                        <a><span>Заявки на 3-й уровень</span></a>
                    </router-link>
                </ul>
            </li>

            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/request/kindergarten">
                <a>
                    <i class="glyphicon glyphicon-home"></i>
                    <span>
                        Заявки от детских садов
                    </span>
                </a>
            </router-link>
            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/map">
                <a>
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span>
                        Нанесение детских садов на карту
                    </span>
                </a>
            </router-link>
            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/certificate">
                <a>
                    <i class="glyphicon glyphicon-certificate"></i>
                    <span>
                        Сертификаты
                    </span>
                </a>
            </router-link>
            <router-link
                    tag="li"
                    active-class="active"
                    to="/admin/platforms">
                <a>
                    <i class="glyphicon glyphicon-link"></i>
                    <span>
                        Платформы
                    </span>
                </a>
            </router-link>
            <li style="cursor: pointer;" @click="logOut()">
                <a>
                    <i class="glyphicon glyphicon-log-out"></i>
                    <span>
                        Выйти
                    </span>
                </a>
            </li>
        </ul>

    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        data() {
            return {
                UL : '',
            }
        },
        name: "left-panel",
        computed: {
            ...mapGetters('appMenu', [
                'listMenu'
            ]),
            ...mapGetters([
                'getRole'
            ]),
            ...mapGetters([
                'getUserName'
            ]),
        },
        methods: {
            ...mapActions('appLogin', [
                'logOut'
            ]),
            openUL(index){
                if(this.UL === index) {
                    this.UL = '';
                } else {
                    this.UL = index;
                }
            }
        }
    }
</script>

<style scoped>

</style>
