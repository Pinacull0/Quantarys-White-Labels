export default defineNuxtConfig({
  compatibilityDate: '2025-01-01',
  devtools: { enabled: true },
  srcDir: 'src',
  typescript: {
    strict: true
  },
  app: {
    head: {
      title: 'High Ecommerce',
      meta: [
        {
          name: 'description',
          content: 'Ecommerce avançado com Nuxt, Node e TypeScript.'
        }
      ]
    }
  }
});
