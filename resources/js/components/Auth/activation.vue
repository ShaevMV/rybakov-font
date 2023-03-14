<template>
    <div class="form_overlay uk-padding uk-padding-remove-horizontal uk-padding-remove-bottom uk-width-1-1 uk-flex uk-flex-column uk-flex-middle">
        <div class="form_overlay_block uk-margin-medium-bottom uk-padding-remove width_600">
            <div class="inner_section">
                <div class="container">
                <span v-if="isActive">
                    Ваш адрес подтвержден, теперь Вам доступно участие проекте "Детский сад - для детей". <a href="/lk"> Начать </a>
                </span>
                    <span v-else>
                    К сожалению данная ссылка устарела, свяжитесь с <a href="mailto:ask@htmlbook.ru">администратором</a>
                </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "activation",
        data(){
            return {
                isActive: false
            }
        },
        beforeRouteEnter: (to, from, next) => {
            next(vm => {
                store.dispatch('appLogin/activation',{
                    userId: to.params.id,
                    token: to.params.token
                }).then(function(response){
                    vm.isActive = response.data.active;
                }); // получить данные о группах заявок
            });


        },
    }
</script>

<style scoped>

</style>