<template>
    <div class="row">
        <div class="row m-0">
            <div class="col">
                <h4>Developers</h4>
            </div>
        </div>
        <div class="col p-4">
            <div class="col p-4 border rounded">
                <form name="developers">
                    <input type="hidden" id="id" ref="id" value="">
                    <div class="row">
                        <div class="col">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" id="nome" ref="nome" class="form-control form-control-sm" aria-label="Nome" maxlength="100">
                        </div>
                        <div class="col">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select id="sexo" ref="sexo" class="form-select form-select-sm">
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Não Binário</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="nivel_id" class="form-label">Nivel</label>
                            <select id="nivel_id" ref="nivel_id" class="form-select form-select-sm">
                                <option value="">Selecione</option>
                                <option v-for="level in this.$parent.$data.levels.data" :key="level.id" :value="level.id">
                                    {{ level.nivel }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="data_nascimento" class="form-label">Data Nasc.</label>
                            <input type="date" id="data_nascimento" ref="data_nascimento" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label for="idade" class="form-label">Idade</label>
                            <input type="number" id="idade" ref="idade" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label for="hobby" class="form-label">Hobby</label>
                            <input type="text" id="hobby" ref="hobby" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <button class="btn btn-primary form-input" @click.prevent="saveDeveloper">Salvar</button>
                            <button class="btn btn-secondary form-input m-2" @click.prevent="clearForm">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col p-4">
            <div class="col p-0 border rounded">
                <table id="form-developers" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Idade</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="developer in this.$parent.$data.developers.data" :key="developer.id">
                        <th scope="row">{{ developer.id }}</th>
                        <td>{{ developer.nome }}</td>
                        <td>{{ developer.nivel }}</td>
                        <td v-if="developer.sexo === 'M'">Masculino</td>
                        <td v-else-if="developer.sexo === 'F'">Feminino</td>
                        <td v-else-if="developer.sexo === 'O'">Não Binário</td>
                        <td>{{ developer.idade }}</td>
                        <td v-if="developer.id" class="text-center">
                            <a href="#" class="m-1 link-dark" title="Editar"
                               @click.prevent="editDeveloper(developer.id)"><em class="bi bi-pencil"></em></a>
                            <a href="#" class="m-1 link-dark" title="Excluir"
                               @click.prevent="deleteDeveloper(developer.id)"><em class="bi bi-trash2"></em></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="">
                    <ul class="pagination pagination-sm justify-content-center mb-0 mt-3">
                        <li class="page-item" v-if="this.$parent.$data.developers.meta_data.current_page > 1">
                            <a class="page-link link-dark" href="#" aria-label="Previous"
                               @click.prevent="getDevelopers(this.$parent.$data.developers.meta_data.current_page - 1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" v-for="page in this.$parent.$data.developers.meta_data.last_page">
                            <a class="page-link link-dark" href="#"
                               @click.prevent="getDevelopers(page)"
                               :class="{'text-black-50': this.checkPageSelected(page)}">{{ page }}</a>
                        </li>
                        <li class="page-item"
                            v-if="this.$parent.$data.developers.meta_data.current_page < this.$parent.$data.developers.meta_data.last_page">
                            <a class="page-link link-dark" href="#" aria-label="Next"
                               @click.prevent="getDevelopers(this.$parent.$data.developers.meta_data.current_page + 1)">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Developers",
    components: {
    },
    mounted() {
        this.getLevels();
        this.getDevelopers()
    },
    methods: {
        getLevels: function (page = 1) {
            axios.get('/api/levels?page' + page + '&per_page=5').then((response) => {
                this.$parent.$data.levels = response.data;
            })
        },
        getDevelopers: function (page = 1) {
            axios.get('/api/developers' + '?page=' + page + '&per_page=5').then((response) => {
                this.$parent.$data.developers = response.data;
            })
        },
        saveDeveloper: function () {
            if (this.$refs.id.value > 0) {
                this.updateDeveloper(this.$refs.id.value, this.mountJsonData())
            } else {
                this.createDeveloper(this.mountJsonData())
            }
        },
        createDeveloper: function (data) {
            axios.post('/api/developers', data).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Developer criado com sucesso!')
                this.getDevelopers(this.$parent.$data.developers.meta_data.current_page)
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao criar Developer!')
            })
        },
        updateDeveloper: function (id, data) {
            axios.patch('/api/developers/' + id, data).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Developer atualizado com sucesso!')
                this.getDevelopers(this.$parent.$data.developers.meta_data.current_page)
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao atualizar Developer!')
            })
        },
        deleteDeveloper: function (id) {
            axios.delete('/api/developers/' + id).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Developer deletado com sucesso!')
                this.getDevelopers(this.$parent.$data.developers.meta_data.current_page)
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao deletar Developer!')
            })
        },
        mountJsonData: function () {
            return {
                nome: this.$refs.nome.value,
                sexo: this.$refs.sexo.value,
                nivel_id: this.$refs.nivel_id.value,
                data_nascimento: this.$refs.data_nascimento.value,
                idade: this.$refs.idade.value,
                hobby: this.$refs.hobby.value,
            }
        },
        editDeveloper: function (id) {
            axios.get('/api/developers/' + id).then((response) => {
                let developer = response.data.data;

                this.$refs.id.value = developer.id
                this.$refs.nome.value = developer.nome
                this.$refs.sexo.value = developer.sexo
                this.$refs.nivel_id.value = developer.nivel_id
                this.$refs.data_nascimento.value = developer.data_nascimento
                this.$refs.idade.value = developer.idade
                this.$refs.hobby.value = developer.hobby
            })
        },
        clearForm: function () {
            this.$refs.id.value = ''
            this.$refs.nome.value = ''
            this.$refs.sexo.value = ''
            this.$refs.nivel_id.value = ''
            this.$refs.data_nascimento.value = ''
            this.$refs.idade.value = ''
            this.$refs.hobby.value = ''
        },
        checkPageSelected: function (page) {
            return this.$parent.$data.developers.meta_data.current_page === page
        },
    }
}
</script>

<style scoped>

</style>
