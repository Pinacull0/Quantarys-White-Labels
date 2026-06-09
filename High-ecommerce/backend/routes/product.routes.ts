import type { FastifyInstance } from 'fastify';
import { createProductController } from '../controller/product.controller.js';

export async function productRoutes(server: FastifyInstance) {
  server.post('/api/v1/admin/products', createProductController);
}
