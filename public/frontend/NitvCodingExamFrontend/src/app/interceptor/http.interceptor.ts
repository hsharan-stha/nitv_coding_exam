import {Injectable} from '@angular/core';
import {HttpRequest, HttpHandler, HttpEvent,} from '@angular/common/http';
import {Observable} from 'rxjs';
import {NgxSpinnerService} from "ngx-spinner";
import {finalize} from "rxjs/operators";


@Injectable({
  providedIn: 'root',
})
export class HttpInterceptorService {

  /**
   * Access Token
   */
  private token: string;


  pendingRequestsCount = 0;


  constructor(private spinner: NgxSpinnerService) {
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

    // Show Spinner
    this.pendingRequestsCount++;
    this.spinner.show();

    return next.handle(req).pipe(finalize(() => {
      this.pendingRequestsCount--;
      if (this.pendingRequestsCount < 1) {
        this.spinner.hide();
      }
    }));
  }
}
