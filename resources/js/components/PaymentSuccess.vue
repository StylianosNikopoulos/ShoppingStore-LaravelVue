<template>
    <div class="payment-success-container">
      <h1>Payment Success</h1>
      <p>Your payment was completed!</p>
      <button @click="goBackToHome" class="return-button">Return to home</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      async goBackToHome() {
            window.location.href = '/';       
}    }
  }
  </script>
  
  <style scoped>
  .payment-success-container {
    text-align: center;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto;
    margin-top: 20px;
  }
  
  h1 {
    font-size: 24px;
    color: green;
    margin-bottom: 20px;
  }
  
  p {
    font-size: 16px;
    margin-bottom: 30px;
  }
  
  .return-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #ffffff;
    background-color: #ff5722;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .return-button:hover {
    background-color: #f83a00;
  }
  </style>
  