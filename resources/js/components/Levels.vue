<template>
    <div class="row">
        <div class="row m-0">
            <div class="col">
                <h4>Levels</h4>
            </div>
        </div>
        <div class="col p-4">
            <div class="col p-4 border rounded">
                <form name="levels">
                    <input type="hidden" id="id" ref="id" value="">
                    <div class="row">
                        <div class="col">
                            <label for="nivel" class="form-label">Nível</label>
                            <input type="text" id="nivel" ref="nivel" class="form-control form-control-sm" aria-label="Nível" maxlength="100">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <button class="btn btn-primary form-input" @click.prevent="saveLevel">Salvar</button>
                            <button class="btn btn-secondary form-input m-2" @click.prevent="clearForm">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col p-4">
            <div class="col p-0 border rounded">
                <table id="form-levels" class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Developers</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="level in this.$parent.$data.levels.data" :key="level.id">
                        <th scope="row">{{ level.id }}</th>
                        <td>{{ level.nivel }}</td>
                        <td>{{ level.developers }}</td>
                        <td v-if="level.id" class="text-center">
                            <a href="#" class="m-1 link-dark" title="Editar"
                               @click.prevent="editLevel(level.id)"><em class="bi bi-pencil"></em></a>
                            <a href="#" class="m-1 link-dark" title="Excluir"
                               @click.prevent="deleteLevel(level.id)"><em class="bi bi-trash2"></em></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="">
                    <ul class="pagination pagination-sm justify-content-center mb-0 mt-3">
                        <li class="page-item" v-if="this.$parent.$data.levels.meta_data.current_page > 1">
                            <a class="page-link link-dark" href="#" aria-label="Previous"
                               @click.prevent="getLevels(this.$parent.$data.levels.meta_data.current_page - 1)">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" v-for="page in this.$parent.$data.levels.meta_data.last_page">
                            <a class="page-link link-dark" href="#"
                               @click.prevent="getLevels(page)"
                               :class="{'text-black-50': this.checkPageSelected(page)}">{{ page }}</a>
                        </li>
                        <li class="page-item"
                            v-if="this.$parent.$data.levels.meta_data.current_page < this.$parent.$data.levels.meta_data.last_page">
                            <a class="page-link link-dark" href="#" aria-label="Next"
                               @click.prevent="getLevels(this.$parent.$data.levels.meta_data.current_page + 1)">
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
    name: "Levels",
    mounted() {
        this.getLevels()
    },
    methods: {
        getLevels: function (page = 1) {
            axios.get('/api/levels?page' + page + '&per_page=5').then((response) => {
                this.$parent.$data.levels = response.data;
            })
        },
        saveLevel: function () {
            if (this.$refs.id.value > 0) {
                this.updateLevel(this.$refs.id.value, this.mountJsonData())
            } else {
                this.createLevel(this.mountJsonData())
            }
        },
        createLevel: function (data) {
            axios.post('/api/levels', data).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Level criado com sucesso!')
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao criar Level!')
            })
        },
        updateLevel: function (id, data) {
            axios.patch('/api/levels/' + id, data).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Level atualizado com sucesso!')
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao atualizar Level!')
            })
        },
        deleteLevel: function (id) {
            axios.delete('/api/levels/' + id).then(() => {
                this.$parent.$refs.alert.showAlert('success', 'Level deletado com sucesso!')
                this.getLevels(this.$parent.$data.levels.meta_data.current_page)
            }).catch(() => {
                this.$parent.$refs.alert.showAlert('error', 'Erro ao deletar Level!')
            })
        },
        mountJsonData: function () {
            return {
                nivel: this.$refs.nivel.value,
            }
        },
        editLevel: function (id) {
            axios.get('/api/levels/' + id).then((response) => {
                let level = response.data.data;

                this.$refs.id.value = level.id
                this.$refs.nivel.value = level.nivel
            })
        },
        clearForm: function () {
            this.$refs.id.value = ''
            this.$refs.nivel.value = ''
        },
        checkPageSelected: function (page) {
            return this.$parent.$data.levels.meta_data.current_page === page
        },
    }
}
</script>

<style scoped>

</style>
