import {Component, OnInit} from '@angular/core';
import {AuthService} from "../auth.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginForm: FormGroup;

  constructor(public loginService: AuthService,
              private router: Router,
              public formBuilder: FormBuilder) {
  }

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', Validators.required],
      password: ['', Validators.required],
    });
  }


  /**
   * Fn. to submit login form
   */
  onSubmit() {
    if (this.loginForm.invalid) {
      return;
    }

    this.loginService.userLogin(this.loginForm.value).subscribe(
      (response: any) => {
        if (response?.error?.status_code == 401) {
          alert(response['error']['message']);
          return;
        }

        localStorage.setItem('access_token', response['data']['access_token']);
        this.router.navigate(['/featured'])
      }
    );
  }

}
