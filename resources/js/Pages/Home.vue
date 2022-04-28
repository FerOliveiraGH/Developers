<template>
    <div class="container mt-5 p-4 shadow bg-white rounded">
        <div class="row">
            <div class="row mb-3">
                <div class="col">
                    <h4>Developers</h4>
                </div>
            </div>

            <DevelopersForm></DevelopersForm>

            <DevelopersList></DevelopersList>
        </div>
    </div>
</template>

<script>
import DevelopersList from "../components/DevelopersList";
import DevelopersForm from "../components/DevelopersForm";
export default {
    components: {
        DevelopersList,
        DevelopersForm
    },
    props: [],
};
</script>
