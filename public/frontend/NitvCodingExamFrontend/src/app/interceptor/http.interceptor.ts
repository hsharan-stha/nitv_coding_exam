import {Injectable} from '@angular/core';
import {HttpRequest, HttpHandler, HttpEvent,} from '@angular/common/http';
import {Observable} from 'rxjs';


@Injectable({
  providedIn: 'root',
})
export class HttpInterceptorService {

  /**
   * Access Token
   */
  private token: string;


  constructor() {
  }


  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    /**
     * Fetch Access token
     */
    this.token = localStorage.getItem('access_token');


    let bearerToken = '';

    bearerToken = `Bearer ${this.token}`;

    req = req.clone({
      setHeaders: {
        'Authorization': bearerToken,
      }
    });


    return next.handle(req).pipe();

  }
}
