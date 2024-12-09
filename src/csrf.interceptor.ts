import { Injectable } from '@angular/core';
import { HttpEvent, HttpInterceptor, HttpHandler, HttpRequest } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable()
export class CsrfInterceptor implements HttpInterceptor {
  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (csrfToken) {
      const clonedRequest = req.clone({
        setHeaders: {
          'X-CSRF-TOKEN': csrfToken,
        }
      });

      return next.handle(clonedRequest);
    }

    return next.handle(req);
  }
}
