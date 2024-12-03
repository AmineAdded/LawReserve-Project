<template>
    <!-- footer -->
    <footer id="footer" data-aos="fade-up" data-aos-duration="1500">
      <div class="footer-content">
        <img :src="image" alt="Logo" class="footer-logo" />
        <h1 class="text-center">Estichara Contact</h1>
        <div class="icons text-right">
          <i class="bx bxl-facebook"></i>
          <i class="bx bxl-instagram"></i>
        </div>
      </div>
      <div id="copy">
      <div class="copyright text-center">
        &copy; Copyright <strong>Estichara</strong>. All Rights Reserved
      </div>
      <div class="credite text-center">
        Designed By <span>Amine , Rayen & Souha</span>
      </div>
    </div>
    </footer>
    <!-- footer -->
  </template>
  
  <script>
  export default {
    name: "FooterView",
    data() {
      return {
        image: require("../assets/logo1.png"),
      };
    },
  };
  </script>
  
  <style scoped>
  /* footer */
  #footer {
    width: 100%;
    background-color: rgb(0, 0, 0);
    box-shadow: 0px 0px 5px white;
  
   
  }
  
  /* Conteneur principal du footer */
  .footer-content {
  display: grid;

  font-size: 12px;
  grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); /* Chaque élément prend une fraction de la largeur */
  gap: 15px; /* Ajouter de l'espace entre les éléments */
margin-top: 60px;
}



  
  /* Logo */
  .footer-logo {
    max-width: 150px;
    margin-right: 20px;
  }
  
  /* Titre */
  #footer h1 {
    color: rgb(170, 147, 147);
    padding-top: 30px;
    text-align: center;
  }

  /* Icônes */
  .icons i {
    background-color: white;
    color: #573818;
    border-radius: 50%;
    padding: 6px;
    font-size: 30px;
    transition: 0.5s;
    cursor: pointer;
    margin-left: 10px;
  }
  
  .icons i:hover {
    background-color: rgb(179, 137, 132);
    color: #573818;
  }
  
  /* Copyright et crédit */
  #copy{
    margin-top: 0;
    margin-bottom: 0;
  }
  .copyright,
  .credite {
    color: #573818;
    
  }

  .text-center {
    text-align: center;
  }
  /* footer */
  </style>
  