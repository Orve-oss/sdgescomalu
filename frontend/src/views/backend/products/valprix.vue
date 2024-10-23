<script setup>
import { ref, reactive, onMounted } from "vue";
import { useValprixStore } from "@/stores/valprix";

const valprixStore = useValprixStore();
// const selectedDesignation = ref('');

onMounted(() => {
    valprixStore.getCategorie();
    valprixStore.getDefprix();
    // valprixStore.getProduitByCategorie(valprixStore.categories.id);
})
// Example data
const produits = reactive([
    {
        label: "Designation",
        field: "designation",
    },

]);

const produit = ref([
    {
        label: "Designation",
        field: "produit.designation",
    },
    {
        label: "Prix",
        field: "pvte",
    },

    {
        label: "Act",
        field: "Action",
    },
]);

const searchTerm = ref("");


const clicko = (data) => {
    valprixStore.ligneproduit.designation = data.designation;
    valprixStore.ligneproduit.produit_id = data.produit_id;

}
</script>

<template>
    <!-- Page Content -->
    <div class="mx-3 my-3">
        <div class="row">
            <div class="col-xl-4">

                <BaseBlock title="Produits">
                    <div class="mb-4">
                        <label class="form-label" for="example-text-input">Categorie<span class="text-danger">*</span>
                            :</label>
                        <select class="form-select" id="example-select" name="example-select"
                            v-model="valprixStore.categories.id"
                            @change="valprixStore.getProduitByCategorie(valprixStore.categories.id)">
                            <option selected>Open this select menu</option>
                            <option v-for="category in valprixStore.categories.data" :key="category.id"
                                :value="category.id">{{ category.libelle }}</option>
                        </select>

                    </div>

                    <vue-good-table :columns="produits" :rows="valprixStore.produits"
                        styleClass="vgt-table mt-3 table-vcenter" :search-options="{
                            enabled: true,
                            externalQuery: searchTerm,

                        }" max-heigth="500px" max-width="100%" :fixed-header="true">

                        <template v-slot:table-row="props">
                            <span v-if="props.column.field == 'designation'">
                                <span>
                                    <a href="#" @click="clicko(props.row)">{{ props.row.designation }}</a>
                                </span>
                            </span>
                        </template>

                    </vue-good-table>
                </BaseBlock>
                <!-- END Default Table -->
            </div>
            <div class="col-xl-8 ms-auto mb-0">
                <!-- Striped Table -->
                <BaseBlock title="Detail">

                        <div class="mb-4">

                            <select class="form-select" id="example-select" name="example-select"
                                v-model="valprixStore.defprix_id">
                                <option selected>Open this select menu</option>
                                <option v-for="defprix in valprixStore.defprix.data" :key="defprix.id"
                                    :value="defprix.id">
                                    {{
                                        defprix.nom }}</option>

                            </select>

                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-xl-5">
                                <div class="form mb-2 mx-1">
                                    <input type="text" class="form-control" id="example-text-input-floating"
                                        :value="valprixStore.ligneproduit.designation" disabled  />

                                </div>
                                 <input type="hidden" v-model="valprixStore.produit_id">

                            </div>
                            <div class="col-lg-5 col-xl-3">
                                <div class="form mb-1">
                                    <input type="number" class="form-control" id="pvte"
                                        name="pvte" placeholder="Ex: 150" v-model="valprixStore.pvte"/>

                                </div>
                            </div>
                            <div class="col-lg-5 col-xl-3">
                                <div class="row items-push text-center text-sm-start mb-0">
                                    <div class="col-sm-6 col-xl-4 me-3">
                                        <button type="button" @click="valprixStore.valprix" class="btn rounded-0 btn-dark">
                                            Valider
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button type="button" class="btn rounded-0 btn-light"
                                            @click="valprixStore.clearval">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                </BaseBlock>

                <!-- <vue-good-table :columns="produit" :rows="valprixStore.valprix.data" styleClass="vgt-table mt-3 "
                    max-heigth="500px" max-width="100%" :fixed-header="true" theme="black-rhino">

                    <template v-slot:table-row="props">
                        <span v-if="props.column.field == 'Action'">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </span>
                    </template>

                </vue-good-table> -->


            </div>
        </div>
    </div>

</template>
