<template>
    <div>
        <section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1 class="hero-title">Discover the Future of Technology</h1>
            <p class="hero-subtitle">Explore the latest gadgets and innovative tech products tailored for you.</p>
            <a href="/products" class="btn-primary">Shop Now</a>
        </div>
    </div>
</section>
        <section class="features">
            <div class="container">
                <div class="feature">
                    <div class="feature-icon">
                        <img src="/photos/apple-iphone-11-2.jpg" alt="Latest Gadgets" />
                    </div>
                    <div class="feature-text">
                        <h3>Latest Gadgets</h3>
                        <p>Discover the newest technology and gadgets to keep you ahead of the curve.</p>
                    </div>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <img src="/photos/Apple_announces-watch-se_09152020_big.jpg.large.jpg" alt="Top Brands" />
                    </div>
                    <div class="feature-text">
                        <h3>Top Brands</h3>
                        <p>Shop from a curated selection of trusted and renowned brands.</p>
                    </div>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <img src="/photos/360_F_318962869_Fxmcta895k1RNxLu1fSxHSDR0aFUi9do.jpg" alt="24/7 Support" />
                    </div>
                    <div class="feature-text">
                        <h3>24/7 Support</h3>
                        <p>Receive dedicated support anytime, anywhere with our round-the-clock customer service.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="special-offers">
            <div class="container">
                <h2>Exclusive Offers</h2>
                <div class="offers-grid">
                    <div class="offer">
                        <img src="/photos/images.jpeg" alt="Special Offer 1" />
                        <div class="offer-info">
                            <h4>50% Off on Electronics</h4>
                            <p>Limited time offer on selected electronics. Don't miss out!</p>
                        </div>
                    </div>
                    <div class="offer">
                        <img src="/photos/stock-vector-buy-get-free-promo-tag-offer-pricing-1704443341.jpg" alt="Special Offer 2" />
                        <div class="offer-info">
                            <h4>Buy 2 Get 1 Free</h4>
                            <p>Special promotion on select items. Buy one, get one free!</p>
                        </div>
                    </div>
                    <div class="offer">
                        <img src="/photos/360_F_421173720_VCRtkONOOmhaMefv1A7BQVHWaINe0aMM.jpg" alt="Special Offer 3" />
                        <div class="offer-info">
                            <h4>Free Shipping</h4>
                            <p>Enjoy free shipping on all orders over $50. Shop now and save!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


<script>
export default {
    data() {
        return {
            isAuthenticated: window.isAuthenticated
        }
    }
}
</script>

<style scoped>
/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Hero Section */
.hero {
    position: relative;
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4); 
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-content {
    text-align: center;
    color: #fff;
    padding: 20px;
    max-width: 800px;
    z-index: 1;
}
.hero-title {
    font-size: 4em;
    margin: 0;
    font-weight: bold;
    animation: fadeInUp 2s ease-out; 
}

.hero-subtitle {
    font-size: 1.5em;
    margin: 20px 0;
    animation: fadeInUp 2s ease-out 0.5s; /* Animation for subtitle with delay */
}

.hero-content:hover {
    background: rgba(0, 0, 0, 0.7);
}

.hero h1 {
    font-size: 4em;
    margin: 0;
    font-weight: bold;
    line-height: 1.2;
}

.hero p {
    font-size: 1.5em;
    margin: 20px 0;
}

.btn-primary {
    display: inline-block;
    padding: 15px 30px;
    font-size: 18px;
    color: #fff;
    background-color: #ff5722;
    text-decoration: none;
    border-radius: 50px;
    transition: background-color 0.3s, transform 0.3s;
    animation: fadeInUp 2s ease-out 1s; 
}

.btn-primary:hover {
    background-color: #e64a19;
    transform: scale(1.05);
}

/* Features Section */
.features {
    padding: 60px 20px;
    background-color: #f8f8f8;
}

.features .container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.feature {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 20px;
    width: calc(33% - 20px);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s; 
}

.feature:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.feature-icon img {
    width: 60px;
    height: 60px;
    margin-bottom: 20px;
}

.feature-text h3 {
    font-size: 1.8em;
    margin: 10px 0;
    color: #333;
}

.feature-text p {
    color: #666;
    font-size: 14px;
}

/* Special Offers Section */
.special-offers {
    padding: 60px 20px;
    background-color: #fff;
}

.special-offers .container {
    max-width: 1200px;
    margin: 0 auto;
}

.special-offers h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.5em;
    color: #333;
}

.offers-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.offer {
    background-color: #f1f1f1;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: calc(33% - 20px);
    margin-bottom: 20px;
    position: relative;
    transition: transform 0.3s, box-shadow 0.3s; 
}

.offer:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.offer img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: opacity 0.3s; 
}

.offer:hover img {
    opacity: 0.8;
}

.offer-info {
    padding: 20px;
    text-align: center;
}

.offer-info h4 {
    margin: 10px 0;
    font-size: 1.5em;
    color: #333;
}

.offer-info p {
    color: #666;
    font-size: 14px;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
