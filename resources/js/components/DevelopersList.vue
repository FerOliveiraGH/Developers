<template>
    <div class="col p-4">
        <div class="col p-0 border rounded">
            <table id="form-developers" class="table table-striped mb-0">
<!--                <caption>Developers</caption>-->
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="developer in developers.data" :key="developer.id">
                    <th scope="row">{{ developer.id }}</th>
                    <td>{{ developer.nome }}</td>
                    <td>{{ developer.nivel }}</td>
                    <td v-if="developer.sexo === 'M'">Masculino</td>
                    <td v-else-if="developer.sexo === 'F'">Feminino</td>
                    <td v-else-if="developer.sexo === 'O'">Não Binário</td>
                    <td>{{ developer.idade }}</td>
                    <td v-if="developer.id" class="text-center">
                        <a href="#" class="m-1 link-dark" title="Editar"><em class="bi bi-pencil"></em></a>
                        <a href="#" class="m-1 link-dark" title="Excluir"><em class="bi bi-trash2"></em></a>
                    </td>
                </tr>
                </tbody>
            </table>

            <nav aria-label="Page navigation example" class="">
                <ul class="pagination pagination-sm justify-content-center mb-0 mt-3">
                    <li class="page-item">
                        <a class="page-link link-dark" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link link-dark" href="#">1</a></li>
                    <li class="page-item"><a class="page-link link-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link link-dark" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link link-dark" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "DevelopersList",
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
                    last_page: 0
                }
            }
        }
    },
    mounted() {
        axios.get('/api/developers').then((response) => {
            this.developers = response.data;
        });
    }
}
</script>

<style scoped>

</style>
