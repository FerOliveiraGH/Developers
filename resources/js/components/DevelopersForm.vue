<template>
    <div class="col p-4">
        <div class="col p-4 border rounded">
            <form action="#">
                <div class="row">
                    <div class="col">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control form-control-sm" aria-label="Nome" maxlength="100">
                    </div>
                    <div class="col">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select id="sexo" class="form-select form-select-sm">
                            <option value="">Selecione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Não Binário</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select id="nivel" class="form-select form-select-sm">
                            <option value="">Selecione</option>
                            <option v-for="level in levels.data" :key="level.id">
                                {{ level.nivel }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="data_nascimento" class="form-label">Data Nasc.</label>
                        <input type="text" id="data_nascimento" class="form-control form-control-sm">
                    </div>
                    <div class="col">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="text" id="idade" class="form-control form-control-sm">
                    </div>
                    <div class="col">
                        <label for="hobby" class="form-label">Hobby</label>
                        <input type="text" id="hobby" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-primary form-input">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "DevelopersForm",
    data() {
        return {
            levels: {
                data: [
                    {
                        id: '',
                        nivel: '',
                    }
                ],
                meta_data: {
                    last_page: 0
                }
            }
        }
    },
    mounted() {
        axios.get('/api/levels').then((response) => {
            this.levels = response.data;
        });
    }
}
</script>

<style scoped>

</style>
