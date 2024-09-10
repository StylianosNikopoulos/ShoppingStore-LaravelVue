<template>
    <div class="payment-cancelled-container">
      <h1>Payment Cancelled</h1>
      <p>Your payment was not completed. You can return to your cart to try again or review your items.</p>
      <button @click="goBackToCart" class="return-button">Return to Cart</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      async goBackToCart() {
            window.location.href = '/cart';       
}    }
  }
  </script>
  
  <style scoped>
  .payment-cancelled-container {
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
    color: #dc3545;
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
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .return-button:hover {
    background-color: #0056b3;
  }
  </style>
  