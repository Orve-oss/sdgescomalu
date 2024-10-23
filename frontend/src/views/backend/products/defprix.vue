<script setup>
import { ref, onMounted } from 'vue';
import { useDefprixStore } from '@/stores/defprix';
import Swal from 'sweetalert2';

const defprixStore = useDefprixStore();
const colums = ref([
    { label: 'ID', field: 'id' },
    {
        label: 'nom',
        field: 'nom',
    },
    {
        label: 'Actions',
        field: 'Action',
    },

])

const deleteDefprix = async (id) => {
    Swal.fire({
        title: 'Voulez-vous supprimer ce prix?',
        text: 'Cette action est irreversible!!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Oui',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
    }).then((result) => {
        if (result.isConfirmed) {

            produitStore.deleteDefprix(id)

        }
    });
}

onMounted(() => {
    defprixStore.getDefprix();
})
</script>

<template>
    <div class="content">


         <vue-good-table :columns="colums" :rows="defprixStore.defprix.data"
            styleClass="vgt-table striped lesspadding2 table-head mt-3" :pagination-options="{
                enabled: true,
                perPage: 20,
            }" :search-options="{
                enabled: true,
                externalQuery: searchTerm,
                width: '50%',
            }" max-heigth="500px" max-width="100%" :fixed-header="true">
            <template v-slot:table-actions>
                <button type="button" class="btn btn-alt-success me-2" data-bs-toggle="modal"
                        data-bs-target="#modal-block-vcenter">
                        Nouveau
                    </button>
            </template>

            <template v-slot:table-row="props">

                <span v-if="props.column.field == 'Action'">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-toggle="modal"
                        data-bs-target="#modal-block-vcenter-edit" @click="defprixStore.getOnedefprix(props.row.id)">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                    <button type="button" @click="deleteDefprix(props.row.id)" class="btn btn-sm btn-alt-secondary">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </span>

            </template>

        </vue-good-table>

        <!-- END Full Table -->
    </div>
    <div class="modal fade" id="modal-block-vcenter" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <BaseBlock title="Nouvelle definition de prix" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>

                    <template #content>
                        <form @submit.prevent="defprixStore.addDefprix(defprixStore.newdefprix)">
                            <div class="block-content fs-sm">
                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Designation<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                placeholder="Entrez la designation"
                                                v-model="defprixStore.newdefprix.nom" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="defprixStore.cleardefprix">
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-sm btn-success" data-bs-dismiss="modal">
                                    Valider
                                </button>
                            </div>
                        </form>

                    </template>
                </BaseBlock>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-block-vcenter-edit" tabindex="-1" role="dialog"
        aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <BaseBlock title="Modifier la definition de prix" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>

                    <template #content>
                        <form @submit.prevent="defprixStore.updateDefprix(defprixStore.newdefprix)">
                            <div class="block-content fs-sm">
                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Designation<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                placeholder="Entrez la designation"
                                                v-model="defprixStore.newdefprix.nom" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="defprixStore.cleardefprix">
                                    Annuler
                                </button>
                                <button type="submit" class="btn btn-sm btn-success" data-bs-dismiss="modal">
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


