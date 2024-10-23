import { defineStore } from "pinia";
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export const useproduitstore = defineStore("produit", {
    state: () => ({
        //pour definir les attributs
        produitsErrors: [],
        produits: {
            loading: false,
            data: [],
            id: "",
            allcategorie: [],
            allfournisseur: [],
        },
        newProduit: {
            designation: "",
            Actif: "",
            fournisseur_id: "",
            categorie_id: "",

        },
    }),
    actions: {
        async getproduit() {
            this.produits.data = [];
            this.produits.loading = true;
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/produits`
                );
                this.produits = {
                    ...this.produits,
                    data: response.data,
                    loading: false,
                };
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
                this.produits.allcategorie = response.data.categorie;
            } catch (error) {
                console.log(error);
            }
        },

        async getFournisseur(){
            try {
                const response = await axios.get(
                    `http://sdgescomalu.test/api/fournisseurs`
                );
                this.produits.allfournisseur = response.data.fournisseur;
            } catch (error) {
                console.log(error);
            }
        },
        async addProduit(data) {
            try {
                this.produits.data = [];
                this.produits.loading = true;
                await axios.post(`http://sdgescomalu.test/api/produits/add`,{
                    designation: data.designation,

                    Actif: data.Actif,
                    fournisseur_id: data.fournisseur_id,
                    categorie_id: data.categorie_id,
                });
                toast.success("Produit cree avec succes", {
                    autoClose: 2000,
                });
                this.produits.loading = false;
                this.clearProduit();
                this.getproduit();
            } catch (error) {
                console.log(error);
                this.produitsErrors = error.response.data.errors;
                toast.error("Erreur lors de la creation", {
                    autoClose: 2000,
                });
                this.getproduit();
            }
        },

        clearProduit(){ //reinitialiser les attributs
            this.newProduit.designation = "",
            this.newProduit.Actif = "",
            this.newProduit.fournisseur_id = "",
            this.newProduit.categorie_id = ""
        },

        async getOneProduit(id){
            try{
                this.clearProduit()
                this.id = id
                const data = await axios.get(`http://sdgescomalu.test/api/produits/show/`+id)
                this.newProduit.designation = data.data.Produit.designation

                this.newProduit.Actif = data.data.Produit.Actif
                this.newProduit.fournisseur_id = data.data.Produit.fournisseur_id
                this.newProduit.categorie_id = data.data.Produit.categorie_id

            }

            catch(error){
                console.log(error)
            }
        },

        async updateProduit(data){
            try {
                this.produitsErrors = [];
                this.produits.loading = true;
                const resp = await axios.put(`http://sdgescomalu.test/api/produits/change/`+this.id,{
                    designation: data.designation,

                    Actif: data.Actif,
                    fournisseur_id: data.fournisseur_id,
                    categorie_id: data.categorie_id,
                });
                if (resp.data.message) {
                    toast.success('Produit modifie avec success', {
                        autoClose: 2000,
                    })
                    this.getproduit();
                    this.clearProduit();
                    this.produits.loading=false;

                } else {
                    toast.error('Erreur lors de la modification', {
                        autoClose: 2000,
                    })

                }

            } catch (error) {
                this.produits.loading=false;
                toast.error("Erreur de modification ", {
                    autoClose: 3000,
                  })

            }
        },

        async deleteProduit(id){
            try {
                const resp = await axios.delete(`http://sdgescomalu.test/api/produits/delete/`+id);
                if (resp.data.message) {
                    toast.success('Produit supprime avec success', {
                        autoClose: 1000,
                    })
                    this.getproduit();

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
