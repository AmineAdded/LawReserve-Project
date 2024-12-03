<template>
  <div class="container">
    <router-link to="/AddService" class="add-btn btn"
      >⚖ Add Service</router-link
    >
    <div class="content">
      <div class="services">
        <h2>Your Services</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="Service in Services" :key="Service.id">
              <td>{{ Service.title }}</td>
              <!-- <td><img :src="require(`@/${Service.image}`)" style="width: 50px;height: 50px; border-radius: 10px;"></td> -->
              <td>{{ Service.description }}</td>
              <td>{{ Service.price }}</td>
              <td style="width: 100px;">
                <button style="width: 65px;margin-bottom: 5px"
                  class="view-btn"
                  @click.prevent="displayService(Service.id)"
                >
                  View
                </button>
                <button
                  class="delete-btn"
                  @click.prevent="deleteService(Service.id)"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="appointments">
        <h2>Your Appointments</h2>
        <table>
          <thead>
            <tr>
              <th>Client Name</th>
              <th>Service</th>
              <th>Date</th>
              <th>Price</th>
              <th>Video Call</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="appointment in appointments"
              :key="appointment.idAppointment"
            >
              <td>{{ appointment.client }}</td>
              <td>{{ appointment.service }}</td>
              <td>{{ appointment.date }}</td>
              <td>{{ appointment.price }}</td>
              <td>
                <button class="view-btn">Join</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <FooterView style="margin-top: 200px"></FooterView>
</template>
<script>
// import axios from "axios";

import FooterView from "@/components/FooterView.vue";
import EventService from "@/services/EventService.js";
export default {
  name: "LawView",
  emits: ["updateUser"],
  components: {
    FooterView,
  },
  data() {
    return {
      LawView: [],
      Services: null,
      appointments: [],
    };
  },
  props: {
    userName: {
      type: String,
      default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
    },
  },
  methods: {
    deleteService(id) {
      if (confirm("Delete ?") == true) {
        EventService.deleteService(id)
          .then((response) => {
            console.log(response);
            this.$router.push({ name: "LawView" }).then(() => {
              this.$router.go();
            });
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    displayService(id) {
      EventService.displayService(id)
        .then((response) => {
          const data = response.data;
          this.$router.push({
            name: "DisplayService",
            query: {
              title: data.title,
              price: data.price,
              description: data.description,
              category: data.category,
            },
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    fetchAppointments() {
      // Remplir appointments avec les données des rendez-vous depuis votre API
      EventService.getAppointments(this.userName)
        .then((response) => {
          this.appointments = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    EventService.getServices(this.userName)
      .then((reponse) => {
        console.log(this.userName);
        this.Services = reponse.data;
      })
      .catch((error) => {
        console.log(error);
      });

    this.fetchAppointments();
    // Récupérer les services
    EventService.getAppointments(this.userName)
      .then((response) => {
        this.appointments = response.data;
        console.log(this.appointments); //AFFICHAGE DES APPOINTMENTS DANS LA CONSOLE
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style scoped>
.container {
  font-family: "Georgia", serif;
  background-color: #f4e9d8; /* Light beige background */
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 1200px;
  margin: 0 auto;
  margin-top: 25px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.add-btn {
  background-color: #8b5e3c;
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.3s;
  padding: 10px;
  display: block;
  max-width: 200px;
  margin: 0 auto 20px;
  text-align: center;
}

.add-btn:hover {
  background-color: #5a3e2b; /* Darker brown when hovered */
}

.content {
  display: flex;
  flex-wrap: wrap; /* Allow wrapping on smaller screens */
  gap: 20px;
}

.services,
.appointments {
  flex: 1 1 calc(50% - 20px); /* Take 50% of the width minus the gap */
  background-color: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #5a3e2b;
  font-size: 1.5rem;
  margin-bottom: 20px;
  border-bottom: 2px solid #c49a6c;
  padding-bottom: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th,
td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

.view-btn,
.delete-btn {
  padding: 5px 10px;
  margin-right: 5px;
  border: none;
  cursor: pointer;
}

.view-btn {
  background-color: #8b5e3c;
  color: #fff;
  border-radius: 5px;
}

.delete-btn {
  background-color: #ad130e;
  color: #fff;
  border-radius: 5px;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
  .content {
    flex-direction: column;
  }

  .services,
  .appointments {
    flex: 1 1 100%; /* Take full width on smaller screens */
  }

  h2 {
    font-size: 1.2rem;
  }

  table {
    font-size: 0.9rem; /* Adjust table font size */
  }
}

@media (max-width: 480px) {
  .add-btn {
    width: 100%; /* Button spans full width */
  }

  table {
    font-size: 0.8rem;
  }

  th,
  td {
    padding: 8px;
  }

  .view-btn,
  .delete-btn {
    font-size: 0.8rem; /* Smaller buttons for small screens */
    padding: 5px;
  }
}
</style>