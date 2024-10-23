<script setup>
import { ref, onMounted } from 'vue';
import { useproduitstore } from '@/stores/product';
import Swal from 'sweetalert2';

const produitStore = useproduitstore();
const colums = ref([
    { label: 'ID', field: 'id' },
    {
        label: 'designation',
        field: 'designation',
    },
    {
        label: 'fournisseur',
        field: 'fournisseur.rais_soc',
    },
    {
        label: 'categorie',
        field: 'categorie.libelle',
    },
    {
        label: 'Actif',
        field: 'Actif',
    },
    {
        label: 'Actions',
        field: 'Action',
    },

])

const deleteProduit = async (id) => {
    Swal.fire({
        title: 'Voulez-vous supprimer ce produit?',
        text: 'Cette action est irreversible!!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Oui',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
    }).then((result) => {
        if (result.isConfirmed) {

            produitStore.deleteProduit(id)

        }
    });
}

onMounted(() => {
    produitStore.getproduit();
    produitStore.getCategorie();
    produitStore.getFournisseur();
})
</script>

<template>
    <div class="content">
        <vue-good-table :columns="colums" :rows="produitStore.produits.data"
            styleClass="vgt-table striped lesspadding2 table-head mt-3" :pagination-options="{
                enabled: true,
                perPage: 20,
            }" :search-options="{
                enabled: true,
                externalQuery: searchTerm,
                width: '50%',
            }" max-heigth="500px" max-width="100%" :fixed-header="true">
            <template v-slot:table-actions>
                <button type="button" class="btn btn-alt-primary me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-block-large">
                    Nouveau
                </button>

            </template>

            <template v-slot:table-row="props">
                <span v-if="props.column.field == 'Actif'">
                    <span>
                        <span v-if="props.row.Actif == 1"
                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-dark">OUI</span>
                        <span v-else
                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-dark">NON</span>
                    </span>

                </span>
                <span v-if="props.column.field == 'Action'">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-toggle="modal"
                        data-bs-target="#modal-block-edit" @click="produitStore.getOneProduit(props.row.id)">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                    <button type="button" @click="deleteProduit(props.row.id)" class="btn btn-sm btn-alt-secondary">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </span>

            </template>

        </vue-good-table>

        <!-- END Full Table -->
    </div>

    <div class="modal fade" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <BaseBlock title="Creer un nouveau produit" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>

                    <template #content>
                        <form @submit.prevent="produitStore.addProduit(produitStore.newProduit)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Categorie<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="produitStore.newProduit.categorie_id">
                                                <option selected>Open this select menu</option>
                                                <option v-for="categorie in produitStore.produits.allcategorie"
                                                    :key="categorie.id" :value="categorie.id">
                                                    {{ categorie.libelle }}
                                                </option>

                                            </select>

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Fournisseur<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="produitStore.newProduit.fournisseur_id" placeholder="Choisissez une categorie">
                                                <option selected>Open this select menu</option>
                                                <option v-for="fournisseur in produitStore.produits.allfournisseur"
                                                    :key="fournisseur.id" :value="fournisseur.id">
                                                    {{ fournisseur.rais_soc }}
                                                </option>

                                            </select>

                                        </div>



                                    </div>
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Designation<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="designation" name="designation"
                                                placeholder="Entrez la designation"
                                                v-model="produitStore.newProduit.designation" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif" true-value="1"
                                                v-model="produitStore.newProduit.Actif" false-value="0" />

                                        </div>



                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal" @click="produitStore.clearProduit">
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal" :isloading="produitStore.produits.loading">
                                    Valider
                                </button>
                            </div>
                        </form>

                    </template>
                </BaseBlock>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <BaseBlock title="Modifier produit" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>

                    <template #content>
                        <form @submit.prevent="produitStore.updateProduit(produitStore.newProduit)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Categorie<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="produitStore.newProduit.categorie_id">
                                                <option selected>Open this select menu</option>
                                                <option v-for="categorie in produitStore.produits.allcategorie"
                                                    :key="categorie.id" :value="categorie.id">
                                                    {{ categorie.libelle }}
                                                </option>

                                            </select>

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Fournisseur<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="produitStore.newProduit.fournisseur_id">
                                                <option selected>Open this select menu</option>
                                                <option v-for="fournisseur in produitStore.produits.allfournisseur"
                                                    :key="fournisseur.id" :value="fournisseur.id">
                                                    {{ fournisseur.rais_soc }}
                                                </option>

                                            </select>

                                        </div>



                                    </div>
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Designation<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="designation" name="designation"
                                                placeholder="Entrez la designation"
                                                v-model="produitStore.newProduit.designation" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif" true-value="1"
                                                v-model="produitStore.newProduit.Actif" false-value="0" />

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal" @click="produitStore.clearProduit">
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal" :isloading="produitStore.produits.loading">
                                    Valider
                                </button>
                            </div>
                        </form>

                    </template>
                </BaseBlock>
            </div>
        </div>
    </div>

</template>
