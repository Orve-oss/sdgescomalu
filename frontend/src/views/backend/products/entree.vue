<script setup>
import { reactive, onMounted } from "vue";
import { useValprixStore } from "@/stores/valprix";
// import { toast } from "vue3-toastify";
// import "vue3-toastify/dist/index.css";

const valprixStore = useValprixStore();
// const selectedDesignation = ref('');

onMounted(() => {
    valprixStore.getCategorie();

})
// Example data
const produits = reactive([
    {
        label: "Designation",
        field: "designation",
    },

]);


const clicko = (data) => {
    valprixStore.designation = data.designation;
    valprixStore.produit_id = data.id;
    console.log(data);

};


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
                        styleClass="vgt-table striped mt-3 mb-3 table-vcenter" max-heigth="500px" max-width="100%"
                        style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);" :fixed-header="true">

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
                           >
                            <option selected>Open this select menu</option>

                        </select>
                    </div>
                    <div class="row">

                        <div class="col-4 me-0">
                            <BaseBlock class="bg-body-dark mb-2">
                                <p>{{ valprixStore.designation }}</p>
                            </BaseBlock>
                            <BaseBlock class="bg-body-light mb-2">
                                <p></p>
                            </BaseBlock>
                        
                        </div>
                        <!-- <div class="col-3">
                            <BaseBlock class="bg-body-light mb-2">
                                <p></p>
                            </BaseBlock>
                        </div> -->

                        <div class="col-lg-5 col-xl-3">
                            <div class="form mb-1">
                                <input type="number" class="form-control" id="pvte" name="pvte" placeholder="Ex: 150"
                                    v-model="valprixStore.pvte" />

                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-3">
                            <div class="row items-push text-center text-sm-start mb-0">
                                <div class="col-sm-6 col-xl-4 me-3">
                                    <button type="button" class="btn rounded-0 btn-dark">
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
                <!-- <vue-good-table styleClass="vgt-table mt-3 "
                    max-heigth="500px" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);" max-width="100%"
                    :fixed-header="true" theme="black-rhino">
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
