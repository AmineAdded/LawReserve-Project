<template>
  <div class="container">
    <h2>Your Appointments</h2>
    <router-link to="/CategoryList" class="add-btn"
      >🔍 Search Service</router-link
    >
    <table v-if="appointments.length > 0" class="appointment-table">
      <thead>
        <tr>
          <th>Law Consultant</th>
          <th>Service</th>
          <th>Price</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="appointment in appointments" :key="appointment.id">
          <td>{{ appointment.law }}</td>
          <td>{{ appointment.service }}</td>
          <td>{{ appointment.price }} DT</td>
          <td>{{ appointment.date }}</td>
        </tr>
      </tbody>
    </table>
    <p v-else class="no-appointments">No appointments found. Add one now!</p>
  </div>
  <FooterView style="margin-top: 100px;"></FooterView>
</template>

<script>
import FooterView from "@/components/FooterView.vue";
import EventService from "@/services/EventService.js";

export default {
  name: "AppointmentView",
  components: {
    FooterView,
  },
  props: {
    userName: {
      type: String,
      default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
    },
  },
  data() {
    return {
      appointments: [], // Stocke les données des rendez-vous
    };
  },
  methods: {
    fetchAppointments() {
      EventService.getAppointmentsClient(this.userName)
        .then((response) => {
          this.appointments = response.data; // Stocke les rendez-vous dans le tableau `appointments`
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération des rendez-vous :",
            error
          );
        });
    },
  },
  created() {
    this.fetchAppointments(); // Charger les rendez-vous à la création du composant
  },
};
</script>
<style scoped>
/* Base styling for the container */
.container {
  font-family: "Georgia", serif;
  background-color: #f4e9d8; /* Light beige background */
  padding: 20px;
  padding-bottom: 150px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 1200px;
  margin: 0 auto;
  margin-top: 25px;
}

/* Title style */
h2 {
  color: #5a3e2b; /* Dark brown for the title */
  font-size: 2rem;
  margin-bottom: 20px;
  border-bottom: 2px solid #c49a6c;
  padding-bottom: 10px;
  text-align: center;
}

/* Add button style */
.add-btn {
  display: inline-block;
  margin-bottom: 20px;
  padding: 10px 20px;
  background-color: #8b5e3c;
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.add-btn:hover {
  background-color: #5a3e2b; /* Darker brown when hovered */
}

/* Table styles */
.appointment-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  background-color: #ffffff; /* White background for table */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.appointment-table thead {
  background-color: #8b5e3c;
  color: #ffffff;
}

.appointment-table th,
.appointment-table td {
  padding: 12px 15px;
  text-align: left;
  border: 1px solid #d1c4b1; /* Light brown borders */
}

.appointment-table tr:nth-child(even) {
  background-color: #f9f5e6; /* Slightly darker background for even rows */
}

.appointment-table tr:hover {
  background-color: #f1e1c7; /* Hover effect */
}

/* Link style */
.appointment-table a {
  color: #8b5e3c; /* Matching brown color */
  text-decoration: underline;
  font-weight: bold;
}

.appointment-table a:hover {
  color: #5a3e2b; /* Dark brown color on hover */
}

/* No appointments message */
.no-appointments {
  color: #8b5e3c;
  font-size: 1.2rem;
  text-align: center;
  margin-top: 20px;
}
</style>