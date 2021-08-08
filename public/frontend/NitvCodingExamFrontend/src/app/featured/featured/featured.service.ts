import {Injectable} from '@angular/core';
import {Router} from '@angular/router';
import {HttpClient} from '@angular/common/http';
import {environment} from "../../../environments/environment";

@Injectable({
  providedIn: 'root',
})
export class FeaturedService {
  constructor(private router: Router, private httpClient: HttpClient) {
  }

  public postData(data: object) {
    let qualification = data['qualification'];
    delete data['qualification'];
    const formData: FormData = this.createFormData(data);
    if (qualification) {
      formData.append('qualification', JSON.stringify(qualification));
    }
    return this.httpClient.post(`${environment.API_URL}profile/`, formData);
  }

  public getAll() {
    return this.httpClient.get(`${environment.API_URL}profile/`);
  }

  public delete(id: number) {
    return this.httpClient.delete(`${environment.API_URL}profile/${id}`);
  }

  public edit(id: number) {
    return this.httpClient.get(`${environment.API_URL}profile/${id}`);
  }

  public searchByEmail(value: string) {
    return this.httpClient.get(`${environment.API_URL}profile?value=${value}`);
  }

  public createFormData(
    object: Object,
    form?: FormData,
    namespace?: string
  ): FormData {
    const formData = form || new FormData();
    for (let property in object) {
      if (!object.hasOwnProperty(property) || !object[property]) {
        continue;
      }
      const formKey = namespace ? `${namespace}.${property}` : property;
      if (object[property] instanceof Date) {
        formData.append(formKey, object[property].toISOString());
      } else if (
        typeof object[property] === 'object' &&
        !(object[property] instanceof File)
      ) {
        this.createFormData(object[property], formData, formKey);
      } else {
        formData.append(formKey, object[property]);
      }
    }
    return formData;
  }


}
