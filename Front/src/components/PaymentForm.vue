<template>
<div class="container ">
    <div class="card px-4">
        <p class="h8 py-3">Payment Details</p>
        <div class="row gx-3">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Name</p>
                    <input class="form-control mb-3" type="text" :value="userName" disabled>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Card Number</p>
                    <input class="form-control mb-3" type="text" placeholder="1234 5678 435678" v-model="phonenumber">
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Expiry</p>
                    <input class="form-control mb-3" type="text" placeholder="MM/YYYY" v-model="dateExp">
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">CVV/CVC</p>
                    <input class="form-control mb-3 pt-2 " type="password" placeholder="***" v-model="CVVCVC">
                </div>
            </div>
            <div class="col-12">
                <button class=" btn btn-primary mb-3 " style="text-align: center;" @click.prevent="Payer">Pay {{this.$route.query.price}} DT</button>
                <!-- <router-link to="/AppointmentView" class=" btn btn-primary mb-3 " style="text-align: center;" @click.prevent="Payer">Pay {{this.$route.query.price}} DT</router-link> -->

            </div>
        </div>
    </div>
</div>
<FooterView></FooterView>
</template>

<script>
import FooterView from "@/components/FooterView.vue";
import EventService from "@/services/EventService.js";
export default {
    name: "AddService",
     components: {
       FooterView},
    data(){
        return{
            service: {},
        }
    },
    props:{
        userName: {
            type: String,
            default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
        },
    },
    methods:{
        Payer(){
            let appointment={
                consultantName:this.$route.query.consultantName,
                client:this.userName,
                service:this.$route.query.service,
                price:this.$route.query.price,
                date:this.$route.query.date
            }
            EventService.payAppointement(appointment).then((response) =>
            {
                this.service=response.data;
                console.log(this.service.consultantName);
                this.$router.push({name:"AppointmentView"});
            })
        },
    },
    created(){
        console.log(this.$route.query.dateTime);
    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}
 
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #5a3e2b; /* Marron foncé */
    padding: 30px 10px;
}
 
.container {
    font-family: 'Georgia', serif;
    width: 50%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-top: 20px;
    background-color: #d2b48c; /* Marron clair */
}
 
.card {
    max-width: 500px;
    margin: auto;
    color: #3b2e26; /* Marron moyen */
    border-radius: 20px;
}
 
p {
    margin: 0px;
}
 
.container .h8 {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
    color: #3b2e26; /* Marron moyen */
}
 
.btn.btn-primary {
    width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #8b6b3a 0%, #a57c55 51%, #8b6b3a 100%); /* Dégradé de marron */
    border: none;
    transition: 0.5s;
    background-size: 200% auto;
    color: #fff;
}
 
.btn.btn-primary:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}
 
.btn.btn-primary:hover .fas.fa-arrow-right {
    transform: translate(15px);
    transition: transform 0.2s ease-in;
}
 
.form-control {
    color: #3b2e26; /* Marron moyen */
    background-color: #d2b48c; /* Marron clair */
    border: 2px solid transparent;
    height: 60px;
    padding-left: 20px;
    vertical-align: middle;
}
 
.form-control:focus {
    color: #3b2e26; /* Marron moyen */
    background-color: #8b6b3a; /* Marron foncé */
    border: 2px solid #5a3e2b; /* Marron foncé */
    box-shadow: none;
}
 
.text {
    font-size: 14px;
    font-weight: 600;
    color: #3b2e26; /* Marron moyen */
}
 
::placeholder {
    font-size: 14px;
    font-weight: 600;
    color: #5a3e2b; /* Marron foncé */
}
</style>