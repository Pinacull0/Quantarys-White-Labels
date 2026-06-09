<script setup lang="ts">
const products = [
  { id: 1, name: 'Smartwatch Pro', price: 89990, tag: 'Mais vendido' },
  { id: 2, name: 'Headset Studio', price: 59990, tag: 'Novo' },
  { id: 3, name: 'Keyboard Elite', price: 45990, tag: 'Premium' }
];

const formatPrice = (value: number) =>
  new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(value / 100);
</script>

<template>
  <main class="page">
    <section class="hero">
      <p>High Ecommerce</p>
      <h1>Experiência premium, rápida e pronta para escala.</h1>
      <NuxtLink to="/checkout">Ir para checkout</NuxtLink>
    </section>

    <section class="products">
      <article v-for="product in products" :key="product.id" class="product">
        <span>{{ product.tag }}</span>
        <div class="product-image" />
        <h2>{{ product.name }}</h2>
        <strong>{{ formatPrice(product.price) }}</strong>
      </article>
    </section>
  </main>
</template>

<style scoped>
.page {
  background: #070b18;
  color: #f8fafc;
  min-height: 100vh;
  padding: 3rem;
}

.hero {
  background: radial-gradient(circle at top left, #7c3aed, transparent 35%), #111827;
  border: 1px solid rgb(255 255 255 / 12%);
  border-radius: 2rem;
  margin: 0 auto 2rem;
  max-width: 1180px;
  padding: 4rem;
}

.hero h1 {
  font-size: clamp(2.5rem, 7vw, 5rem);
  line-height: 0.95;
  margin: 0 0 2rem;
}

.hero a {
  background: #f8fafc;
  border-radius: 999px;
  color: #111827;
  display: inline-flex;
  font-weight: 800;
  padding: 1rem 1.4rem;
  text-decoration: none;
}

.products {
  display: grid;
  gap: 1rem;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  margin: 0 auto;
  max-width: 1180px;
}

.product {
  background: rgb(255 255 255 / 8%);
  border: 1px solid rgb(255 255 255 / 10%);
  border-radius: 1.5rem;
  padding: 1rem;
}

.product span {
  color: #c4b5fd;
  font-weight: 800;
}

.product-image {
  aspect-ratio: 1;
  background: linear-gradient(135deg, #312e81, #7c3aed);
  border-radius: 1.25rem;
  margin: 1rem 0;
}
</style>
