<template>
  <div class="container">
    <div class="consultant-info">
      <h2>{{ service.title }}</h2>
      <p><strong>Consultant:</strong> {{ service.consultantName }}</p>
      <p><strong>Category:</strong> {{ service.category }}</p>
      <p><strong>Price:</strong> {{ service.price }} DT</p>
      <p><strong>Description:</strong> {{ service.description }}</p>
    </div>
    <div class="appointment-form">
      <h2>Ajouter un rendez-vous</h2>
      <form>
        <label for="name">Votre nom:</label>
        <input type="text" id="name" disabled :value="userName" />
        <label for="datetime">Entrez la date et l'heure pour votre rendez-vous:</label>
        <input type="datetime-local" id="datetime" name="datetime" v-model="dateTime"/>
        <button class="button" @click.prevent="Payer">Pay Now</button>
        <!-- <router-link to="/PaymentForm" class="button" type="submit">
          Pay Now
        </router-link> -->
      </form>
    </div>
  </div>
  <FooterView style="margin-top: 130px"></FooterView>
</template>

<script>
import FooterView from "@/components/FooterView.vue";
import EventService from "@/services/EventService.js"; 

export default {
  name: "ViewAppointment",
  components: {
    FooterView,
  },
  data() {
    return {
      service: {}, // Objet pour stocker les données du service
      dateTime: ""
    };
  },
  props: {
    userName: {
      type: String,
      default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
    },
  },
  methods: {
    // Méthode pour récupérer les informations du service
    fetchServiceDetails() {
      const serviceId = this.$route.params.serviceId; // Récupérer l'ID du service depuis les paramètres de la route
      EventService.displayService(serviceId)
        .then((response) => {
          this.service = response.data; // Stocker les données du service dans l'objet `service`
        })
        .catch((error) => {
          console.error("Erreur lors de la récupération du service :", error);
        });
    },
    Payer(){
      this.$router.push({
        name:"PaymentForm",
        query:{
          consultantName:this.service.consultantName,
          service:this.service.category,
          price:this.service.price,
          date:this.dateTime
        }
      })
    },
  },
  created() {
    this.fetchServiceDetails(); // Charger les données du service lors de la création du composant
  },
};
</script>

<style scoped>
.container {
  font-family: "Georgia", serif;
  width: 100%;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap; /* Pour permettre un affichage en colonne sur les petits écrans */
  justify-content: space-around;
  padding: 20px;
  background-color: #f4e9d8;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
  padding-bottom: 150px;
}

.consultant-info,
.appointment-form {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 45%; /* Partage l'espace pour les grands écrans */
  margin-top: 30px;
  font-family: "Georgia", serif;
  text-align: left; /* Alignement naturel pour les textes */
}

h2 {
  color: #5a3e2b; /* Dark brown for the title */
  font-size: 1.8rem;
  margin-bottom: 20px;
  border-bottom: 2px solid #c49a6c;
  padding-bottom: 10px;
  text-align: center;
}

label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
}

input[type="text"],
input[type="datetime-local"] {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

.button {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 20px;
  background-color: #8b5e3c;
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.3s;
  cursor: pointer;
  text-align: center;
}

.button:hover {
  background-color: #5a3e2b; /* Darker brown when hovered */
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
  .container {
    flex-direction: column; /* Passe en colonne pour les écrans moyens */
    align-items: center;
  }

  .consultant-info,
  .appointment-form {
    width: 90%; /* Occupe presque tout l'espace pour plus de lisibilité */
  }

  h2 {
    font-size: 1.5rem;
  }

  input[type="text"],
  input[type="datetime-local"] {
    font-size: 0.9rem;
  }

  .button {
    font-size: 0.9rem;
    padding: 8px 15px;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 15px;
  }

  .consultant-info,
  .appointment-form {
    width: 100%; /* Utilise tout l'espace disponible sur très petits écrans */
  }

  h2 {
    font-size: 1.2rem;
  }

  label {
    font-size: 0.9rem;
  }

  input[type="text"],
  input[type="datetime-local"] {
    font-size: 0.85rem;
    padding: 6px;
  }

  .button {
    font-size: 0.85rem;
    padding: 8px 12px;
  }
}
</style>
