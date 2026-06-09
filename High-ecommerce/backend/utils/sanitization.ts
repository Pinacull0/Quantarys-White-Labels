export type SanitizablePrimitive = string | number | boolean | null | undefined;
export type SanitizableValue = SanitizablePrimitive | SanitizableValue[] | { [key: string]: SanitizableValue };

const DANGEROUS_HTML_PATTERN = /<[^>]*>/g;
const CONTROL_CHAR_PATTERN = /[\u0000-\u001F\u007F]/g;
const MULTIPLE_SPACES_PATTERN = /\s+/g;

export function sanitizeString(value: string): string {
  return value
    .replace(DANGEROUS_HTML_PATTERN, '')
    .replace(CONTROL_CHAR_PATTERN, '')
    .replace(MULTIPLE_SPACES_PATTERN, ' ')
    .trim();
}

export function sanitizeValue<T extends SanitizableValue>(value: T): T {
  if (typeof value === 'string') {
    return sanitizeString(value) as T;
  }

  if (Array.isArray(value)) {
    return value.map((item) => sanitizeValue(item)) as T;
  }

  if (value !== null && typeof value === 'object') {
    return Object.fromEntries(
      Object.entries(value).map(([key, nestedValue]) => [key, sanitizeValue(nestedValue)])
    ) as T;
  }

  return value;
}

export function sanitizeCreateProductPayload(payload: unknown) {
  const sanitizedPayload = sanitizeValue(payload as SanitizableValue);

  if (sanitizedPayload === null || typeof sanitizedPayload !== 'object' || Array.isArray(sanitizedPayload)) {
    return {};
  }

  return sanitizedPayload;
}
