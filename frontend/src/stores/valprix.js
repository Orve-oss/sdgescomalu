import { defineStore } from "pinia";
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const useValprixStore = defineStore("valprix", {
    state: () => ({
        produit_id: null,
        defprix_id: null,
        pvte: '',
        categories: {
            data: [],
            id: null,
            errors: [],
        },
        produits:[],

        valprix: {
            data: [],
            loading: false,
            errors: [],
        },
        ligneproduit:{
            produit_id: '',

            designation: '',
        },
        newValprix: {
            pvte: '',
            defprix_id: '',
            produit_id: null,

        },
        defprix: {

            loading: false,
            id: '',
            data: [],
        },

    }),
    actions: {
        async getProduitByCategorie(id) {
            let url = ``
            try {
                url= `http://sdgescomalu.test/api/produits/getProduitByCategorie/`+id
                const response = await axios.get(url);

                this.produits = response.data.produits;
            } catch (error) {
                console.log(error);
            }

        },
        async getCategorie() {
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/categories`
                );

                console.log(response.data.categorie);
                this.categories.data = response.data.categorie;
            } catch (error) {
                console.log(error);
            }
        },
        async getValprix() {
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/valprix`
                );
                this.valprix.data = response.data.valprix;
            } catch (error) {
                console.log(error);
            }
        },

        async valprix(){
            const data = new FormData();
            data.append('pvte', this.pvte);
            data.append('defprix_id', this.defprix_id);
            data.append('produit_id', this.ligneproduit.produit_id);
            try {
                const resp = await axios.post(`http://sdgescomalu.test/api/valeurprix/ajouter`, data);
                if (resp.data.message) {
                    toast.success('Prix ajoute avec success', {
                        autoClose: 1000,
                    })
                    this.getValprix();
                    this.clearval();
                } else {
                    toast.error('Erreur lors de l\'ajout', {
                        autoClose: 1000,
                    })
                }
            } catch (error) {
                console.log(error);
            }
        },

        // async addValprix(data) {
        //     try {
        //         this.valprix.data = [];
        //         this.valprix.loading = true;
        //         await axios.post(`http://sdgescomalu.test/api/valeurprix/ajouter`,{
        //             pvte: data.pvte,
        //             defprix: data.defprix,
        //             produit_id: data.produit_id,
        //         });
        //         this.getValprix();
        //         this.clearval();
        //         toast.success('Prix ajoute avec success', {
        //             autoClose: 1000,
        //         })
        //     } catch (error) {
        //         console.log(error);
        //         toast.error('Erreur lors de l\'ajout', {
        //             autoClose: 1000,
        //         })
        //     }
        // },
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

        clearval() {
            this.newValprix = {
                pvte: '',
                produit_id: null
            };
        },


    },
});
