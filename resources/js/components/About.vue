<template>
    <div class="about-container">
        <section class="about-intro">
            <h2>About Us</h2>
            <p>Welcome to ShoppingStore, your go-to destination for the latest in tech and electronics. Our mission is to provide you with top-quality products and exceptional customer service.</p>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    methods: {}
};
</script>

<style scoped>
.about-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.about-intro {
    text-align: center;
    margin-bottom: 40px;
}

.about-intro h2 {
    font-size: 36px;
    color: #333;
}

.about-intro p {
    font-size: 18px;
    color: #555;
    line-height: 1.6;
}
</style>
