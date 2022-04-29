<template>
    <div class="container mt-4 p-4 shadow bg-white rounded">
        <Developers></Developers>

        <Levels></Levels>

        <vue-basic-alert :duration="300" :closeIn="3000" ref="alert" />
    </div>
</template>

<script>
import Developers from "../components/Developers";
import Levels from "../components/Levels";
import VueBasicAlert from 'vue-basic-alert';
export default {
    components: {
        Developers,
        Levels,
        VueBasicAlert
    },
    props: [],
    data() {
        return {
            developers: {
                data: [
                    {
                        id: '',
                        nome: '',
                        sexo: '',
                        nivel: '',
                        idade: '',
                    }
                ],
                meta_data: {
                    last_page: 0,
                    current_page: 1
                }
            },
            levels: {
                data: [
                    {
                        id: '',
                        nivel: '',
                    }
                ],
                meta_data: {
                    last_page: 0,
                    current_page: 1
                }
            }
        }
    },
};
</script>
