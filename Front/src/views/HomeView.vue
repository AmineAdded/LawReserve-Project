<template>
  <section class="home">
        <div class="content">
          <h3>Connecting 
            Lawyers and
            property</h3>
          <p :style="styleP">Estichara is the go-to platform for law consultants and clients alike.</p>
          <router-link to="/" ><a href="" class="white-btn">discover more</a></router-link>
          <p :style="styleP">40+ Consultant 60+ Happy Customer 6+ Awards</p>
        </div>
  </section>

  
<!---books-->  
<section id="product-cards "    data-aos="fade-up" data-aos-duration="1500">
      <div class="cart btn bi bi-heart-fill">({{ cart.length }})</div>
        <div class="container" id="category">
            <h1>Categorys</h1>
                <componentCategory :categorys="categorys" boxClass="box" @add-to-likelist="updateCart" @remove-from-likelist="removeById"/>
        </div>
    </section>
<!---end-books-->  

 <!---about us-->
  <div id="about" data-aos="fade-up" data-aos-duration="1500">
      <div id="about1_image">
          <img :src="image1">
      </div>
      <div class="about_tag">
          <h1>Estichar</h1>
          <h2>User-Friendly Experience</h2>
        <p>
          Estichara is an innovative web platform that bridges the gap between legal consultants and clients, providing a seamless and efficient way for both parties to connect and collaborate. 
          With a focus on enhancing accessibility and convenience, LegalConnect revolutionizes the legal consultation process, making it easier for clients to find and engage with qualified legal consultants.
        </p>
      </div>
  </div>

   <!---Our Value-->

  <div class="about" data-aos="fade-up" data-aos-duration="1500">
  <div class="about_image">
    <img :src="image2" alt="About Image">
  </div>
  <div class="about_tag">
    <h1>Our Value</h1>
    <h2>Our Values We Give to You</h2>
    <p>We are always ready to help by providing the best services for you.</p>
    <div class="values">
      <div class="value_box">
  <div class="value_icon" @click="toggleValue(1)">
    <i class="fas fa-video"></i>
  </div>
  <h3>Virtual Consultations</h3>
  <p v-if="visibleValues[1]" class="value_description">
  The website offers a cutting-edge video call feature, enabling clients to connect with their chosen legal consultant virtually.
</p>

</div>

<div class="value_box">
  <div class="value_icon" @click="toggleValue(2)">
    <i class="fas fa-lock"></i>
  </div>
  <h3>Secure Online Payments</h3>
  <p v-show="visibleValues[2]" class="value_description">
    The website ensures secure and hassle-free payment processing. Clients can conveniently pay for their chosen services through various payment methods.
  </p>
</div>

<div class="value_box">
  <div class="value_icon" @click="toggleValue(3)">
    <i class="fas fa-headset"></i>
  </div>
  <h3>Client Support</h3>
  <p v-show="visibleValues[3]" class="value_description">
    The website values the satisfaction of its users, and therefore, offers a dedicated support system.
  </p>
</div>
</div>
  </div>
   </div>

   <!---Our Value-->
<section class="home-contact">

<div class="content" id="contact-section">
   <h3>have any questions?</h3>
   <p>We are at your disposal to provide you with clear and precise legal advice to protect your rights and interests.</p>
   <ContactForm></ContactForm>
</div>

</section>
  <FooterView></FooterView>
</template>

<script>
// @ is an alias to /src

import componentCategory from "@/components/componentCategory.vue";
import ContactForm  from "@/components/ContactForm.vue";
import { RouterLink } from "vue-router";
import EventService from "@/services/EventService.js";
import FooterView from "@/components/FooterView.vue";
export default {
  name: "HomeView",
  components: {
    componentCategory,
    ContactForm,
    FooterView,
    RouterLink ,
},
  data() {
    return {
      cart: [],
      categorys: null,
      premium: true,
      visibleValues: {
        1: false,
        2: false,
        3: false,
      },
      image1:require("../assets/l13.jpg"),
      image2:require("../assets/about2.jpg"),
      styleP:{marginTop: '50px'},
    };
  },
  methods: {
    updateCart(id) {
    // Vérifiez si l'élément a déjà été ajouté au panier
    if (!this.cart.includes(id)) {
      this.cart.push(id); // Ajoutez l'élément si ce n'est pas déjà dans le panier

      console.log(`Added item with ID: ${id} to cart.`);
    } else {
      console.log(`Item with ID: ${id} is already in the cart.`);
    }
  },
    removeById(id) {
      const index = this.cart.indexOf(id);
      if (index > -1) {
        this.cart.splice(index, 1);
      }
    },
    displayCart() {
      // Affiche les IDs des livres dans le panier
      console.log("Cart Contents:", this.cart);
    },
    toggleValue(id) {
      // Basculer la visibilité pour l'élément avec cet ID
      if (this.visibleValues[id] !== undefined) {
        this.visibleValues[id] = !this.visibleValues[id];
        console.log(`Toggle value for id: ${id}, now: ${this.visibleValues[id]}`);
      } else {
        console.error(`ID ${id} not found in visibleValues`);
      }
    },

  },
  created() {
   EventService.getEvents().then(reponse => {
   this.categorys =reponse.data;
   }).catch((error) => {
        console.log(error);
      });
 },
  
};

</script>
<style scoped>
h1{
  text-align: center;
    font-weight: bold;
    margin-top: 100px;
    color: rgb(12, 9, 4);
    text-shadow: 1px 1px 1px black;
    border-bottom: 2px solid rgb(161, 109, 14);
}
h3 {
  color: #8c2d2d;
  margin: 12px 0;
  text-align: center;
}
.values {
  display: block;

}

.value_box {
  flex: 1 1 calc(33.333% - 20px);
  border: 2px solid #573818;
  border-radius: 10px;
  padding: 10px;
  text-align: center;
  transition: transform 0.3s ease;
margin-bottom: 0.3%;
width: 100%;
}

.value_box:hover {
  transform: scale(1);
}

.value_icon {
  font-size: 2rem;
  color: #573818;
  cursor: pointer;
}

.value_icon:hover {
  color: #a0522d;
}

.value_description {
  margin-top: 10px;
  font-size: 0.9rem;
  color: #333;
  display: block; 
  visibility: visible;
}

.hidden {
  display: none;
}
/* home section */
.home{
    width:100%;
    height: 100vh;
    display: flex;
    background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(../assets/law.jpg);
    background-size: cover;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    position: relative;
    z-index: 0;
    
}

.home .content{
    flex: 1 1 400px;
    margin-left: 60px;
}
.content h3{
    color: white;
    font-size: 60px;
    font-weight: bold;
    text-shadow: 1px 1px 1px black;
}
.content h2{
    font-size: 60px;
    color: white;
    text-shadow: 1px 1px 1px black;
    font-weight: bold;
}
.changecontent::after{
    content: ' ';
    color: rgba(161,109,14,1);
    animation: changetext 10s infinite linear;
    font-weight: bold;
}
.content p{
    font-size: 20px;
    color: white;
    font-weight: bold;
    text-shadow: 1px 1px 1px black;
}
.content .btn{
    width: 110px;
    height: 38px;
    background-color: #573818;
    color: white;
}
@media screen and (max-width:800px){
    .content h3{
        font-size: 50px;
    }
}
@media screen and (max-width:860px){
    .home{
        height: 120vh;
    }
}
@media screen and (max-width:560px){
    .home{
        height: 100vh;
    }
}
@media screen and (max-width:330px){
    .content h2{
        font-size: 30px;
    }
    .content h3{
        font-size: 30px;
    }
    .value_description{
      font-size: 0.3rem;
      display: none;
      color: #8c2d2d;
    }
}
.container{
    width: 100%;
    height: 105vh;
    padding: 20px 0;
}
.box {
    width: 95%;
    height: 80vh;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    overflow: hidden;
    overflow-x: scroll;

}

/* home section end */
.cart {
  float: right;
  border: 1px solid #d8d8d8;
  padding: 10px 30px;
  margin:25px 20px 0px 20px;
  background-color: white;
  -webkit-box-shadow: 0px 2px 15px -12px rgba(0, 0, 0, 0.57);
  -moz-box-shadow: 0px 2px 15px -12px rgba(0, 0, 0, 0.57);
  box-shadow: 2px 15px -12px rgba(0, 0, 0, 0.57);
}
/*about*/

.about{
    width: 100%;
    height: auto;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-top: 20px;
}

.about .about_image img{
  margin-top: 200px;
    width: 600px;
    height:500px;
    
}
#about{
    width: 100%;
    height: auto;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-top: 20px;
   
}
#about #about1_image img{

  width: 600px;
  height:600px;
    
}
img {
  border: 5px solid #573818;
  border-radius: 50px 50px 0px 0px;
}
#about .about_tag p{
    line-height: 22px;
    width: 650px;
    text-align: justify;
    margin-bottom: 15px;
}

#about .about_tag .about_btn{
    padding: 10px 20px;
    background: #a3a8a8;
    color: #fff;
    text-decoration: none;
    position: relative;
    top: 50px;
}
.about .about_tag p{
    line-height: 22px;
    width: 650px;
    text-align: justify;
    margin-bottom: 15px;
}

.about .about_tag .about_btn{
    padding: 10px 20px;
    background: #a3a8a8;
    color: #fff;
    text-decoration: none;
    position: relative;
    top: 50px;
}
/* about  end */
.home-contact{
   margin-top: 20px;
   margin-bottom:0px ;
}

.home-contact .content{
   max-width: 60rem;
   text-align: center;
   margin:0 auto;
}

.home-contact .content h3{
   font-size: 3rem;
   text-transform: uppercase;
   color:black;
}

.home-contact .content p{
   padding:1rem 0;
   line-height: 1.5;
   color:var(--light-white);
   font-size: 25px;
}
.white-btn{
   display: inline-block;
   margin-top: 1rem;
   padding:1rem 3rem;
   cursor: pointer;
   color:black;
   font-size: 16px;
   border-radius: .5rem;
   text-transform: capitalize;
   background-color: rgb(110, 67, 10);

}
.white-btn:hover{
   background-color: white;
   color:black;
   border:solid black;
}
.box-container {
  display: flex;
  flex-wrap: wrap; /* Permet le retour à la ligne si l'espace est insuffisant */
  justify-content: space-between; /* Ajuste l'espace entre les éléments */
}
/* Ajustements pour les tablettes */
@media screen and (max-width: 1024px) {
  .home {
    height: auto;
    padding: 20px;
    flex-wrap: wrap; /* Permet l'empilement si nécessaire */
  }

  .content h3 {
    font-size: 2.5rem; /* Réduit légèrement la taille du texte */
  }

  .content p {
    font-size: 1rem;
  }

  .about,
  #about {
    flex-direction: column; /* Empile les éléments */
    text-align: center;
  }

  .about_image img,
  #about1_image img {
    width: 80%; /* Réduit la largeur des images */
    height: auto; /* Conserve les proportions */
    margin: 20px auto;
  }

  .value_box {
    flex: 1 1 calc(50% - 20px); /* Deux cartes par ligne */
    max-width: 300px;
    margin: 10px auto;
  }

  .cart {
    margin: 15px auto; /* Centre la position du panier */
    float: none;
  }
}

/* Ajustements pour les mobiles */
@media screen and (max-width: 768px) {
  .home {
    padding: 10px;
  }

  .content h3 {
    font-size: 2rem;
    text-align: center;
  }

  .content p {
    font-size: 0.9rem;
    text-align: center;
  }

  .about_image img,
  #about1_image img {
    width: 90%;
  }

  .value_box {
    flex: 1 1 100%; /* Une seule carte par ligne */
    margin: 15px auto;
  }

  .container {
    grid-template-columns: 1fr 1fr; /* Deux colonnes pour les éléments */
  }
}

/* Ajustements pour très petits écrans */
@media screen and (max-width: 480px) {
  .home {
    padding: 5px;
  }

  .content h3 {
    font-size: 1.5rem;
  }

  .content p {
    font-size: 0.8rem;
  }

  .value_box {
    flex: 1 1 100%; /* Une seule carte par ligne */
    margin: 10px auto;
  }

  .cart {
    font-size: 0.9rem;
    padding: 5px 20px;
  }
  .about .about_tag p{
    line-height: 22px;
    width: 650px;
    text-align: justify;
    margin-bottom: 15px;
  }
}
</style>