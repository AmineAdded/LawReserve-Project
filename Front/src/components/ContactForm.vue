<template>
    <section id="contact">
      <div class="sectionheader">
        <h1>CONTACT</h1>
      </div>
      <article>
        <p>Yoda soon you will call me master Governor Tarkin. A new hope Boba Fett bantha forest moon. Tusken raider
          Master Yoda do or do not never tell me the odds.</p>
   
        <label for="checkcontact" class="contactbutton">
          <div class="mail"></div>
        </label>
        <input id="checkcontact" type="checkbox">
   
        <form @submit.prevent="handleSubmit" class="contactform">
          <p class="input_wrapper"><input v-model="contact.nom" type="text" name="contact_nom" id="contact_nom" required><label for="contact_nom">NAME</label></p>
          <p class="input_wrapper"><input v-model="contact.email" type="email" name="contact_email" id="contact_email" required><label for="contact_email">EMAIL</label></p>
          <p class="input_wrapper"><input v-model="contact.sujet" type="text" name="contact_sujet" id="contact_sujet" required><label for="contact_sujet">SUBJECT</label></p>
          <p class="textarea_wrapper"><textarea v-model="contact.message" name="contact_message" id="contact_message" required></textarea></p>
          <p class="submit_wrapper"><input type="submit" value="ENVOYER"></p>
        </form>
   
        <!-- Affichage des feedbacks -->
        <div v-if="feedbacks.length" class="feedbacks-section">
          <h2>Feedbacks</h2>
          <div v-for="(feedback, index) in feedbacks" :key="index" class="feedback">
            <p><strong>{{ feedback.nom }}</strong> (<em>{{ feedback.email }}</em>) - <strong>{{ feedback.sujet }}</strong></p>
            <p>{{ feedback.message }}</p>
          </div>
        </div>
      </article>
    </section>
 </template>
   
  <script>
  export default {
    data() {
      return {
        contact: {
          nom: '',
          email: '',
          sujet: '',
          message: ''
        },
        feedbacks: []
      };
    },
    props:{
        isLoggedin: {
            type: Boolean,
            required: true
        }
    },
    methods: {
      handleSubmit() {
        const isLoggedin = sessionStorage.getItem('isLoggedin')
        if (!isLoggedin) {
        // Rediriger vers la page LoginSignUp
        this.$router.push({ name: 'login-signup' });
        return;
      }
        const feedback = { ...this.contact }; // Créer un objet feedback avec les données du formulaire
        this.feedbacks.push(feedback); // Ajouter le feedback à la liste des feedbacks
   
        // Réinitialiser le formulaire
        this.contact.nom = '';
        this.contact.email = '';
        this.contact.sujet = '';
        this.contact.message = '';
      }
    }
  };
  </script>
   
   
  <style>
  /* Contact Form Style */
  @import url(https://fonts.googleapis.com/css?family=Oswald:400,700);
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);
   
  body {
      background: #F0F0F0;
      font-family: Open Sans, sans-serif;
      line-height: 1.5em;
  }
   
  #contact {
      width: 500px;
      margin: 2em auto;
      background: white;
      position: relative;
  }
   
  #contact::after {
      content: "";
      display: block;
      height: 30px;
      width: 90%;
      left: 5%;
      bottom: 0;
      position: absolute;
      box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.19);
      border-radius: 100%;
      z-index: -1;
  }
   
  #contact article {
      padding: 1em;
  }
   
  #contact h1 {
      background: rgb(232, 196, 147);
      font-family: Oswald, sans-serif;
      font-size: 1.75em;
      padding: 0.6em 0 0.6em 0.4em;
      color: white;
      text-shadow: 0 0.06em 0 #424242;
      position: relative;
  }
   
  .contactbutton {
      background: rgb(232, 196, 147);
      box-shadow: 1px 1px 0 0 #832032, 2px 2px 0 0 #832032, 3px 3px 0 0 #832032;
      text-align: center;
      display: block;
      width: 100%;
      height: 50px;
      margin-top: 20px;
      margin-bottom: 2px;
      cursor: pointer;
  }
   
  .contactbutton:hover {
      box-shadow: 1px 1px 0 0 #832032, 0px 0px 0 0 #832032, 0px 0px 0 0 #832032;
      margin-top: 22px;
      margin-left: 2px;
      margin-bottom: 0px;
  }
   
  .mail {
      margin-top: 11px;
      font-size: 15px;
      display: inline-block;
      border-top: 2em solid transparent;
      border-left: 2.6em solid #832032;
      height: 0;
      width: 0;
      position: relative;
  }
   
  .mail:before {
      content: '';
      top: -2.5em;
      left: -2.95em;
      display: block;
      position: absolute;
      border-top: 1.2em solid #832032;
      border-left: 1.6em solid transparent;
      border-right: 1.6em solid transparent;
      border-bottom: 1em solid transparent;
      font-size: 0.8em;
  }
   
  .mail::after {
      display: block;
      content: "";
      position: absolute;
      border-top: 2em solid transparent;
      border-right: 2.6em solid #832032;
      height: 0;
      width: 0;
      left: -2.18em;
      bottom: 0;
  }
   
   
  #checkcontact {
      position: absolute;
      left: -9999px;
  }
   
  .contactform {
      overflow: hidden;
      max-height: 0px;
      transition: all linear 1s;
  }
   
  #checkcontact:checked+.contactform {
      max-height: 1000px;
  }
   
  .input_wrapper {
      position: relative;
  }
   
  .input_wrapper input[type="text"],
  .input_wrapper input[type="email"] {
      margin-top: 1em;
      display: block;
      width: 100%;
      background: white;
      border: 1px solid #DADADA;
      box-shadow: 0 0 1px 0 #E4E4E4;
      padding: 1em;
      color: #5E5E5E;
      text-indent: 15%;
      transition: all 250ms ease;
  }
   
  .input_wrapper input[type="text"]:focus,
  .input_wrapper input[type="email"]:focus {
      background: rgba(242, 56, 90, 0.05);
      box-shadow: inset 2px 2px 5px 0 #DADADA;
      outline: none;
      text-indent: 0;
  }
   
  .input_wrapper label {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      background: rgb(232, 196, 147);
      color: white;
      font-family: Oswald, sans-serif;
      width: 15%;
      text-align: center;
      line-height: 2.8em;
      transition: all 250ms ease;
  }
   
  .input_wrapper input[type="text"]:focus+label {
      left: 85%;
  }
   
  .input_wrapper input[type="email"]:focus+label {
      left: 85%;
  }
   
  .textarea_wrapper textarea {
      margin-top: 20px;
      display: block;
      width: 100%;
      min-height: 150px;
      background: white;
      border: 1px solid #DADADA;
      box-shadow: 0 0 1px 0 #E4E4E4;
      padding: 1em;
      color: #5E5E5E;
      transition: all 250ms ease;
  }
   
  .textarea_wrapper textarea:focus {
      background: rgba(242, 56, 90, 0.05);
      box-shadow: inset 2px 2px 5px 0 #DADADA;
      outline: none;
  }
   
  .submit_wrapper input {
      width: 40%;
      height: 50px;
      margin-top: 1em;
      background: rgb(232, 196, 147);
      color: white;
      font-family: Oswald, sans-serif;
      cursor: pointer;
      transition: all 250ms ease;
  }
   
  .submit_wrapper input:hover {
      background: #832032;
      box-shadow: 1px 1px 0 0 #832032, 0px 0px 0 0 #832032, 0px 0px 0 0 #832032;
      margin-top: 22px;
      margin-left: 2px;
      margin-bottom: 0px;
  }
   
  @media (max-width: 500px) {
      #contact {
          width: 100%;
      }
   
      .input_wrapper label {
          line-height: 3.5em;
          font-size: 0.8em;
      }
  }
   
  /* Feedback Section */
  .feedbacks-section {
      margin-top: 40px;
      padding: 1em;
      background: #F9F9F9;
      border-radius: 8px;
  }
   
  .feedback {
      padding: 10px;
      background: #fff;
      border: 1px solid #e4e4e4;
      margin-bottom: 10px;
      border-radius: 5px;
  }
   
  .feedback p {
      margin: 0;
  }
   
  .feedback strong {
      font-weight: bold;
  }
   
  .feedback em {
      color: #555;
  }
   
  .feedback p:last-child {
      margin-top: 10px;
  }
   
  </style>
   