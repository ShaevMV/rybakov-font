<template>
    <div class="uk-flex-top modal_block_overlay uk-modal"
         id="modalErrorLesson"
         uk-modal=""
         data-uk-modal="bg-close: false;">
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-flex uk-flex-column uk-flex-middle modal_block">
            <div class="custom_close_button uk-modal-close-outside uk-close uk-icon" uk-close=""
                 @click="">
                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line>
                    <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line>
                </svg>
            </div>
            <p class="modal-par"><span class="uk-text-bold font-26">Переход к уроку недопустим!</span></p>
            <p class="modal_desc uk-margin-remove font-16">Для продолжения пройдите текущий уровень полностью</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "modal-error-lesson",
    }
</script>

<style scoped>

</style>