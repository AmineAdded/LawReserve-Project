<template>
  <div class="container">
    <h1>Services</h1>
    <div class="cont">
      <div v-for="service in services" :key="service.id" class="service-card">
        <h2>{{ service.title }}</h2>
        <p>{{ service.category }}</p>
        <p class="price">{{ service.price }}DT</p>
        <router-link :to="{ name: 'ViewAppointment', params: { serviceId: service.id } }" class="add-btn">Add Appointment</router-link>
      </div>
    </div>
  </div>
  <FooterView style="margin-top: 210px;"></FooterView>
</template>

<script>
import FooterView from "@/components/FooterView.vue";
import EventService from "@/services/EventService.js"; // Assurez-vous d'importer votre service

export default {
  name: "CategoryList",
  components: {
    FooterView
  },
  data() {
    return {
      services: []  // Tableau pour stocker les services
    };
  },
  created() {
    this.fetchServices(); // Appeler la méthode pour charger les services
  },
  methods: {
    // Méthode pour récupérer les services de l'API
    fetchServices() {
      EventService.getAllServices()  // Appel de la méthode getServices du service EventService
        .then(response => {
          this.services = response.data;  // Assurez-vous que la réponse est un tableau d'objets de services
        })
        .catch(error => {
          console.error("Il y a eu une erreur lors de la récupération des services: ", error);
        });
    }
  }
};
</script>

<style scoped>
.cont {
  font-family: 'Georgia', serif;
  padding: 20px;
  padding-bottom: 150px;
  background-color: #f4e9d8; 
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 1200px;
  margin: 0 auto;
  margin-top: 25px;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
}

h1 {
  color: #5a3e2b; /* Dark brown for the title */
  font-size: 2rem;
  margin-top: 20px;
  margin-bottom: 20px;
  border-bottom: 2px solid #c49a6c;
  padding-bottom: 10px;
  text-align: center;
}

.add-btn {
  display: inline-block;
  margin-bottom: 20px;
  padding: 10px 20px;
  background-color: #8b5e3c; /* Warm brown color */
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.3s;
  text-align: center;
}

.add-btn:hover {
  background-color: #5a3e2b; /* Darker brown when hovered */
}

.service-card {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  width: 230px;
  margin: 20px auto;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.service-card h2 {
  font-size: 1.5em;
  margin: 0 0 10px;
}

.service-card p {
  margin: 5px 0;
  font-size: 1em;
  color: #555;
}

.service-card .price {
  font-weight: bold;
  margin: 10px 0;
}

.service-card button {
  background-color: #6b4f1d;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
}

.service-card button:hover {
  background-color: #5a3f17;
}

/* Responsive Design */

@media (max-width: 1024px) {
  .cont {
    padding: 15px;
  }
  
  h1 {
    font-size: 1.8rem;
  }

  .service-card {
    width: 45%;
    margin: 15px;
  }
}

@media (max-width: 768px) {
  .cont {
    padding: 10px;
    display: block;
  }

  h1 {
    font-size: 1.6rem;
  }

  .service-card {
    width: 100%;
    margin: 10px 0;
  }

  .service-card h2 {
    font-size: 1.3rem;
  }

  .service-card p {
    font-size: 0.9rem;
  }

  .service-card .price {
    font-size: 1rem;
  }

  .service-card button {
    width: 100%;
    padding: 12px 0;
  }

  .add-btn {
    width: 100%;
    text-align: center;
    padding: 12px 0;
  }
}

@media (max-width: 480px) {
  .cont {
    padding: 10px;
    display: block;
  }

  h1 {
    font-size: 1.4rem;
  }

  .service-card {
    width: 100%;
    margin: 8px 0;
  }

  .service-card h2 {
    font-size: 1.2rem;
  }

  .service-card p {
    font-size: 0.85rem;
  }

  .service-card .price {
    font-size: 1rem;
  }

  .service-card button {
    padding: 10px 0;
  }

  .add-btn {
    width: 100%;
    text-align: center;
    padding: 10px 0;
  }
}

</style>