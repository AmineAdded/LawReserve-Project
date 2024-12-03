<template>
  <div class="main" style="margin-top: 100px">
    <input type="checkbox" id="chk" aria-hidden="true" />

    <div class="signup">
      <form @submit.prevent="signup">
        <label for="chk" aria-hidden="true">Sign up</label>
        <input
          type="text"
          name="username"
          placeholder="User name"
          required=""
          v-model="username"
        />
        <input
          type="email"
          name="email"
          placeholder="Email"
          required=""
          v-model="email"
        />
        <input
          type="number"
          name="phonenumber"
          placeholder="Phone number"
          required=""
          v-model="phonenumber"
        />
        <input
          type="password"
          name="password"
          placeholder="Password"
          required=""
          v-model="password"
        />
        <button style="background-color: rgb(232, 196, 147)" type="submit">
          Sign up
        </button>
        <div v-if="errorMessage" class="error-message">
          <p>{{ errorMessage }}</p>
        </div>
      </form>
    </div>

    <div class="login">
      <form @submit.prevent="login">
        <label for="chk" aria-hidden="true">Login</label>
        <input
          type="email"
          name="email1"
          placeholder="Email"
          required=""
          style="margin-top: 100px"
          v-model="email1"
        />
        <input
          type="password"
          name="password1"
          placeholder="Password"
          required=""
          v-model="password1"
        />
        <button style="background-color: rgb(232, 196, 147)" type="submit">
          Login
        </button>
        <div v-if="errorMessage" class="error-message">
          <p>{{ errorMessage }}</p>
        </div>
      </form>
    </div>
  </div>
  <FooterView></FooterView>
</template>
<script>
import FooterView from "@/components/FooterView.vue";
import { createUserWithEmailAndPassword, updateProfile } from "firebase/auth";
// import EventService from "@/services/EventService";

import { signInWithEmailAndPassword } from "firebase/auth";
import { auth } from "../firebase/firebase.js";
export default {
  name: "LoginSignUp",
  components: {
    FooterView,
  },

  emits: ["update-user"],
  data() {
    return {
      username: "",
      email: "",
      phonenumber: "",
      password: "",
      email1: "",
      password1: "",
      errorMessage: "",
      isLoggedin: false,
    };
  },
  methods: {
    login() {
      if (!this.email1 || !this.password1) {
        this.errorMessage = "Please fill in all fields.";
        return;
      }

      signInWithEmailAndPassword(auth, this.email1, this.password1)
        .then(() => {
          // Émettre les informations utilisateur après le login
          this.$emit("update-user", {
            isLoggedin: true,
            userName: auth.currentUser.displayName,
          });

          if (this.email1.endsWith("@lawyer.com")) {
            this.$router.push({ name: "LawView" });
          }
          else if (this.email1.endsWith("@gmail.com")) {
            this.$router.push({ name: "AppointmentView" });
          }
          else {
            this.$router.push({ name: "home" });
          }
          })
        .catch(() => {
          this.errorMessage = "Email or password is wrong";
        });
    },
    signup() {
      if (
        !this.email ||
        !this.password ||
        !this.username ||
        !this.phonenumber
      ) {
        this.errorMessage = "Please fill in all fields.";
        return;
      }

      createUserWithEmailAndPassword(auth, this.email, this.password)
        .then(() => {
          // Mettre à jour le profil utilisateur avec le displayName
          return updateProfile(auth.currentUser, {
            displayName: this.username, // Définir le displayName
          });
        })
        .then(() => {
          // Émettre les informations utilisateur après le signup
          this.$emit("update-user", {
            isLoggedin: true,
            userName: this.username,
          });

          // Vérifier si l'email se termine par @lawyer.com
          if (this.email.endsWith("@lawyer.com")) {
              this.$router.push({ name: "LawView" });
          } else if (this.email.endsWith("@gmail.com")){
              this.$router.push({ name: "AppointmentView" });
          }
          else{
            this.$router.push({ name: "home" });
          }
        })
        .catch((error) => {
          this.errorMessage = error.message;
        });
    },
  },
};
</script>
<style scoped>
body {
  margin: 400px;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  font-family: "Jost", sans-serif;
  background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.main {
  width: 500px;
  height: 600px;
  margin-left: 500px;
  /* margin-top: 100px; */
  background: #402a23;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 5px 20px 50px #000;
  background-image: url("../assets/background.jpg");
  background-size: cover;
  background-position: center;
  overflow: hidden;
}
#chk {
  display: none;
}
.signup {
  position: relative;
  width: 100%;
  height: 100%;
}
label {
  color: #fff;
  font-size: 2.3em;
  justify-content: center;
  display: flex;
  margin: 50px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.5s ease-in-out;
  height: 40px;
}
input {
  width: 60%;
  height: 20px;
  background: #e0dede;
  justify-content: center;
  display: flex;
  margin: 20px auto;
  padding: 20px;
  border: none;
  outline: none;
  border-radius: 5px;
}
button {
  width: 60%;
  height: 40px;
  margin: 10px auto;
  justify-content: center;
  display: block;
  color: #fff;
  background: rgba(232, 197, 147, 0.452);
  font-size: 1em;
  font-weight: bold;
  margin-top: 30px;
  outline: none;
  border: none;
  border-radius: 5px;
  transition: 0.2s ease-in;
  cursor: pointer;
}
button:hover {
  background: rgb(232, 196, 147);
}
.login {
  height: 600px;
  background: #eee;
  border-radius: 60% / 10%;
  transform: translateY(-180px);
  transition: 0.8s ease-in-out;
}
.login label {
  color: rgb(225, 152, 48);
  transform: scale(0.6);
}

#chk:checked ~ .login {
  transform: translateY(-600px);
}
#chk:checked ~ .login label {
  transform: scale(1);
}
#chk:checked ~ .signup label {
  transform: scale(0.6);
}
.error-message p {
  color: red;
  font-size: 14px;
  text-align: center;
  margin-top: 10px;
}
@media (max-width: 768px) {
  .main {
    margin-left: 0%;
  }
}
@media (max-width: 480px) {
  .main {
    width: 200px;
    justify-content: center;
    margin-left: 0%;
  }
  input {
    width: 100%;
  }
  button {
    width: 100%;
  }
  .login {
    transform: translateY(-100px);
  }
  .login label {
    transform: scale(1);
  }
  .signup label {
    transform: scale(0.6);
  }
}
</style>