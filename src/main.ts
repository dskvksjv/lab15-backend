import { provideHttpClient } from '@angular/common/http';
import { bootstrapApplication } from '@angular/platform-browser';
import { appConfig } from './app/app.config';
import { BookComponent } from './app/book.component';

bootstrapApplication(BookComponent, {
  providers: [
    provideHttpClient(),
    ...appConfig.providers,
  ],
}).catch((err) => console.error(err));
