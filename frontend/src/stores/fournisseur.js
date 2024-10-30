import {defineStore }from "pinia";
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const useFournisseurStore = defineStore("fournisseur", {
    state: () => ({
        fournisseurs: [],
        defprix: [],
        newFournisseur: {
            rais_soc: "",
            telephone: "",
            adresse: "",
            email: "",
            Actif: "",
            defprix_id: "",
        },
        fournisseursErrors: {
            rais_soc: null,
            telephone: null,
            adresse: null,
            email: null,
            defprix_id: null,
        },

    }),
    actions: {
        async getFournisseur() {
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/fournisseurs`
                );
                this.fournisseurs = response.data.fournisseur;
            } catch (error) {
                console.log(error);
            }
        },
        async getDefprix() {
            this.defprix = [];
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/defprix/all`
                );
                this.defprix = response.data;
            } catch (error) {
                console.log(error);
            }
        },


        async addFournisseur(data) {
            try {
                this.fournisseurs = [];

                await axios.post(`http://sdgescomalu.test/api/fournisseurs/ajouter`,{
                    rais_soc: data.fournisseur.rais_soc,
                    telephone: data.fournisseur.telephone,
                    adresse: data.fournisseur.adresse,
                    email: data.fournisseur.email,
                    Actif: data.fournisseur.Actif,
                    defprix_id: data.fournisseur.defprix_id,

                });
                toast.success("Fournisseur cree avec succes", {
                    autoClose: 2000,
                });

                this.clearFournisseur();
                this.getFournisseur();
            } catch (error) {
                console.log(error);
                this.fournisseursErrors = error.response.data.errors;
                toast.error("Erreur lors de la creation", {
                    autoClose: 2000,
                });
            }
        },
        clearFournisseur() {
            this.newFournisseur = {
                rais_soc: "",
                telephone: "",
                adresse: "",
                email: "",
                Actif: "",
                defprix_id: "",
            };
        },

        async getOneFournisseur(id) {
            try {
                this.clearFournisseur();
                this.id = id;
                const data = await axios.get(
                    `http://sdgescomalu.test/api/fournisseurs/show/` + id
                );
                this.newFournisseur.rais_soc = data.data.fournisseur.rais_soc;
                this.newFournisseur.telephone = data.data.fournisseur.telephone;
                this.newFournisseur.adresse = data.data.fournisseur.adresse;
                this.newFournisseur.email = data.data.fournisseur.email;
                this.newFournisseur.Actif = data.data.fournisseur.Actif;
                this.newFournisseur.defprix_id = data.data.fournisseur.defprix_id;
            } catch (error) {
                console.log(error);
            }
        },

        async updateFournisseur(data) {
            try {
                const response = await axios.put(
                    `http://sdgescomalu.test/api/fournisseurs/editer/`+this.id,
                    {
                        rais_soc: data.rais_soc,
                        telephone: data.telephone,
                        adresse: data.adresse,
                        email: data.email,
                        Actif: data.Actif,
                        defprix_id: data.defprix_id,
                    }
                );
                toast.success("Fournisseur modifie avec succes", {
                    autoClose: 2000,
                });
                this.getFournisseur();
                this.clearFournisseur();
            } catch (error) {
                console.log(error);
                toast.error("Erreur lors de la modification", {
                    autoClose: 2000,
                });
            }
        },

        async deleteFournisseur(id) {
            try {
                const response = await axios.delete(
                    `http://sdgescomalu.test/api/fournisseurs/supprimer/` + id
                );
                toast.success("Fournisseur supprime avec succes", {
                    autoClose: 2000,
                });
                this.getFournisseur();
            } catch (error) {
                console.log(error);
                toast.error("Erreur lors de la suppression", {
                    autoClose: 2000,
                });
            }
        },
    },
});
