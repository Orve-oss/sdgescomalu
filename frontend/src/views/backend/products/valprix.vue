<script setup>
import { ref, reactive, onMounted } from "vue";
import { useValprixStore } from "@/stores/valprix";
// import { toast } from "vue3-toastify";
// import "vue3-toastify/dist/index.css";

const valprixStore = useValprixStore();
// const selectedDesignation = ref('');

onMounted(() => {
    valprixStore.getCategorie();
    valprixStore.getDefprix();
    valprixStore.getValprix();
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
        label: "Definition de prix",
        field: "defprix.nom",
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
    valprixStore.designation = data.designation;
    valprixStore.produit_id = data.id;
    console.log(data);

};
const addprix = () => {
    let Index = valprixStore.getIndexListePrix(valprixStore.produit_id);
    console.log(Index);
    console.log(valprixStore.produit_id);
    if (Index >= 0) {
        const id = valprixStore.Valprix.data[Index].id;
        let pvte = valprixStore.pvte;
        valprixStore.updateprix(id, pvte);
        console.log(valprixStore.Valprix.data[Index].id);
        console.log(valprixStore.pvte);


    } else {
        valprixStore.valprix({
            produit_id: valprixStore.produit_id,
            defprix_id: valprixStore.defprix_id,
            pvte: valprixStore.pvte
        })
    }

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
                            <option v-for="defprix in valprixStore.defprix.data" :key="defprix.id" :value="defprix.id">
                                {{
                                    defprix.nom }}</option>

                        </select>

                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-xl-5">
                            <div class="card justify-content-center">
                                <p>{{ valprixStore.designation }}</p>
                            </div>
                        </div>

                        <div class="col-lg-5 col-xl-3">
                            <div class="form mb-1">
                                <input type="number" class="form-control" id="pvte" name="pvte" placeholder="Ex: 150"
                                    v-model="valprixStore.pvte" />

                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-3">
                            <div class="row items-push text-center text-sm-start mb-0">
                                <div class="col-sm-6 col-xl-4 me-3">
                                    <button type="button" @click="addprix" class="btn rounded-0 btn-dark">
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

                <vue-good-table :columns="produit" :rows="valprixStore.Valprix.data" styleClass="vgt-table mt-3 "
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

                </vue-good-table>


            </div>
        </div>
    </div>

</template>
