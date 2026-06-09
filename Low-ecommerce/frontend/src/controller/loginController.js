import { loginService } from '../service/loginService.js';
import {
  sanitizeLoginEmail,
  sanitizeLoginPassword,
  sanitizeLoginRemember
} from '../utils/sanitizations.js';

export async function loginController(values) {
  try {
    const payload = {
      email: sanitizeLoginEmail(values?.email),
      password: sanitizeLoginPassword(values?.password),
      remember: sanitizeLoginRemember(values?.remember)
    };

    const user = await loginService(payload);

    return {
      success: true,
      data: user,
      error: null
    };
  } catch (error) {
    return {
      success: false,
      data: null,
      error: {
        message: 'Email ou senha errado.'
      }
    };
  }
}
