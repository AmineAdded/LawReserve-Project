<template>
  <nav class="navbar navbar-expand-md" id="navbar">
    <!-- Brand -->
    <a v-if="isLoggedin" class="navbar-brand" href="#" id="logo">
    {{ userName }}
    </a>
    <a v-else class="navbar-brand" href="#" id="logo">Estishara</a>



    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span><i class="bi bi-list"></i></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Home</router-link>
        </li>
        <!-- dropdown -->
        <li class="nav-item">
          <router-link :to="{ name: 'home', hash: '#about' }" class="nav-link">Explore</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/login-signup" class="nav-link">Login/SignUp</router-link> 
        </li>
        <li class="nav-item">
          <router-link to="/" @click.prevent="signOut" class="nav-link">Sign out</router-link>
        </li>
        <li class="nav-item">

          <router-link :to="{ name: 'home', hash: '#contact-section' }" class="nav-link">Contact</router-link>

        </li>
      </ul>
    </div>
    <div class="icons">

      <img src="" alt="" width="20px" class="bi bi-person-fill">
      <img src="" alt="" width="20px" class="bi bi-heart-fill">
      <img src="" alt="" width="24px" class="bi bi-cart-plus-fill">
    </div>
  </nav>

</template>

<script>

export default {
  name: "NavBarView",
  data() {
    return {
      book: "#book",
      arrival: "#arrival"
    }
  },
  props: {
        isLoggedin: {
            type: Boolean,
            required: true,
        },
        userName: {
            type: String,
            default: '',
        },
    },
    methods:{
      signOut() {
      this.$emit('sign-out'); // Émet un événement vers App.vue
      },
    },
}
</script>
<style scoped>
/* navbar */
#navbar {

  background-color: #412203;
  padding-left: 60px;
  padding-right: 60px;
  font-weight: bold;
  /* position: fixed; */
  width: 100%;
  z-index: 1000;
  /* Adjust the z-index to ensure the navbar is above other elements */
}

#logo {
  font-size: 23px;
  color: rgb(223, 207, 163);
}

#logo img {
  margin-bottom: 15px;
}

.navbar-nav {
  margin-left: 10px;
}

.nav-link {
  color: rgb(232, 196, 147);
  font-weight: bold;
  text-shadow: 1px 1px 1px black;
  margin-left: 15px;
  transition: 0.5s ease;
}

.nav-link:hover {
  background-color: rgb(197, 198, 205);
  color: white;
  border-radius: 5px;
}

.icons {
  margin-left: 30px;
}

.icons img {
  margin-left: 10px;
  transition: 0.5s ease;
  cursor: pointer;
  color: antiquewhite;
}

.icons img:hover {
  transform: translateY(-5px);
}

@media screen and (max-width:330px) {
  #logo {
    font-size: 15px;
  }
}

div .menu {
  background-color: #fff6ed;

}

/* navbar end */
</style>