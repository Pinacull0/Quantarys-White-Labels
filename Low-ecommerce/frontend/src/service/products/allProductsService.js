const API_BASE_URL = 'http://localhost:8080';

export async function allProductsService() {
  const response = await fetch(`${API_BASE_URL}/products`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    },
    credentials: 'include'
  });

  const payload = await response.json().catch(() => ({
    error: {
      message: 'Resposta invalida da API.'
    }
  }));

  if (!response.ok) {
    throw new Error(payload?.error?.message ?? 'Erro ao buscar produtos.');
  }

  return payload.data ?? [];
}
