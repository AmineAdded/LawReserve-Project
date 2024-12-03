<template>
    <div class="container">
      <h2>Add New Service</h2>
      <form @submit.prevent="onSubmit">
        <label for="name">Your Name:</label>
        <input type="text" id="name" disabled :value="userName">
        
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="e.g. I will do something I'm really good at"  v-model="title">
        
        <label for="category">Category</label>
        <select id="category" name="category" v-model="category">
          <option value="family-law">Family Law Services</option>
          <option value="criminal-law">Criminal Defense Services</option>
          <option value="real-estate-law">Real Estate Legal Services</option>
          <option value="immigration-legal">Immigration Legal Services</option>
          <option value="Employment-property">Employment Law Advaisory</option>
          <option value="intellectual-property">Intellectual Property Services</option>
          <option value="environmental-legal">Environmental Legal Services</option>
          <option value="business-law">Business Law Services</option>
        </select>
  
        <label for="cover-image">Cover Image</label>
        <input type="file" id="cover-image" name="cover-image" @change="handleFileUpload">
        
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Brief descriptions to introduce your service to customers" v-model="description"></textarea>
        
        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="price" v-model="price">
        
        <button type="submit" class="add-btn">Submit</button>
        <!-- <router-link to="" class="add-btn" type="submit"></router-link> -->

      </form>
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
     data() {
       return {
        image: null,
        title:'',
        category:'',
        description:'',
        price:''
     }
   },
   props: {
    userName: {
      type: String,
      default: "null", // Valeur par défaut au cas où `userName` n'est pas transmis
    },
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0]; // Récupère le fichier sélectionné
      this.image = file; // Stocke le fichier dans une propriété Vue
    },
    onSubmit(){
      let service={
        image:toString(this.image),
        title:this.title,
        category:this.category,
        description:this.description,
        price:this.price,
        consultantName:this.userName
      };
      

      EventService.addService(service).then((response) => {
        console.log(response);
        console.log(this.image);
        this.$router.push({name:"LawView"});
      })
    }
  }
};
  </script>
  <style scoped>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }

  .container {
    font-family: "Georgia", serif;
    max-width: 800px;
    width: 90%; /* Largeur relative pour s'adapter aux petits écrans */
    margin: 0 auto;
    padding: 20px;
    background-color: #f4e9d8;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-top: 20px;
  }

  h2 {
    color: #5a3e2b; /* Dark brown for the title */
    font-size: 2rem;
    margin-bottom: 20px;
    border-bottom: 2px solid #c49a6c;
    padding-bottom: 10px;
    text-align: center;
  }

  label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #5a3e2b;
  }

  input[type="text"],
  input[type="file"],
  textarea,
  select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
  }

  textarea {
    resize: vertical;
    min-height: 100px; /* Hauteur minimale pour les petits écrans */
  }

  .add-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #8b5e3c;
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s;
    cursor: pointer;
  }

  .add-btn:hover {
    background-color: #5a3e2b; /* Darker brown when hovered */
  }

  /* Media Queries for Responsiveness */
  @media (max-width: 768px) {
    h2 {
      font-size: 1.5rem;
    }

    .container {
      width: 95%; /* Réduction de la largeur pour petits écrans */
    }

    label {
      font-size: 0.9rem;
    }

    input[type="text"],
    textarea,
    select {
      font-size: 0.9rem;
      padding: 8px;
    }

    .add-btn {
      padding: 10px 15px;
      font-size: 0.9rem;
    }
  }

  @media (max-width: 480px) {
    h2 {
      font-size: 1.2rem;
    }

    .container {
      padding: 15px;
    }

    input[type="text"],
    textarea,
    select {
      font-size: 0.85rem;
      padding: 6px;
    }

    .add-btn {
      font-size: 0.85rem;
      padding: 8px 12px;
    }
  }
</style>
  