// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore"; 
import { getAuth } from 'firebase/auth'
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCGOYWP-d-WrZNKN1GoY238G-guh5SClLg",
  authDomain: "vueproject-95ae2.firebaseapp.com",
  projectId: "vueproject-95ae2",
  storageBucket: "vueproject-95ae2.firebasestorage.app",
  messagingSenderId: "660879114454",
  appId: "1:660879114454:web:3fd40875b9555716a40977",
  measurementId: "G-73T643CE2E"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

 // init & export firestore service
 export const db = getFirestore(app); // Update this line
 // generate & export auth object
 export const auth = getAuth(app);
