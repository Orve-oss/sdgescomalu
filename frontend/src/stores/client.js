import { defineStore } from "pinia";
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const useClientStore = defineStore("client", {
    state: () => ({
        //pour definir les attributs
        clientsErrors: [],
        clients: {
            loading: false,
            data: [],
            id: "",
        },
        newClient: {
            Rais_Soc: "",
            Contact: "",
            Adresse: "",
            Actif: "",

        },
    }),
    actions: {
        async getclient() {
            this.clients.data = [];
            this.clients.loading = true;
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/clients`
                );
                this.clients = {
                    ...this.clients,
                    data: response.data,
                    loading: false,
                };
            } catch (error) {
                console.log(error);
            }
        },
        async addClient(data) {
            try {
                this.clients.data = [];
                this.clients.loading = true;
                await axios.post(`http://sdgescomalu.test/api/clients/store`, {
                    Rais_Soc: data.Rais_Soc,
                    Contact: data.Contact,
                    Adresse: data.Adresse,
                    Actif: data.Actif,
                });
                toast.success("Client cree avec succes", {
                    autoClose: 2000,
                });
                this.clients.loading = false;
                this.clearClient();
                this.getclient();
            } catch (error) {
                this.clientsErrors = error.response.data.errors;
                toast.error("Erreur lors de la creation", {
                    autoClose: 2000,
                })
            }

        },

        clearClient(){ //reinitialiser les attributs
            this.newClient.Rais_Soc = "",
            this.newClient.Contact = "",
            this.newClient.Adresse = "",
            this.newClient.Actif = ""
        },

        async getOneClient(id){
            try{
                this.clearClient()
                this.id = id
                const data = await axios.get(`http://sdgescomalu.test/api/clients/get/`+id)
                this.newClient.Rais_Soc = data.data.client.Rais_Soc
                this.newClient.Contact = data.data.client.Contact
                this.newClient.Adresse = data.data.client.Adresse
                this.newClient.Actif = data.data.client.Actif
            }

            catch(error){
                console.log(error)
            }
        },

        async updateClient(data){
            try {
                this.clientsErrors = [];
                this.clients.loading = true;
                const resp = await axios.put(`http://sdgescomalu.test/api/clients/update/`+this.id,{
                    Rais_Soc: data.Rais_Soc,
                    Contact: data.Contact,
                    Adresse: data.Adresse,
                    Actif: data.Actif,


                });
                if (resp.data.message) {
                    toast.success('Client modifie avec success', {
                        autoClose: 2000,
                    })
                    this.getclient();
                    this.clients.loading=false;

                } else {
                    toast.error('Erreur lors de la modification', {
                        autoClose: 2000,
                    })

                }

            } catch (error) {
                this.clients.loading=false;
                toast.error("Erreur de modification ", {
                    autoClose: 3000,
                  })

            }
        },

        async deleteClient(id){
            try {
                const resp = await axios.delete(`http://sdgescomalu.test/api/clients/delete/`+id);
                if (resp.data.message) {
                    toast.success('Client supprime avec success', {
                        autoClose: 1000,
                    })
                    this.getclient();

                } else {
                    toast.error('Erreur leur de la suppression', {
                        autoClose: 2000,
                    })

                }

            } catch(error){
                console.log(error)
            }

        }
    },
});
