import axios from "axios";
import { defineStore } from "pinia";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const useDefprixStore = defineStore("defprix", {
    state: () => ({
        defprixErrors: [],
        defprix: {

            loading: false,
            id: '',
            data: [],
        },

        newdefprix:{
            nom: '',
        },
    }),
    actions: {
        async getDefprix() {
            this.defprix.data = [];
            this.defprix.loading = true;
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/defprix/all`
                );
                this.defprix = {
                    ...this.defprix,
                    data: response.data,
                    loading: false,
                };
            } catch (error) {
                console.log(error);
            }
        },

        async addDefprix(data) {
            try {
                this.defprix.data = [];
                this.defprix.loading = true;
                await axios.post(`http://sdgescomalu.test/api/defprix/ajout`,{
                    nom: data.nom,
                });
                toast.success("Defprix cree avec succes", {
                    autoClose: 2000,
                });
                this.defprix.loading = false;
                this.cleardefprix();
                this.getDefprix();
            } catch (error) {
                console.log(error);
                // this.defprixErrors = error.response.data.errors;
                toast.error("Erreur lors de la creation", {
                    autoClose: 2000,
                });
                this.cleardefprix();
                this.getDefprix();
            }
        },

        async cleardefprix(){
            this.newdefprix.nom = ''
        },

        async getOnedefprix(id){
            try{
                this.cleardefprix()
                this.id = id
                const data = await axios.get(`http://sdgescomalu.test/api/defprix/show/`+id)
                this.newdefprix.nom = data.data.defprix.nom

            }

            catch(error){
                console.log(error)
            }
        },

        async updateDefprix(data){
            try {
                this.defprixErrors = [];
                this.defprix.loading = true;
                const resp = await axios.put(`http://sdgescomalu.test/api/defprix/change/`+this.id,{
                    nom: data.nom
                });
                if (resp.data.message) {
                    toast.success('Defprix modifie avec success', {
                        autoClose: 2000,
                    })
                    this.getDefprix();
                    this.cleardefprix();
                    this.defprix.loading=false;

                } else {
                    toast.error('Erreur lors de la modification', {
                        autoClose: 2000,
                    })

                }

            } catch (error) {
                this.defprix.loading=false;
                toast.error("Erreur de modification ", {
                    autoClose: 3000,
                })
                console.log(error);
            }

        },

        async deleteDefprix(id){
            try {
                const resp = await axios.delete(`http://sdgescomalu.test/api/defprix/delete/`+id);
                if (resp.data.message) {
                    toast.success('Produit supprime avec success', {
                        autoClose: 1000,
                    })
                    this.getDefprix();

                } else {
                    toast.error('Erreur leur de la suppression', {
                        autoClose: 2000,
                    })

                }

            } catch(error){
                console.log(error);
            }

        },

    },
});
