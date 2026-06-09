const API_BASE_URL = 'http://localhost:8080';

export async function loginService(payload) {
  const response = await fetch(`${API_BASE_URL}/api/v1/admin/auth/login`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    credentials: 'include',
    body: JSON.stringify(payload)
  });

  const responsePayload = await response.json().catch(() => ({
    error: {
      message: 'Resposta invalida da API.'
    }
  }));

  if (!response.ok) {
    throw new Error(responsePayload?.error?.message ?? 'Erro ao fazer login.');
  }

  return responsePayload.data ?? {};
}
