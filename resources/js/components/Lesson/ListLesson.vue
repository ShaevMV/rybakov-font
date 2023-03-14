<template>
    <div class="left_edu" id="main_menu">
            <span id="close_button" uk-toggle="target: #main_menu; cls: active;">
                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" data-prefix="fas" data-icon="times"
                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg="">
                    <path fill="currentColor"
                          d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                </svg><!-- <i class="fas fa-times"></i> -->
            </span>
        <div class="top_part_edu">
            <h2> 1 уровень</h2>
            <p> Урок<span>   {{getSelectCountLesson}}</span> из<span>   {{getCountLesson}}</span></p>
        </div>
        <div class="bottom_part_edu">
            <ul class="acc_block uk-accordion" uk-accordion="">
                <li v-bind:class="{'uk-open':isSelectTaskInLesson(item)}"
                    v-for="item in getListLesson">
                    <a class="uk-accordion-title acc_title">
                        {{item.title}}
                    </a>
                    <div class="uk-accordion-content" aria-hidden="false">
                        <ul class="inner_acc">
                            <li v-bind:class="{'active':isSelectTask(task.id)}"
                                v-for="task in item.tasks">
                                <a @click="selectTask({
                                    task: task,
                                    lessonSort: item.sort
                                })">{{task.title}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "list-lesson",
        props: ['type'],
        computed: {
            ...mapGetters('appLesson', [
                'getListLesson',
                'isSelectTask',
                'isSelectTaskInLesson',
                'getCountLesson',
                'getSelectCountLesson'
            ])
        },
        methods: {
            ...mapActions('appLesson', [
                'selectTask',
            ])
        }
    }
</script>

<style scoped>

</style>