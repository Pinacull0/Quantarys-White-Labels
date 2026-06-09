import cors from '@fastify/cors';
import Fastify from 'fastify';
import { z } from 'zod';
import { productRoutes } from '../routes/product.routes.js';

const server = Fastify({
  logger: true
});

const createCartItemSchema = z.object({
  productId: z.number().int().positive(),
  quantity: z.number().int().positive()
});

const products = [
  { id: 1, name: 'Smartwatch Pro', price: 89990, stock: 25 },
  { id: 2, name: 'Headset Studio', price: 59990, stock: 50 },
  { id: 3, name: 'Keyboard Elite', price: 45990, stock: 35 }
];

await server.register(cors, {
  origin: true
});

await server.register(productRoutes);

server.get('/health', async () => ({
  status: 'ok',
  service: 'high-ecommerce'
}));

server.get('/products', async () => products);

server.post('/cart/items', async (request, reply) => {
  const result = createCartItemSchema.safeParse(request.body);

  if (!result.success) {
    return reply.status(400).send({
      error: 'Invalid cart item',
      details: result.error.flatten()
    });
  }

  return reply.status(201).send({
    message: 'Item added to cart',
    item: result.data
  });
});

const port = Number(process.env.PORT ?? 3333);

await server.listen({
  host: '0.0.0.0',
  port
});
