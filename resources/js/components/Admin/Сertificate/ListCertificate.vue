<template>
    <div class="col-md-12">
        <h5 class="lg-title mb5">Список сертификатов</h5>
        <div class="table-responsive">
            <table class="table mb30">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Пользователь</th>
                    <th>Скачать</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in getListCertificats">
                    <td>{{getId(item.id)}}</td>
                    <td>{{item.title}}</td>
                    <td>{{item.name}} ({{item.email}})</td>
                    <td>
                        <a :href="item.pdf" download="" class="download_image"> скачать </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';
    export default {
        name: "list-certificate",
        beforeRouteEnter: (to, from, next) => {
            store.dispatch('appTraining/loadCertificateAll'); // получить данные о сертификатах
            next();
        },
        computed: {
            ...mapGetters('appTraining', [
                'getListCertificats'
            ]),

        },
        methods:{
            getId(id){
                return String(id).padStart(8, "0");
            }
        }
    }
</script>

<style scoped>

</style>