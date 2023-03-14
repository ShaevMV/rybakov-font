<template>
    <div id="second_part">
        <div class="container">
            <h2 class="title_landing">{{title}}</h2>
            <div class="second_part_overlay uk-flex uk-flex-between">
                <div class="second_for_block violet_back uk-flex uk-flex-column">
                    <div class="header_second uk-flex uk-flex-between uk-flex-middle violet_header">
                        <h3 class="uk-margin-remove"> Для педагогов</h3>
                        <div class="cup_back"></div>
                    </div>
                    <div class="content_second">
                        <div class="levels_block">
                            <div class="left_line_overlay uk-flex uk-flex-column">
                                <div class="level_block first_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/first_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 1 уровень</h4>
                                        <p>{{getData('Teacher_1')}}</p>
                                    </div>
                                </div>
                                <div class="level_block second_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/second_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 2 уровень</h4>
                                        <p>{{getData('Teacher_2')}}</p>
                                    </div>
                                </div>
                                <div class="level_block third_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/third_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 3 уровень</h4>
                                        <p>{{getData('Teacher_3')}}</p>
                                    </div>
                                </div>
                                <div class="level_block fourth_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/fourth_level.png"></div>
                                    <div class="right_block_part">
                                        <h4> Уровень эксперта</h4>
                                        <p>{{getData('Teacher_Expert')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <router-link
                                class="button_continue btn_second"
                                to="/lk">
                            Пройти обучение
                        </router-link>
                    </div>
                </div>
                <div class="second_for_block blue_back uk-flex uk-flex-column">
                    <div class="header_second uk-flex uk-flex-between uk-flex-middle blue_header">
                        <h3 class="uk-margin-remove"> Для детского сада</h3>
                        <div class="cup_back"></div>
                    </div>
                    <div class="content_second">
                        <div class="levels_block">
                            <div class="left_line_overlay uk-flex uk-flex-column">
                                <div class="level_block first_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/first_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 1 уровень</h4>
                                        <p>{{getData('Kindergarten_1')}}</p>
                                    </div>
                                </div>
                                <div class="level_block second_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/second_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 2 уровень</h4>
                                        <p>{{getData('Kindergarten_2')}}</p>
                                    </div>
                                </div>
                                <div class="level_block third_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/third_level.svg"></div>
                                    <div class="right_block_part">
                                        <h4> 3 уровень</h4>
                                        <p>{{getData('Kindergarten_3')}}</p>
                                    </div>
                                </div>
                                <div class="level_block fourth_level uk-flex">
                                    <div class="left_block_part"><img src="images/content/fourth_level.png"></div>
                                    <div class="right_block_part">
                                        <h4> Уровень эксперта</h4>
                                        <p>{{getData('Kindergarten_Expert')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <router-link
                                class="button_continue btn_second"
                                to="/lk">
                            Пройти обучение
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mixin} from './mixin.js';
    export default {
        name: "participation",
        mixins: [mixin],
    }
</script>

<style scoped>

</style>