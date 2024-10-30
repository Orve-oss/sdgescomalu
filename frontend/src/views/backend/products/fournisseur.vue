<script setup>
import { onMounted, ref } from "vue";
import { useFournisseurStore } from "@/stores/fournisseur";
// import Swal from "sweetalert2";


const fourStore = useFournisseurStore();

const colums = ref([
    { label: 'ID', field: 'id' },
    { label: 'Rais. Soc.', field: 'rais_soc' },
    { label: 'Tel', field: 'telephone' },
    { label: 'Adresse', field: 'adresse' },
    { label: 'Actif', field: 'Actif' },
    { label: 'Action', field: 'Action' },
])


const deleteFournisseur = async (id) => {
    Swal.fire({
        title: 'Voulez-vous supprimer ce Fournisseur?',
        text: 'Cette action est irreversible!!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Oui',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
    }).then((result) => {
        if (result.isConfirmed) {

            fourStore.deleteFournisseur(id);

        }
    });
}
onMounted(() => {
    fourStore.getFournisseur();
    fourStore.getDefprix();
    // getFournisseurs();
})
</script>

<template>
    <div class="content">
        <vue-good-table :columns="colums" :rows="fourStore.fournisseurs"
            styleClass="vgt-table striped lesspadding2 table-head mt-3" :pagination-options="{
                enabled: true,
                perPage: 20,
            }" :search-options="{
                enabled: true,
                externalQuery: searchTerm,
                width: '50%',
            }" max-heigth="500px" max-width="100%" theme="black-rhino" :fixed-header="true">
            <!-- <div v-slot:table-actions-bottom>
               <button type="button" class="btn btn-sm btn-alt-success me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-block-fadein">
                    <i class="fa fa-plus"></i>Nouveau
                </button>
            </div> -->
            <template v-slot:table-actions>
                <button type="button" class="btn btn-sm btn-alt-success me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-block-fadein">
                    <i class="fa fa-plus"></i>Nouveau
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
                        data-bs-target="#modal-block-edit" @click="fourStore.getOneFournisseur(props.row.id)">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                    <button type="button" @click="deleteFournisseur(props.row.id)" class="btn btn-sm btn-alt-secondary">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </span>

            </template>

        </vue-good-table>

    </div>

    <!-- Create a new Fournisseur modal -->
    <div class="modal fade" id="modal-block-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <BaseBlock title="Ajouter un Fournisseur" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close"
                            @click="fourStore.clearFournisseur">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>
                    <template #content>
                        <form @submit.prevent="fourStore.addFournisseur(fourStore.newFournisseur)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Definition de prix<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="fourStore.newFournisseur.defprix_id">
                                                <option selected>Open this select menu</option>
                                                <option v-for="defprix in fourStore.defprix"
                                                    :key="defprix.id" :value="defprix.id">
                                                    {{ defprix.nom }}
                                                </option>

                                            </select>

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Raison Sociale<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="raison-sociale" name="Rais_Soc"
                                                v-model="fourStore.newFournisseur.rais_soc"
                                                placeholder="Entrez la raison sociale" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Telephone<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                                v-model="fourStore.newFournisseur.telephone"
                                                placeholder="Entrez le numero de telephone" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Adresse<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="adresse" name="Adresse"
                                                placeholder="Entrez l'adresse"
                                                v-model="fourStore.newFournisseur.Adresse" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif"
                                                v-model="fourStore.newFournisseur.Actif" true-value="1"
                                                false-value="0" />

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="fourStore.clearFournisseur">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                                    >
                                    Creer
                                </button>
                            </div>
                        </form>
                    </template>

                </BaseBlock>
            </div>
        </div>
    </div>

    <!-- Update Client modal -->
    <div class="modal fade" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-edit"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <BaseBlock title="Modifier le client" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close"
                            @click="fourStore.clearFournisseur">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>
                    <template #content>
                        <form @submit.prevent="fourStore.updateFournisseur(fourStore.newFournisseur)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Definition de prix<span
                                                    class="text-danger">*</span> :</label>
                                            <select class="form-select" id="example-select" name="example-select"
                                                v-model="fourStore.newFournisseur.defprix_id">
                                                <option selected>Open this select menu</option>
                                                <option v-for="defprix in fourStore.defprix"
                                                    :key="defprix.id" :value="defprix.id">
                                                    {{ defprix.nom }}
                                                </option>

                                            </select>

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Raison Sociale<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="raison-sociale" name="rais_soc"
                                                v-model="fourStore.newFournisseur.rais_soc"
                                                placeholder="Entrez la raison sociale" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Telephone<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="tel" class="form-control" id="telephone" name="telephone"
                                                v-model="fourStore.newFournisseur.telephone"
                                                placeholder="Entrez le numero de telephone" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Adresse<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="adresse" name="Adresse"
                                                placeholder="Entrez l'adresse"
                                                v-model="fourStore.newFournisseur.adresse" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif"
                                                v-model="fourStore.newFournisseur.Actif" true-value="1"
                                                false-value="0" />

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="fourStore.clearFournisseur">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                                    >
                                    Modifier
                                </button>
                            </div>
                        </form>
                    </template>

                </BaseBlock>
            </div>
        </div>
    </div>
</template>
