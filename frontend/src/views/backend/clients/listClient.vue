<script setup>
import { onMounted, ref } from "vue";
// import axios from 'axios';
import { useClientStore } from "@/stores/client";
import Swal from "sweetalert2";
// import useVuelidate from "@vuelidate/core";
// import {
//     required,
//     minLength,
// } from "@vuelidate/validators";

// const rules = computed(() => {
//     return {
//         Rais_Soc: {
//             required,
//             minLength: minLength(3),
//         },
//         Contact: {
//             required,
//             minLength: minLength(8),
//         },
//         Adresse: {
//             required,

//         },

//     };
// });
// const v$ = useVuelidate(rules);

const clientStore = useClientStore();

const colums = ref([
    { label: 'ID', field: 'id' },
    { label: 'Rais. Soc.', field: 'Rais_Soc' },
    { label: 'Contact', field: 'Contact' },
    { label: 'Adresse', field: 'Adresse' },
    { label: 'Actif', field: 'Actif' },
    { label: 'Action', field: 'Action' },
])

// Used to reference example blocks
// let clients = ref([]);
// let orderSearch = false;


// const getClients = () => {
//     axios.get('http://sdgescomalu.test/api/clients').then((response) => {
//         clients.value = response.data;
//     })
// };

const deleteClient = async (id) => {
    Swal.fire({
        title: 'Voulez-vous supprimer ce client?',
        text: 'Cette action est irreversible!!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Oui',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
    }).then((result) => {
        if (result.isConfirmed) {

            clientStore.deleteClient(id)

        }
    });
}
onMounted(() => {
    clientStore.getclient()
    // getClients();
})
</script>

<template>
    <div class="content">
        <vue-good-table :columns="colums" :rows="clientStore.clients.data"
            styleClass="vgt-table striped lesspadding2 table-head mt-3" :pagination-options="{
                enabled: true,
                perPage: 20,
            }" :search-options="{
                enabled: true,
                externalQuery: searchTerm,
                width: '50%',
            }" max-heigth="500px" max-width="100%" :fixed-header="true">
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
                        data-bs-target="#modal-block-edit" @click="clientStore.getOneClient(props.row.id)">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                    <button type="button" @click="deleteClient(props.row.id)" class="btn btn-sm btn-alt-secondary">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </span>

            </template>

        </vue-good-table>

    </div>

    <!-- Create a new Client modal -->
    <div class="modal fade" id="modal-block-fadein" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <BaseBlock title="Creer un client" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close"
                            @click="clientStore.clearClient">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>
                    <template #content>
                        <form @submit.prevent="clientStore.addClient(clientStore.newClient)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Raison Sociale<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="raison-sociale" name="Rais_Soc"
                                                v-model="clientStore.newClient.Rais_Soc"
                                                placeholder="Entrez la raison sociale" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Contact<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="tel" class="form-control" id="contact" name="Contact"
                                                v-model="clientStore.newClient.Contact"
                                                placeholder="Entrez le contact" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Adresse<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" id="adresse" name="Adresse"
                                                placeholder="Entrez l'adresse"
                                                v-model="clientStore.newClient.Adresse" />

                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif"

                                                v-model="clientStore.newClient.Actif" true-value="1"
                                                false-value="0"/>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="clientStore.clearClient">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                                    :isLoading="clientStore.clients.loading">
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
    <div class="modal" id="modal-block-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-edit"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <BaseBlock title="Modifier le client" transparent class="mb-0">
                    <template #options>
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close"
                            @click="clientStore.clearClient">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </template>
                    <template #content>
                        <form @submit.prevent="clientStore.updateClient(clientStore.newClient)">
                            <div class="block-content fs-sm">

                                <div class="row push">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Raison Sociale :</label>
                                            <input type="text" class="form-control" id="raison-sociale" name="Rais_Soc"
                                                v-model="clientStore.newClient.Rais_Soc"
                                                placeholder="Entrez la raison sociale" />
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Contact :</label>
                                            <input type="tel" class="form-control" id="contact" name="Contact"
                                                v-model="clientStore.newClient.Contact"
                                                placeholder="Entrez le contact" />
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-text-input">Adresse :</label>
                                            <input type="text" class="form-control" id="adresse" name="Adresse"
                                                placeholder="Entrez l'adresse"
                                                v-model="clientStore.newClient.Adresse" />
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label mx-1" for="actif">Actif<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="checkbox" id="Actif" name="Actif"

                                                v-model="clientStore.newClient.Actif" true-value="1"
                                                false-value="0"/>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                    @click="clientStore.clearClient">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                                    :isLoading="clientStore.clients.loading">
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
