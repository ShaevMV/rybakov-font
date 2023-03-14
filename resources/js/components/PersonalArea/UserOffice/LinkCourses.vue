<template>
    <div class="right_kg_user">
        <div class="user_edu_block">
            <h2> Обучение</h2>
            <!-- Добавить уровни level0 - level3-->
            <div class="block_edu_systems systems1 level0">
                <p class="sys1_first" v-if="isNew('NOKDO')"> Вы можете пройти один из видов обучения внешней оценки
                    качества и стать экспертом.</p>
                <p class="sys1_second" v-if="isLevel('NOKDO',1)">Вы прошли<span>   первый уровень</span> обучения
                    оценки НОКДО. Осталось еще 2 шага и вы сможете стать экспертом НОКДО!</p>
                <p class="sys1_third" v-else-if="isLevel('NOKDO',2)">Вы прошли<span>   второй уровень</span> обучения
                    оценки НОКДО. Осталось еще 2 шага
                    и вы сможете стать экспертом НОКДО!</p>
                <p class="sys1_fourth" v-else-if="isLevel('NOKDO',3)"><span>   Поздравляем!</span> Вы полностью прошли
                    обучение экспертной оценки
                    НОКДО!</p>
                <div class="right_edu_color color_orange">
                    <router-link
                            class="btn_white"
                            to="/training/NOKDO">
                        НОКДО
                    </router-link>
                </div>
            </div>
            <!-- Добавить уровни level0 - level4-->
            <div class="block_edu_systems systems2 level0">
                <p class="sys2_first" v-if="isNew('ECERS')">Так же вы можете начать обучение экспертной оценки
                    ECERS.</p>
                <p class="sys2_second" v-else-if="isLevel('ECERS',1)">Вы прошли<span>   первый уровень</span> обучения
                    оценки ECERS. Осталось еще 2
                    шага и вы сможете стать экспертом ECERS!</p>
                <p class="sys2_third" v-else-if="isLevel('ECERS',2)">Вы прошли<span>   второй уровень</span> обучения
                    оценки ECERS. Осталось еще 2 шага
                    и вы сможете стать экспертом ECERS!</p>
                <p class="sys2_fourth" v-else-if="isLevel('ECERS',3)"><span>   Поздравляем!</span> Вы полностью прошли
                    обучение экспертной оценки
                    ECERS!</p>
                <div class="right_edu_color color_yellow">
                    <router-link
                            class="btn_white"
                            to="/training/ECERS">
                        ECERS
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    import _ from 'lodash';

    export default {
        name: "link-courses",

        methods: {
            /**
             * Проверить существование уровня
             *
             * @param strType
             * @param level
             * @return {boolean}
             */
            isLevel(strType, level) {
                let type  = this.getListLevelsType(strType);
                if (typeof type !== 'undefined') {
                    let result = _.filter(type, function (item) {
                        return item.level_number === level;
                    });
                    return result.length > 0;
                }
                return false;
            },
            /**
             * Проверить на отсутствие прохождения по данному направлению
             *
             * @param type
             * @return {boolean}
             */
            isNew(type){
                return typeof this.getListLevelsType(type) === 'undefined' || this.getListLevelsType(type).length === 0;
            }
        },
        computed: {
            ...mapGetters('appTraining', [
                'getListLevelsType',
            ]),

        },
    }
</script>

<style scoped>

</style>