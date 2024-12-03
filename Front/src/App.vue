<template>
  <div id="app">
    <NavBarView :isLoggedin="isLoggedin" :userName="userName" @sign-out="signOut" />
    <router-view @update-user="updateUser" :userName="userName" />
  </div>
</template>

<script>
import NavBarView from "@/components/NavBarView.vue";

export default {
  components: {
    NavBarView,
  },
  data() {
    return {
      isLoggedin: false,
      userName: '',
    };
  },
  methods: {
    updateUser(user) {
      this.isLoggedin = user.isLoggedin;
      this.userName = user.userName;

      // Stocker les informations de connexion dans sessionStorage
      sessionStorage.setItem('isLoggedin', user.isLoggedin);
      sessionStorage.setItem('userName', user.userName);
    },
    signOut() {
      this.isLoggedin = false;
      this.userName = '';

      // Supprimer les informations de connexion de sessionStorage
      sessionStorage.removeItem('isLoggedin');
      sessionStorage.removeItem('userName');
    },
  },
  created() {
    // Vérifier les informations de connexion dans sessionStorage
    const isLoggedin = sessionStorage.getItem('isLoggedin') === 'true';
    const userName = sessionStorage.getItem('userName');
    if (isLoggedin && userName) {
      this.isLoggedin = isLoggedin;
      this.userName = userName;
    }
  },
};
</script>
