import {Injectable} from '@angular/core';
import {Router} from '@angular/router';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {JwtHelperService} from "@auth0/angular-jwt";

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  constructor(private router: Router, private httpClient: HttpClient) {
  }

  public userLogin(data) {

    const loginRequest = new FormData();
    loginRequest.append('email', data.email.trim());
    loginRequest.append('password', data.password);

    return this.httpClient.post(
      `${environment.API_URL}login/`,
      loginRequest,
    );
  }

  isUserLoggedIn() {
    try {
      let token = localStorage.getItem('access_token');
      const jwtHelper = new JwtHelperService();
      let decodedToken = jwtHelper.decodeToken(token);
      console.log(decodedToken);

      return token !== null;

    } catch (e) {
      return false;
    }
  }


}
