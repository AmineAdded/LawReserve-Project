<template>
  <div :class="boxClass">
    <div class="card" v-for="category in categorys" :key="category.id">
      <div class="overlay">
        <button type="button" class="btn btn-secondary" title="Quick View">
          <i><img src="#" class="bi bi-person-fill" alt="" width="30px" /></i>
        </button>
        <button type="button" class="btn btn-secondary" title="Add to Wishlist">
          <i><img src="#" class="bi bi-heart-fill" alt="" width="30px" /></i>
        </button>
        <button type="button" class="btn btn-secondary" title="Add to Cart">
          <i><img src="#" class="bi bi-bag-plus" alt="" width="30px" /></i>
        </button>
      </div>
      <div class="card-body">
        <img :src="require(`@/${category.image}`)" alt="Please Wait" />
        <h3>{{ category.title }}</h3>
        <div class="star">
          <i class="bx bxs-star checked"></i>
          <i class="bx bxs-star checked"></i>
          <i class="bx bxs-star checked"></i>
          <i class="bx bxs-star"></i>
          <i class="bx bxs-star"></i>
        </div>
        <p>{{ category.description }}</p>
        <h6>
          {{ category.price }}
          <span>
            <button
              :class="{ hoverButton: true, liked: category.liked }"
              @click="toggleLike(category)"
            >
              {{ category.liked ? "Liked" : "Like" }}
            </button>
          </span>
        </h6>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "component-category",
  props: {
    categorys: {
      type: Array, // Correction : `categorys` doit être un tableau
      required: true,
    },
    boxClass: {
      type: String,
      required: false,
      default: "",
    },
  },
  methods: {
    toggleLike(category) {
      if (category.liked) {
        // Si déjà aimé, retirer des likes
        category.liked = false; // Réinitialiser l'état
        this.removeFromLikeList(category); // Appeler la méthode correspondante
      } else {
        // Sinon, ajouter aux likes
        category.liked = true; // Mettre à jour l'état
        this.addToLikeList(category); // Appeler la méthode correspondante
      }
    },
    addToLikeList(category) {
      this.$emit("add-to-likelist", category.id); // Émettre un événement pour informer le parent
      console.log(`Added to like list: ${category.title}`);
    },
    removeFromLikeList(category) {
      this.$emit("remove-from-likelist", category.id); // Émettre un événement pour informer le parent
      console.log(`Removed from like list: ${category.title}`);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/* product cards */
h1 {
  text-align: center;
  font-weight: bold;
  margin-top: 50px;
  color: rgb(47, 41, 31);
  text-shadow: 1px 1px 1px black;
  border-bottom: 2px solid rgba(161, 109, 14, 1);
}

.card {
  background-color: rgb(255, 248, 236);
  box-shadow: 0 0 3px black;
  border-radius: 5px;
  cursor: pointer;
  width: 300px;
  height: 600px;
  text-align: center;
  padding: 5px;
  border: 1px solid #919191;
  margin: auto 20px;
}

.overlay {
  display: block;
  opacity: 0;
  position: absolute;
  top: 10%;
  margin-left: 0;
  width: 70px;
}

.card:hover .overlay {
  opacity: 1;
  margin-left: 5%;
  transition: 0.5s ease;
}

.overlay i {
  background-color: #0f0e0e;
  height: 30px;
  width: 30px;
  font-size: 20px;
  padding: 7px;
  margin: -20%;
  margin-bottom: 5%;
  cursor: pointer;
}

.overlay .btn-secondary {
  background: transparent !important;
  border: none;
  box-shadow: none;
}

h3 {
  color: rgb(30, 26, 26);
  text-shadow: 1px 1px 1px rgb(24, 18, 18);
}

.star .checked {
  color: yellow;
}

p {
  color: #2e1700;
  font-weight: bold;
  width: 250px;
  height: 100px;
}

h6 {
  font-size: 20px;
  color: #2e1700;
  font-weight: bold;
}

h6 span button {
  width: 109px;
  height: 26px;
  font-size: 15px;
  background: transparent;
  letter-spacing: 3px;
  border: 2px solid #bbbab8;
  border-radius: 5px;
  float: right;
  font-weight: bold;
  transition: 0.5s ease;
  cursor: pointer;
}
.hoverButton:hover {
  background-color: #2e1700;
  color: white;
}

/* Style après clic */
.hoverButton.liked {
  background-color: #2e1700; /* Appliquer le même style que le hover */
  color: white;
}

span a {
  display: block;
  float: right;
}

.card-body img {
  width: 150px;
  height: 150px;
  margin: auto 35px;
}

::-webkit-scrollbar {
  width: 10px;
  height: 5px;
}

::-webkit-scrollbar-track {
  box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.2);
}

::-webkit-scrollbar-thumb {
  background: #089da1;
  border-radius: 10px;
}

.btnremove {
  margin-top: 20px;
}

.card-body {
  display: flex;
  flex-direction: column;
  align-items: center; /* Centrer horizontalement */
  justify-content: space-between; /* Espacer les éléments */
  height: 100%;
}

.card-body img {
  width: 180px; /* Ajustez la largeur selon vos besoins */
  height: 150px; /* Ajustez la hauteur selon vos besoins */
  object-fit: cover; /* Maintient les proportions tout en remplissant la zone */
  border-radius: 15px; /* Coins arrondis */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre douce pour un effet d'élévation */
  transition: transform 0.3s ease; /* Effet de zoom au survol */
}

.star {
  display: flex;
  justify-content: center; /* Centrer les étoiles */
  gap: 5px; /* Espacement entre les étoiles */
}

h3,
p,
h6 {
  margin: 10px 0; /* Espacement vertical uniforme */
  text-align: center; /* Aligner le texte au centre */
}

h6 {
  display: flex;
  justify-content: space-between; /* Mettre le prix et le bouton sur une même ligne */
  align-items: center;
  width: 100%;
}

h6 span button {
  margin-left: auto; /* Décaler le bouton à droite */
}

.card {
  display: inline-flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  margin: 20px;
  width: 300px;
  height: 500px;
  text-align: center;
}
/* product cards end */
</style>