<template>
    <div class="consultant-info">
      <h2>Title: <strong>{{ this.$route.query.title }}</strong></h2>
      <p><strong>Consultant:</strong>{{ userName }}</p>
      <p><strong>Category:</strong>{{ this.$route.query.category }}</p>
      <p><strong>Price:</strong> {{ this.$route.query.price }}</p>
      <p>
        <strong>Description:</strong> {{ this.$route.query.description }}
      </p>
    </div>
    <FooterView style="margin-top: 130px;"></FooterView>
</template>
<script>
import FooterView from "@/components/FooterView.vue";
export default {
    name:"DisplayService",
    components: {
    FooterView
    },
    props: {
    userName: {
      type: String,
      default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
    },
  },
  emits: ["update-user"],
  data() {
    return {
      
    };
  },
    methods:{
    },
    created() {
      console.log(this.title, this.$route.query.price, this.$route.query.description);
}

}
</script>
<style scoped>
.consultant-info,
.appointment-form {
  background-color: #fff;
  padding: 80px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 45%;
  height: auto; /* Ajuster la hauteur pour le contenu dynamique */
  margin-top: 30px;
  font-family: "Georgia", serif;
  position: relative;
  left: 400px; /* Centré pour les grands écrans */
  top: 50px;
}

h2 {
  color: #5a3e2b; /* Dark brown for the title */
  font-size: 2rem;
  margin-bottom: 20px;
  border-bottom: 2px solid #c49a6c;
  padding-bottom: 10px;
  text-align: center;
}

/* Media Queries pour la responsivité */

@media (max-width: 1024px) {
  .consultant-info {
    width: 60%; /* Réduit la largeur à 60% sur les tablettes */
    padding: 60px; /* Réduit le padding */
    left: 20%; /* Centrage sur l'écran avec une petite marge */
  }

  h2 {
    font-size: 1.8rem; /* Ajuste la taille du titre */
  }
}

@media (max-width: 768px) {
  .consultant-info {
    width: 80%; /* Réduit la largeur à 80% sur les écrans plus petits */
    padding: 40px; /* Réduit le padding */
    left: 10%; /* Augmente la marge à gauche pour mieux centrer */
  }

  h2 {
    font-size: 1.6rem; /* Ajuste la taille du titre */
  }

  p {
    font-size: 0.95rem; /* Ajuste la taille des paragraphes */
  }
}

@media (max-width: 480px) {
  .consultant-info {
    width: 90%; /* Réduit la largeur à 90% sur les petits appareils */
    padding: 20px; /* Réduit le padding */
    left: 5%; /* Ajuste la marge à gauche pour une meilleure présentation */
  }

  h2 {
    font-size: 1.4rem; /* Ajuste la taille du titre */
  }

  p {
    font-size: 0.85rem; /* Ajuste la taille des paragraphes */
  }
}
</style>