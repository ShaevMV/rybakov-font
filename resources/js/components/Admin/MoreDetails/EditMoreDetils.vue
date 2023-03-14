<template>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Описание</h4>
            </div><!-- panel-heading -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            <ckeditor :editor="editor"
                                      v-model="item.text"
                                      :config="editorConfig"></ckeditor>
                            <span class="error">{{getError('text')}}</span>
                        </div><!-- form-group -->
                    </div><!-- col-sm-12 -->
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary" @click="$emit('save')">Сохранить</button>
                </div>
            </div><!-- panel -->

        </div>
    </div>
</template>

<script>
    import {mixin} from '../../CKEditor/mixin.js';
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import {mapGetters, mapActions, mapState} from 'vuex';

    export default {
        name: "edit-more-detils",
        props:['item'],
        mixins: [mixin],
        computed:{
            ...mapGetters([
                'getError'
            ]),
        }
    }
</script>

<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>