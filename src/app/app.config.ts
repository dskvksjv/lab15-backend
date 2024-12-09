import { ApplicationConfig, provideZoneChangeDetection } from '@angular/core';
import { provideRouter } from '@angular/router';

import { routes } from './app.routes';

export const appConfig: ApplicationConfig = {
  providers: [provideZoneChangeDetection({ eventCoalescing: true }), provideRouter(routes)]
};
export const API_URL = 'http://localhost:8000';
export const CSRF_TOKEN_URL = 'http://localhost:8000/csrf-token';
