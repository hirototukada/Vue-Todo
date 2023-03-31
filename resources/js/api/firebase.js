// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

const firebaseConfig = {
    apiKey: "AIzaSyDCBKVwJyEsM_86KwFwaMuVyF89FIQKQ1w",
    authDomain: "vue-project-3c224.firebaseapp.com",
    projectId: "vue-project-3c224",
    storageBucket: "vue-project-3c224.appspot.com",
    messagingSenderId: "219846257953",
    appId: "1:219846257953:web:3152ca1b8a1e1a4d1b2260",
    measurementId: "G-YZDKPTFYX6",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firebase Authentication and get a reference to the service
const auth = getAuth(app);

export default auth;
